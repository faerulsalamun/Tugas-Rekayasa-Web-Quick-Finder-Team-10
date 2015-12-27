<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuickFinder extends CI_Controller
{

    /**
     * QuickFinder constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('query');
    }

    public function index()
    {
        $data['default_calender'] = $this->showMonth();

        $this->load->view('index', $data);
    }

    public function oldIndex()
    {
        $this->load->view('old_index');
    }

    public function getCity()
    {

        $city = $this->query->get("regencies", array());

        echo json_encode($city);
    }

    function showMonth($month = null, $year = null, $idFrom = null, $idTo = null)
    {
        // Thx to http://wsnippets.com/responsive-ajax-month-view-calendar-php-jquery-twitter-bootstrap-3-0/

        $calendar = '';
        if ($month == null || $year == null) {
            $month = date('m');
            $year = date('Y');
        }

        $date = mktime(12, 0, 0, $month, 1, $year);
        $daysInMonth = date("t", $date);
        $offset = date("w", $date);
        $rows = 1;
        $prev_month = $month - 1;
        $prev_year = $year;

        if ($month == 1) {
            $prev_month = 12;
            $prev_year = $year - 1;
        }

        $next_month = $month + 1;
        $next_year = $year;

        if ($month == 12) {
            $next_month = 1;
            $next_year = $year + 1;
        }

        $calendar .= "<div class='col-md-12'>";
        $calendar .= "<table class='rangeSearchDayName table'>";
        $calendar .= "<thead><tr><td>Sun</td><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td></tr></thead></table>";
        $calendar .= "</div>";

        $calendar .= "<div class='col-md-12'>";
        $calendar .= "<table class='rangeSearchDates table'>";
        $calendar .= "<tbody><tr>";

        for ($i = 1; $i <= $offset; $i++) {
            $calendar .= "<td></td>";
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            if (($day + $offset - 1) % 7 == 0 && $day != 1) {
                $calendar .= "</tr><tr>";
                $rows++;
            }

            $calendar .= "<td class='currentMonth rangeSearchAvailable'>";

            $calendar .= "<div class='rangeSearchDateBox'>";
            $calendar .= "<div class='rangeSearchDate'>$day </div>";

            $searchData = $year . "-" . $month . "-" . $day;

            $lowPrice = json_decode($this->getPrice($idFrom, $idTo, $searchData));

            $lowPriceFilter = isset($lowPrice[0]->price) === true ? "<span>Rp</span> " . $lowPrice[0]->price : "";

            $calendar .= "<div class='rangeSearchPrice' ><span >  </span > " . $lowPriceFilter . "</div >";
            $calendar .= "<a class='rangeSearchBook' ></a >";
            $calendar .= "</div > ";

            $calendar .= "</td > ";
        }

        while (($day + $offset) <= $rows * 7) {
            $calendar .= "<td ></td > ";
            $day++;
        }

        $calendar .= "</tr>";
        $calendar .= "</table>";

        return $calendar;
    }

    public function getPrice($idFrom = null, $idTo = null, $date = null)
    {
        $data['select'] = 'search.id_search,search.price';
        $data['join'][0]['tabel'] = "regencies b";
        $data['join'][0]['relasi'] = "search.id_from=b.id";
        $data['join'][0]['tipe_join'] = "inner";

        $data['join'][1]['tabel'] = "regencies c";
        $data['join'][1]['relasi'] = "search.id_to=c.id";
        $data['join'][1]['tipe_join'] = "inner";

        $data['where'][0] = "search.date = '$date' ";
        $data['where'][1] = "search.id_from = '$idFrom' ";
        $data['where'][2] = "search.id_to = '$idTo' ";
        $data['where'][3] = "search.search_date >= DATE_ADD(NOW(), INTERVAL -2 DAY)  ";

        $data['order'] = "price asc";
        $data['limit'] = "1";

        $search = $this->query->get("search", $data);

        return json_encode($search);
    }

    public function searchCalender($date = null)
    {
        // Check validation
        $this->form_validation->set_rules('id_from', 'id_from', 'required');
        $this->form_validation->set_rules('id_to', 'id_to', 'required');
        $this->form_validation->set_rules('month', 'month', 'required');

        if ($this->form_validation->run() == FALSE) {
        } else {
            $input = $this->input->post();

            echo $this->showMonth($input["month"], date('Y'), $input["id_from"], $input["id_to"]);
        }
    }

}
