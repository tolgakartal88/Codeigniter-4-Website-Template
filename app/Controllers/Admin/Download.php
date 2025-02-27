<?php

namespace App\Controllers\Admin;

class Download extends BaseController
{

    private $rootPath;
    private $rootUrl; 
    public function __construct(){
        $this->rootPath =  ROOTPATH."public/uploads/downloads";
        $this->rootUrl = base_url("public/uploads/downloads/");
    }

    public function index(): string
    {  
    	helper("filesystem");
        $folderModel = new \App\Models\FolderModel();
        $folders = $folderModel->findAll();
        foreach ($folders as $key => $value) {
            if (!is_dir(ROOTPATH.$value["url"])) {
                 mkdir(ROOTPATH.$value["url"], 0777, true);
            }
        }

        $categoryModel = new \App\Models\MenuModel();
        $categories = $categoryModel->where(["parent_id"=>2,"title!="=>"-"])->orderBy("title","asc")->findAll();

        $strlib = new \App\Libraries\StringLibrary();
        $categoriesList=[];
        foreach ($folders as $key => $value) {
            foreach ($categories as $k => $v) { 
                $ct = ROOTPATH.$value["url"]."/".$strlib->getStringToUrl($v["title"],true);
                if (!is_dir($ct)) {
                 mkdir($ct, 0777, true);
                } 
            }
        }

    	$explorerList = [];
        $rootPathList = scandir($this->rootPath,1); 
        foreach ($rootPathList as $key => $value) {
            if (!in_array($value, array('.','..'))) { 
                    $explorerList[]=["type" =>(is_dir($this->rootPath."/".$value)?"folder":"file")
                    ,"path" =>$this->rootPath."/".$value
                    ,"name" =>$value
                    ,"extension" =>pathinfo($this->rootPath."/".$value,PATHINFO_EXTENSION)
                    ,"url"  =>$this->rootUrl."/".$value
                ]; 
            }
        }  

        asort($explorerList);
        $this->data["page"]["explorer_list"] = $explorerList;

        return view('admin/download.php', $this->data);    
    }

    public function Add($value='')
    {
        var_dump($_POST);
        var_dump($_FILES);
        $postFiles = $_FILES;
        $postData =$_POST; 
        var_dump($postData["folder_path"]."/");
        foreach ($postFiles as $key => $value) {
            var_dump($value);
            $file = new \CodeIgniter\Files\File($value["tmp_name"]);
            $file->move(ROOTPATH."public/uploads/downloads/".$postData["folder_path"]."/",$value["name"]);
        }
    }

    public function GetList($path='')
    {
        helper("filesystem");
        $explorerList = [];
        $rootPathList = scandir($this->rootPath."/".$path,1); 
        foreach ($rootPathList as $key => $value) {
            if (!in_array($value, array('.','..'))) { 
            $explorerList[]=["type" =>(is_dir($this->rootPath."/".$path."/".$value)?"folder":"file")
                            ,"path" =>$this->rootPath."/".$path."/".$value
                            ,"name" =>$value
                            ,"extension" =>pathinfo($this->rootPath."/".$path."/".$value,PATHINFO_EXTENSION)
                            ,"url"  =>$this->rootUrl."/".$path."/".$value
                        ];
                # code...
            }
          }  
        //var_dump(scandir($this->rootPath));
        //var_dump(directory_map($this->rootPath,1));
        //scandir($this->rootPath));
        $this->data["page"]["explorer_list"] = $explorerList;

        return view('admin/download.php', $this->data);
    }
}
