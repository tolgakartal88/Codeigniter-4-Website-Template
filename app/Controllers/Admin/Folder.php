<?php

namespace App\Controllers\Admin;

class Folder extends BaseController
{
    public function index(): string
    {  
        return view('admin/admin-panel.php', $this->data);
    } 

    public function GetList()
    {
    	$folderModel = new \App\Models\FolderModel();
    	$folders = $folderModel->select("url as id,title")->findAll();
    	foreach ($folders as $key => $value) {
    		$folders[$key]["id"]=ROOTPATH.$value["id"];
    	}


        echo json_encode($folders);
    }
 
}
