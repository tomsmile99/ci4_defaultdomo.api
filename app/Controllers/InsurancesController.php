<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel\InsurancesModel;
//use App\Models\DemoModel;
use CodeIgniter\API\ResponseTrait;

class InsurancesController extends BaseController {
    use ResponseTrait;
    private $model;
    function __construct(){
      $this->model = new InsurancesModel();
      //$this->model = new DemoModel();
    }

    public function dataFormCheckPremiums(){
      /* ข้อมูลตัวอย่าง
      // ดึงข้อมูลทั้งหมดจาก GET request
      $getParameters = $this->request->getGet();
      // ตรวจสอบว่ามีข้อมูล GET ส่งมาหรือไม่
      if(!empty($getParameters)){
        // Loop ผ่านข้อมูลทั้งหมด
        foreach ($getParameters as $key => $value) {
          echo "Key: " . esc($key) . " - Value: " . esc($value) . "<br>";
        }
      }else{
        echo "ไม่มีข้อมูล GET ส่งมา";
      }
      */
      if($this->request->getGet('_exp_Token') != null && $this->request->getGet('_PerRG_Token') != null && $this->request->getGet('_PerST_Token') != null){
          $ExpToken = base64_decode(base64_decode($this->request->getGet('_exp_Token'))); //เวลาหมดอายุ Token
          if(__checkExpTokentime($ExpToken)){
            $PerRGToken = base64_decode(base64_decode($this->request->getGet('_PerRG_Token'))); //PerWP Token
            $PerSTToken = base64_decode(base64_decode($this->request->getGet('_PerST_Token'))); //PerST Token
            //echo $PerRGToken;
            if(__checkPermissionsUser($PerRGToken,$PerSTToken)){
              // ยี่ห้อรถ
              $resCarBrands = $this->model->selectRecordCarBrands("isr_carbrands",
                ["isr_cb_status" => 1]
              );
              // ประเภทรหัสรถ
              $resCarTypes = $this->model->selectRecordCarTypes("isr_cartypes",
                ["isr_ct_status" => 1]
              );

              // สีรถ
              $resCarColors = $this->model->selectRecordCarColors("isr_carcolors");
              
              $result = [
                "status"        => 200,
                "sqlCarBrands"  => $resCarBrands,
                "sqlCarTypes"   => $resCarTypes,
                "sqlCarColors"  => $resCarColors,
              ];
            }else{
              $result = [
                "status" => 403,
                "data" => "สิทธิ์การเรียกข้อมูลไม่ถูกต้อง",
              ];
            }
          }else{
            $result = [
              "status" => 403,
              "data" => "สิทธิ์การเข้าถึงไม่ถูกต้อง Token หมดอายุการใช้งาน",
            ];
          }
      }else{
        $result = [
            "status" => 403,
            "data" => "สิทธิ์การเข้าใช้งานไม่ถูกต้อง",
        ];
      }
      return $this->response->setJSON($result);
      exit;
    }


    public function dataSeriesCars($DataId = null){
      if($DataId != null){
        $resCarSeries = $this->model->selectRecordCarSeries("isr_carseries",["isr_cs_cb_id" => $DataId,"isr_cs_status" => 1]);
        $result = [
            "status" => 200,
            "sqlCarSeries" => $resCarSeries,
        ];
      }else{
        $result = [
          "status" => 404,
          "data" => "ไม่พบข้อมูลที่เลือก",
        ];
      }
    return $this->respond($result);
    }



    public function createApiKey() {
      $key = bin2hex(random_bytes(16)); // สร้างคีย์แบบสุ่ม
      $data = [
          'key' => $key,
          'level' => 1,
          'ignore_limits' => 0,
          'is_private_key' => 0,
          'ip_addresses' => null
      ];

      $db = \Config\Database::connect();
      $db->table('api_keys')->insert($data);
      
      return $key;
  }
}
