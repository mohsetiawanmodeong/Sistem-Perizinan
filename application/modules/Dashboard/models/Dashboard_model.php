<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    // Global View dengan $tbl sebagai nama tabel nya
    public function viewAll($select, $tbl)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $query  = $this->db->get();

        return $query;
    }

    // Global View dengan $tbl sebagai nama tabel nya
    public function viewAllOrderBy($select, $tbl, $where)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->order_by($where, 'DESC');
        $query  = $this->db->get();

        return $query;
    }

    // Global View Where
    public function viewWhere($tbl, $where, $id)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where, $id);
        $query  = $this->db->get();

        return $query;
    }

    // Global View Where Global
    public function viewWhereGroup($tbl, $where, $id, $group)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where, $id);
        $this->db->group_by($group);
        $query  = $this->db->get();

        return $query;
    }

    // Global View Where Assosiative
    public function viewWhereAssosiative($select, $tbl, $assosiative)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($assosiative);
        $query = $this->db->get();

        return $query;
    }

    // Global View With Condition And Variable Select
    public function viewWhereSelect($select, $tbl, $where, $sekarang)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where, $sekarang);
        $query  = $this->db->get();

        return $query;
    }

    // Global View Where Global
    public function viewGroup($select, $tbl, $group)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->group_by($group);
        $query  = $this->db->get();

        return $query;
    }

    // Global View Join
    public function viewGlobalJoin($select, $tbl, $join)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }

    // Global View Global Join Order
    public function viewGlobalJoinOrder($select, $tbl, $order, $join)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->order_by($order, 'ASC');
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }

    // Global View Global Join Order
    public function viewGlobalJoinGroupOrder($select, $tbl, $join, $group, $order)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->group_by($group);
        $this->db->order_by($order,'Asc');
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }

    // Global View Global Join Order Where
    public function viewGlobalJoinGroupOrderWhere($select, $tbl, $where, $join, $group, $order)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->group_by($group);
        $this->db->order_by($order,'Asc');
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }
    
    // Global View Join
    public function viewGlobalJoinWhere($select, $tbl, $where, $join)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where);
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }

    // Global View Global Join Where Limit
    public function viewGlobalJoinWhereLimit($select, $tbl, $where, $join,$limit)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->limit($limit);
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }

    // Global View Global Join Where Limit
    public function viewGlobalJoinWhereLimitOrder($select, $tbl, $where, $join, $limit, $order)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->order_by($order,'ASC');
        $this->db->limit($limit);
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }

    // Global View Join
    public function viewGlobalJoinWhereGroup($select, $tbl, $where, $join, $group)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->group_by($group);
        foreach ($join as $row) {
            $this->db->join($row[0], $row[1], $row[2]);
        }
        $query      = $this->db->get();

        return $query;
    }
    
    // Global Insert dengan $tbl sebagai nama tabel dan $input sebagai data nya
    public function insert($tbl, $input)
    {
        return $this->db->insert($tbl, $input);
    }

    // Global Update dengan $tbl sebagai nama tabel dan $input sebagai inputan datanya
    public function update($tbl, $where, $id, $update)
    {
        return $this->db->where($where, $id)->update($tbl, $update);
    }

    // Global Update dengan assosiative Where
    public function updateAss($tbl, $where, $update)
    {
        return $this->db->where($where)->update($tbl, $update);
    }

    // Global Delete dengan $where sebagai kondisi data yang ingin di eksekusi $tbl sebagai nama tabel dan $id sebagai acuan yang ingin di eksekusi
    public function delete($where, $tbl, $id)
    {
        $this->db->where($where, $id);
        $this->db->delete($tbl);
        return true;
    }

    // Global Cari
    public function cari($tbl, $where, $like)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->like($where, $like);
        $query  = $this->db->get();

        return $query;
    }

    // Datatables Admin View
    public function json($select, $table)
    {
        $this->datatables->select($select);
        $this->datatables->from($table);

        return $this->datatables->generate();
    }

    // Global Json Where
    public function jsonWhere($select, $table, $where, $id)
    {
        $this->datatables->select($select);
        $this->datatables->from($table);
        $this->datatables->where($where, $id);

        return $this->datatables->generate();
    }

    // Global Json Where Assosiative
    public function jsonWhereAsso($select, $table, $where)
    {
        $this->datatables->select($select);
        $this->datatables->from($table);
        $this->datatables->where($where);

        return $this->datatables->generate();
    }

    // Cek Maks Data
    public function cekmaks($table, $where, $id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where, $id);
        $query = $this->db->get()->num_rows();

        return $query;
    }
    // Cek Maks Data
    public function cekmaksAss($table, $where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get()->num_rows();

        return $query;
    }

    //Gobal Ceks Num Rows
    public function ceksNumRows($select, $table, $where)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get()->num_rows();

        return $query;
    }

    //Gobal Ceks Array
    public function ceksArray($select, $table, $where)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query;
    }

    // Get Last Data On Table
    public function lastData($select, $table, $where)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->order_by($where, 'DESC');
        $this->db->limit(1);
        $query      = $this->db->get();

        return $query;
    }

    // Global View Datatable Global Join Assosiative Where
    public function jsonGlobalJoinAssWhere($select, $tbl, $where, $join)
    {
        $this->datatables->select($select);
        $this->datatables->from($tbl);
        $this->datatables->where($where);
        foreach ($join as $row) {
            $this->datatables->join($row[0], $row[1], $row[2]);
        }

        return $this->datatables->generate();
    }

    // Global View Where Global
    public function viewWhereGroupAsso($select, $tbl, $where, $group)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->group_by($group);
        $query  = $this->db->get();

        return $query;
    }

    // Global Delete Images
    public function deleteImage($table, $where, $id)
    {
        $cek = $this->viewWhere($table, $where, $id)->result_array();
        if ($cek[0]['photo'] != "default.jpg") {
            $filename = explode(".", $cek[0]['photo']);
            // Delete Field On Database If Success
            if ($this->db->where($where, $id)->delete($table)) {
                // Delete Image
                return array_map('unlink', glob(FCPATH."frontend/assets/images/product/$filename[0].*"));
            }
        }
    }

    // Global View Datatable Join
    public function jsonGlobalJoin($select, $tbl, $join)
    {
        $this->datatables->select($select);
        $this->datatables->from($tbl);
        foreach ($join as $row) {
            $this->datatables->join($row[0], $row[1], $row[2]);
        }

        return $this->datatables->generate();
    }

    // Global View Datatable Join Group By
    public function jsonGlobalJoinGroup($select, $tbl, $group, $join)
    {
        $this->datatables->select($select);
        $this->datatables->from($tbl);
        $this->datatables->group_by($group);
        foreach ($join as $row) {
            $this->datatables->join($row[0], $row[1], $row[2]);
        }

        return $this->datatables->generate();
    }

    // Global View Datatable Join Group By Where
    public function jsonGlobalJoinGroupWhere($select, $tbl, $where, $group, $join)
    {
        $this->datatables->select($select);
        $this->datatables->from($tbl);
        $this->datatables->where($where);
        $this->datatables->group_by($group);
        foreach ($join as $row) {
            $this->datatables->join($row[0], $row[1], $row[2]);
        }

        return $this->datatables->generate();
    }

    // Global View Datatable Global Join Where
    public function jsonGlobalJoinWhere($select, $tbl, $id, $value, $join)
    {
        $this->datatables->select($select);
        $this->datatables->from($tbl);
        $this->datatables->where($id, $value);
        foreach ($join as $row) {
            $this->datatables->join($row[0], $row[1], $row[2]);
        }

        return $this->datatables->generate();
    }

    // Global View Datatable Global Join Where Assosiative
    public function jsonGlobalJoinWhereAsso($select, $tbl, $where, $join)
    {
        $this->datatables->select($select);
        $this->datatables->from($tbl);
        $this->datatables->where($where);
        foreach ($join as $row) {
            $this->datatables->join($row[0], $row[1], $row[2]);
        }

        return $this->datatables->generate();
    }

    // Get Data Pagi
    public function getPagi($select, $table, $where, $limit, $start)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }
}