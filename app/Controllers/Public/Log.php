<?php

namespace App\Controllers\Public;
use App\Libraries\LoggerLibrary;
class Log extends BaseController
{ 
    public function index(): string
    {
        return view('public/log.php', $this->data);
    }

    public function In()
    {
    	$postData = $_POST;
        $resultData=[];

        $rules = [
                    "username"=>"required|min_length[3]",
                    "password"=>"required|min_length[6]|max_length[15]"
                 ];
        $this->validation->setRules($rules);

        if (!$this->validateData($postData,$rules)) {
             $resultData =[
                "error"     => true,
                "message"   => "validation",
                "data"      => $this->validator->getErrors()
            ];  
         } 
         else{
        	if ($this->CheckUser($postData["username"],$postData["password"]))
        	{
        		$resultData =[
        			"error" 	=> false,
        			"message" 	=> "",
        			"data"		=> ""
        		]; 
        	}
        	else
        	{
        		$resultData =[
        			"error" 	=> true,
        			"message" 	=> "validation",
        			"data"		=> ["DB"=>"Kullanıcı Adı/ Şifre Hatalı"]
        		];
        	}
        } 
    	echo json_encode($resultData);
    }

    public function Out()
    {  
    	$this->session->remove("user");
    	return redirect()->to(base_url("/"));
    }

    public function CheckUser($username,$password):bool
    {
    	$params = [
    		"username"=>$username,
    		"password"=>$password
    	];

    	$userModel = new \App\Models\UserModel();
    	$users = $userModel->where($params)->first();
    	// var_dump($users);

    	if (empty($users) || (!empty($users) && $users["active"]!="1")) {
    		return false;
    	}

    	$user = [
    		"id"	=>$users["id"],
            "photo"  =>$users["photo"],
    		"username"	=>$users["username"],
    		"first_name"=>$users["first_name"],
    		"last_name"	=>$users["last_name"],
    		"is_admin"	=>$users["is_admin"],
    		"login_time"=>date("Y.m.d H:i:s"),
    	];

    	$this->session->set("user",$user);   
    	LoggerLibrary::sendUserLog("Giriş Yapıldı");
    	return true;
    }
}
