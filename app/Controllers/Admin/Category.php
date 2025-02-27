<?php

namespace App\Controllers\Admin;

class Category extends BaseController
{
    public function index(): string
    {  
        return view('admin/categories', $this->data);
    } 

    public function Add($value='')
    {
        $postData = $_POST;  
        $data = [
            "parent_id"=>2,
            "title"=>$postData["title"],
            "url"=>$postData["url"],
            "row_order"=>$postData["row_order"],
            "active"=>($postData["active"]?1:0)
        ]; 
 
        $categoryModel = new \App\Models\MenuModel();
        $categoryModel->insert($data);
        array_push($postData, $_POST);
        array_push($postData, $_FILES);
        echo json_encode($postData); 
    }
    public function Remove($value='')
    { 
        $postData = $_POST;  
        $whereClause=["id"=>$postData["id"]];
        $categoryModel = new \App\Models\MenuModel();
        $categoryModel->where($whereClause)->delete();
        array_push($postData, $_POST);
        array_push($postData, $_FILES);
        echo json_encode($postData); 
    }
    
    public function Update($value='')
    {
        $postData = $_POST;  
        $data = [ 
            "parent_id"=>2,
            "title"=>$postData["title"],
            "url"=>$postData["url"],
            "row_order"=>$postData["row_order"],
            "active"=>($postData["active"]=="true"?1:0)
        ]; 
 
        $categoryModel = new \App\Models\MenuModel();
        $categoryModel->update($postData["id"],$data); 
        array_push($postData, $_POST);
        array_push($postData, $_FILES);
        echo json_encode($postData); 
       // var_dump($_FILES);
    }

    public function Get($value='')
    {
        $postData = $_POST;
        $whereClause = [
            "id"=>$postData["id"]
        ];
        $categoryModel = new \App\Models\MenuModel();
        $categories = $categoryModel->where($whereClause)
                                    ->orderBy("row_order","asc")
                                    ->findAll();
        $categories[0]["url"]= $categories[0]["url"];
        echo json_encode($categories);
    }

    public function GetList($value='')
    {
        $whereClause = ["parent_id"=>2];
        if (isset($_POST["seperator"]) && $_POST["seperator"]=="false"){
            $whereClause["title!="]="-";
        } 
        $categoryModel = new \App\Models\MenuModel();
        $categories = $categoryModel->where($whereClause)
                                    ->orderBy("row_order","asc")
                                    ->findAll();

       echo json_encode($categories);
   }

}
