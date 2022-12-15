<?php

class M_Global extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function query($query)
    {
        return $this->db->query($query);
    }

    public function insert($data, $table)
    {
        $insert = $this->db->insert($table, $data);

        if (!$insert) {
            $error = $this->db->error();
        } else {
            $error = "success";
        }
        return $error;
    }

    public function update($table, $array, $where)
    {
        $this->db->where($where);
        return $this->db->update($table, $array);
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function getData($table)
    {
        $query = " SELECT * FROM " . $table;
        return $this->db->query($query);
    }

    public function getDataWhere($table, $kolom, $param)
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $kolom . " = " . $param;
        return $this->db->query($query);
    }

    public function getDataGroupBy($table, $kolom1, $kolom, $param)
    {
        $query = " SELECT * FROM " . $table . " WHERE " . $kolom1 . " = " . $param . " GROUP BY " . $kolom;
        return $this->db->query($query);
    }

    public function getData2WhereAnd($table, $kolom1, $kolom2, $param1, $param2)
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $kolom1 . " = " . $param1 . " AND " . $kolom2 . " = " . $param2;
        return $this->db->query($query);
    }

    public function getData2WhereAnd2($table, $kolom1, $kolom2, $param1, $param2)
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $kolom1 . " = " . $param1 . " AND " . $kolom2 . " != " . $param2;
        return $this->db->query($query);
    }

    public function getDataWhereOrderByASC($table, $kolom, $kolom1, $param)
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $kolom . " = " . $param . " ORDER BY " . $kolom1 . " ASC ";
        return $this->db->query($query);
    }

    public function findData($table, $kolom1, $kolom2, $kolom3, $param1, $param2)
    {
        $query = " SELECT * FROM " . $table . " WHERE " . $kolom1 . "=" . $param2 . " AND " . $kolom2 . " LIKE "  . "'%{$param1}%'" . " ORDER BY " . $kolom3 . " ASC ";
        return $this->db->query($query);
    }

    public function transactionNumber()
    {
        $dateNow = date("Y-m-d");

        $this->db->select('RIGHT(Transaction.TransactionNumber,4) as transaction_number', FALSE);
        $this->db->order_by('transaction_number', 'DESC');
        $this->db->limit(1);
        $this->db->where('DATE(TransactionDatetime)', $dateNow);
        $query = $this->db->get('Transaction');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->transaction_number) + 1;
        } else {
            $kode = 1;
        }
        $tgl            = date('Ymd');
        $batas          = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil     = $tgl . $batas;

        return $kodetampil;
    }
}
