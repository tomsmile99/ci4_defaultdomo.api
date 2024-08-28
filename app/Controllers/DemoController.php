<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DemoModel;
use CodeIgniter\API\ResponseTrait;

class DemoController extends BaseController {
    use ResponseTrait;
    private $model;
    function __construct(){

        
        $this->model = new DemoModel();


    }

    public function index($id = null){
        if($id == null){
            $fetchRecord = $this->model->selectRecord("api_tb_data_test");
            //echo json_encode($fetchRecord);
            $result = [
                "status" => 200,
                "data" => $fetchRecord,
            ];
        }else{
            $fetchRecord = $this->model->selectRow("api_tb_data_test",["tb_id" => $id]);
            if(!empty($fetchRecord)){
                $result = [
                    "status" => 200,
                    "data" => $fetchRecord,
                ];
            }else{
                $result = [
                    "status" => 404,
                    "data" => "No Record Found",
                ];
            }
            
        }
        return $this->respond($result);
    }

    public function delete($id){
        $selectData = $this->model->selectRow("api_tb_data_test",["tb_id" => $id]);
        if(!empty($selectData)){
            $delete = $this->model->deleteValue("api_tb_data_test",["tb_id" => $id]);
            if($delete){
                $result = [
                    "status" => 200,
                    "data" => "Delete Success",
                ];
            }else{
                $result = [
                    "status" => 404,
                    "data" => "Delete Record Found",
                ];
            }
        }else{
            $result = [
                "status" => 404,
                "data" => "No Record For Delete Found",
            ];
        }
        return $this->respond($result);
    }


    public function status($id,$status){
        $selectData = $this->model->selectRow("api_tb_data_test",["tb_id" => $id]);
        if(!empty($selectData)){
            if($status === "Active"){
                $action = 1;
            }else if($status === "UnActive"){
                $action = 0;
            }

            $data = [
                "tb_Status" => $action,
            ];
            $updateStatus = $this->model->updateValue("api_tb_data_test", ["tb_id" => $id], $data);
            if($updateStatus){
                $result = [
                    "status" => 200,
                    "data" => "Update Data Success",
                ];
            }else{
                $result = [
                    "status" => 404,
                    "data" => "Update Data Record Found",
                ];
            }
        }else{
            $result = [
                "status" => 404,
                "data" => "No Record For Update Found",
            ];
        }
        return $this->respond($result);
    }

    public function create($id=null){
        if($this->request->getMethod() == 'POST'){
            $tb_data_name = $this->request->getVar("data_name_form");
            $tb_detail = $this->request->getVar("data_detail_form");
            $tb_Datetime = date("Y-m-d H:i:s");
            if($id!=null){
                $selectData = $this->model->selectRow("api_tb_data_test",["tb_id" => $id]);
                if(!empty($selectData)){
                    $dataUpdate = [
                        "tb_data_name" => $tb_data_name,
                        "tb_detail" => $tb_detail,
                        "tb_UpDatetime" => $tb_Datetime
                    ];
                    $update = $this->model->updateValue("api_tb_data_test", ["tb_id" => $id], $dataUpdate);
                    if($update){
                        $result = [
                            "status" => 200,
                            "data" => "Update Data Success",
                        ];
                    }else{
                        $result = [
                            "status" => 404,
                            "data" => "Update Data Record Found",
                        ];
                    }

                }else{
                    $result = [
                        "status" => 404,
                        "data" => "No Record For Update Found",
                    ];
                }
            }else{
                $dataAdd = [
                    "tb_data_name" => $tb_data_name,
                    "tb_detail" => $tb_detail,
                    "tb_AddDatetime" => $tb_Datetime,
                    "tb_Status" => 1, // Default Active status
                ];
                $insert = $this->model->inserValue("api_tb_data_test",$dataAdd);
                if($insert){
                    $result = [
                        "status" => 200,
                        "data" => "Add Data Success",
                    ];
                }else{
                    $result = [
                        "status" => 404,
                        "data" => "Add Data Record Found",
                    ];
                }
            }
        }else{
            $result = [
                "status" => 404,
                "data" => "No Post Method Found",
            ];
        }
        return $this->respond($result);
    }


    // Controller หรือ Model ที่ใช้ในการเพิ่มคีย์
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
