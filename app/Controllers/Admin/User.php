<?php
namespace App\Controllers\Admin; 

class User extends BaseController
{
	public function index():string
	{
		return view('admin/user.php', $this->data);
	}

	public function Add($value='')
	{
		$postData = $_POST;  
        $data = [
            "is_admin"=>($postData["is_admin"]=="true"?1:0),
            "first_name"=>$postData["first_name"],
            "last_name"=>$postData["last_name"],
            "username"=>$postData["username"],
            "password"=>$postData["password"], 
            "active"=>($postData["active"]=="true"?1:0)
        ]; 
        $userModel = new \App\Models\UserModel();
        $userModel->insert($data);
        echo json_encode($postData);
	}

	public function Remove($value='')
	{
		$postData = $_POST;  
        $whereClause=["id"=>$postData["id"]];
        $userModel = new \App\Models\UserModel();
        $userModel->where($whereClause)->delete();
        array_push($postData, $_POST);
        array_push($postData, $_FILES);
        echo json_encode($postData); 
	}

	public function Update($value='')
	{
		$postData = $_POST;  
        $data = [ 
            "is_admin"=>($postData["is_admin"]=="true"?1:0),
            "first_name"=>$postData["first_name"],
            "last_name"=>$postData["last_name"],
            "username"=>$postData["username"],
            "password"=>$postData["password"], 
            "active"=>($postData["active"]=="true"?1:0)
        ];
        $userModel = new \App\Models\UserModel();
        $userModel->update($postData["id"],$data);
        
        array_push($postData, $_FILES);
        echo json_encode($postData); 
	}

	public function Get($value='')
	{
		$postData = $_POST;
        $whereClause = [
            "id"=>$postData["id"]
        ];
        $userModel = new \App\Models\UserModel();
        $user = $userModel->from([],true)
                          ->from("users")
                          ->select("id,is_admin,TO_BASE64(photo) as photo,photo_type,first_name,last_name,username,password,active")
                          ->where($whereClause)
                          ->findAll(); 
        echo json_encode($user);
	}

	public function GetList($value='')
	{
		$userModel = new \App\Models\UserModel();
        $user = $userModel->from([],true)
                          ->from("users")
                          ->select("id,is_admin,TO_BASE64(photo) as photo,photo_type,first_name,last_name,username,password,active")
                          ->findAll();  
        echo json_encode($user);
	}
}