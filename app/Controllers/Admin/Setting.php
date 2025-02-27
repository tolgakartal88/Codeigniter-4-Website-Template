<?php
namespace App\Controllers\Admin; 

class Setting extends BaseController
{
	public function index():string
	{
		return view('admin/settings.php', $this->data);
	} 

	public function GetList($value='')
	{
		$settingsModel = new \App\Models\SettingModel();
		$settings = $settingsModel->from([],true)
								  ->from("settings s")
								  ->select("s.*,sg.title as set_group_name,sg.icon as set_group_icon")
								  ->join("setting_groups sg","s.set_group_id = sg.id","left")
								  ->orderBy("sg.title","ASC")
								  ->findAll();
		echo json_encode($settings);
	}

	public function Update($value='')
	{
		$postData = $_POST;
		$filesData = $_FILES;
		var_dump($filesData);
		$requestData=array();  
		$files = array();

		foreach ($filesData as $key => $value) { 
			if (!empty($_FILES[$key]["tmp_name"])) {
				$requestData[]=["set_key"=>$key,"set_value"=>base64_encode(file_get_contents($_FILES[$key]["tmp_name"]))];
			}
			else {
				$requestData[]=["set_key"=>$key,"set_value"=>"reupdate"];
			}
		}
		$settingsModel = new \App\Models\SettingModel();

		$tableKeysData = $settingsModel->select("set_key")->findAll(); 
		foreach ($postData as $key => $value) { 
			$requestData[] = ["set_key"=>$key,"set_value"=>($value=="on"?true:$value)];
		}
 		
 		$tableKeys = array_column($tableKeysData,"set_key");
 		$requestKeys = array_column($requestData,"set_key");
 		foreach ($tableKeys as $value) {  
 			if (!in_array($value, $requestKeys)) { 
 				$requestData[] = ["set_key"=>$value,"set_value"=>false];
 			} 
 		}
 		var_dump($requestData);
		$settingsModel->updateBatch($requestData,"set_key");
	}
}