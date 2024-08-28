<?php

namespace App\Models\UsersModel;

use CodeIgniter\Model;

class InsurancesModel extends Model {



  public function selectRecordCarBrands($table,$where = array()){
    $builder = $this->db->table($table);
    $builder->select('isr_cb_id,isr_cb_brandname,isr_cb_brandicon');
    $builder->where($where);
    $result = $builder->get();
    return $result->getResult();
  }

  public function selectRecordCarSeries($table,$where = array()){
    $builder = $this->db->table($table);
    $builder->select('isr_cs_id,isr_cs_seriesname');
    $builder->where($where);
    $builder->orderBy('isr_cs_seriesname', 'ASC');
    $result = $builder->get();
    return $result->getResult();
  }
  

  public function selectRecordCarTypes($table,$where = array()){
    $builder = $this->db->table($table);
    $builder->select('isr_ct_id,isr_ct_code,isr_ct_name');
    $builder->where($where);
    $result = $builder->get();
    return $result->getResult();

    // $builder = $this->db->table('isr_cartype');
    // $result  = $builder->get();  // Produces: SELECT * FROM mytable
    // return $result->getResult();

  }

  public function selectRecordCarColors($table){
    $builder = $this->db->table($table);
    $builder->select('isr_cc_id,isr_cc_color');
    $result = $builder->get();
    return $result->getResult();
  }



  public function selectRow($table,$where = array()){
    $builder = $this->db->table($table);
    $builder->where($where);
    $result = $builder->get();
    return $result->getRow();
  }


  public function inserValue($table,$data){
    $builder = $this->db->table($table);
    $builder->insert($data);
    return true;
  }


  public function updateValue($table, $where, $data){
    $builder = $this->db->table($table);
    $builder->where($where);
    $builder->update($data);
    return true;
  }


  public function deleteValue($table,$where = array()){
    $builder = $this->db->table($table);
    $builder->where($where);
    $builder->delete();
    return true;
  }
}