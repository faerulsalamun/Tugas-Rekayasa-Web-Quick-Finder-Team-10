<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Quick Finder">
    <meta name="author" content="Team 10">

    <title>Quick Finder</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("public") ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url("public") ?>/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("public") ?>/assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url("public") ?>/assets/css/easy-autocomplete.min.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <div class="row">

        <h2>Promo Quick Finder</h2>
        <p>Lihat harga termurah dari hasil pencarian selama 48 jam terakhir di sini. Klik tanggal untuk memesan.</p>
        <p>Harga dapat berubah sewaktu-waktu.</p>
    </div>
    <div class="row">
        <div class="col-md-12 range-search">
            <form>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="from-city">From</label>
                        <input type="text" class="form-control" id="from-city" placeholder="From">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="to-city">To</label>
                        <input type="text" class="form-control" id="to-city" placeholder="To">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="month">Month</label>
                        <select class="form-control" id="month">
                            <option value="">Choose a month</option>
                            <?php

                            for ($totalMonth = 1; $totalMonth <= 12; $totalMonth++) {
                                echo "<option value='" . $totalMonth . "'>" . date('F', mktime(0, 0, 0, $totalMonth, 10)) . " - " . date('Y') . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="row" id="data-calender">
            <img src="<?php echo base_url("public") ?>/assets/image/loading_spinner.gif" class="center-block"
                 id="loading-animation">
            <?php echo $default_calender; ?>
        </div>

    </div>
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url("public") ?>/assets/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url("public") ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url("public") ?>/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="<?php echo base_url("public") ?>/assets/js/jquery.easy-autocomplete.min.js"></script>

<script type="text/javascript">
    var root = {
        baseUrl: '<?php echo base_url()?>'
    };

    var idFrom;
    var idTo;

    var optionsFrom = {
        url: root.baseUrl + 'index.php/quickfinder/getCity',

        getValue: "name",
        list: {
            onChooseEvent: function () {
                idFrom = $("#from-city").getSelectedItemData().id;
                searchData();
            },
            maxNumberOfElements: 5,
            match: {
                enabled: true
            }
        }
    };

    var optionsTo = {
        url: root.baseUrl + 'index.php/quickfinder/getCity',

        getValue: "name",
        list: {
            onChooseEvent: function () {
                idTo = $("#to-city").getSelectedItemData().id;
                searchData();
            },
            maxNumberOfElements: 5,
            match: {
                enabled: true
            }
        }
    };


    $("#from-city").easyAutocomplete(optionsFrom);
    $("#to-city").easyAutocomplete(optionsTo);

    $("#month").change(function () {
        searchData();
    });

    function searchData() {
        var month = $("#month").val();

        $.ajax({
            url: root.baseUrl + "index.php/quickfinder/searchCalender",
            type: "post",
            data: {month: $("#month").val(), id_from: idFrom, id_to: idTo},
            success: function (data) {
                if (data != "") {
                    $("#data-calender").html(data);
                }
            },
            beforeSend: function () {
                $("#loading-animation").css('display', 'block');
                $("#data-calender").css('display', 'none');
            },
            complete: function () {
                $("#loading-animation").css('display', 'none');
                $("#data-calender").css('display', 'block');
            }
        });
    }
</script>

</body>
</html>
