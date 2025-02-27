<?php

namespace App\Controllers\User;

class User extends BaseController
{
    public function index(): string
    {
    	$this->data["page"]["user"] = ($this->session->get("user"));

		$userSession = $this->session->get("user");  
    	$userLogModel = new \App\Models\UserLogModel();
    	$userLog = $userLogModel->where(["user_id"=>$userSession["id"]])
    							->orderBy("action_time","desc")
    							->findAll();
    	$this->data["page"]["user_log"] = $userLog;
        return view('user/profile.php', $this->data);
    }  

    public function PhotoAdd($value='')
    { 

        $data=["photo"=>file_get_contents($_FILES["file_0"]["tmp_name"]),"photo_type"=>pathinfo($_FILES["file_0"]["name"],PATHINFO_EXTENSION)];
        $userModel = new \App\Models\UserModel();
        $userModel->update(session()->get('user')["id"],$data);
        $_SESSION["user"]["photo"]=file_get_contents($_FILES["file_0"]["tmp_name"]);
        $_SESSION["user"]["photo_type"]=pathinfo($_FILES["file_0"]["name"],PATHINFO_EXTENSION);
    }
}
