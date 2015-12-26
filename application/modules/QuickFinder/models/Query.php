<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: faerulsalamun
 * Date: 12/17/15
 * Time: 9:46 PM
 */
class Query extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // list table

    }

    public function insert($db, $data)
    {
        $this->db->insert($db, $data);
        return $this->db->insert_id();
    }

    public function get($db, $data, $join = array())
    {
        if (!empty($data['select'])) {
            $this->db->select($data['select']);
        }

        if (!empty($data['where'])) {
            for ($where = 0; $where < count($data['where']); $where++) {
                $this->db->where($data['where'][$where]);
            }
        }

        if (!empty($data['like'])) {
            $this->db->like($data['like']);
        }

        if (!empty($data['limit'])) {
            if (!empty($data['offset'])) {
                $this->db->limit($data['limit'], $data['offset']);
            } else {
                $this->db->limit($data['limit']);
            }
        }

        if (!empty($data['order'])) {
            $this->db->order_by($data['order']);
        }

        if (!empty($data['group'])) {
            $this->db->group_by($data['group']);
        }

        if (!empty($data['count'])) {
            $this->db->select("count(" . $data['count'] . ") as total");
        }

        if (!empty($data['join'])) {
            for ($join = 0; $join < count($data['join']); $join++) {
                $this->db->join($data['join'][$join]['tabel'], $data['join'][$join]['relasi'], $data['join'][$join]['tipe_join']);
            }
        }


        $get = $this->db->get($db);

        if (!empty($data['debug'])) {
            print_r($this->db->last_query());
            exit;
        }
        return $get->result();
    }

    public function save($db, $data)
    {
        $this->db->insert($db, $data);
        return $this->db->insert_id();
    }

    public function update($db, $data, $where)
    {
        $this->db->where($where);
        $this->db->set($data);
        $this->db->update($db);

    }

    public function delete($db, $where)
    {
        $this->db->where($where);
        $this->db->delete($db);
    }
}
