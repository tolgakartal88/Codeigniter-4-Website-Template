<?php

namespace App\Controllers\Admin;

class Course extends BaseController
{
    public function index(): string
    {  
        return view('admin/courses', $this->data);
    } 

    public function Add($value='')
    {
        $postData = $_POST;  
        $dt = new \App\Libraries\DateTimeLibrary();
        $data = [
            "menu_id"=>$postData["menu_id"],
            "title"=>$postData["title"],
            "description"=>$postData["description"],
            "content"=>$postData["content"], 
            "insert_date"=>$dt->getDBDateTimeNow(),
            "tags"=>$postData["tags"],
            "url"=>"/course/".$postData["url"],
            "row_order"=>$postData["row_order"],
            "active"=>($postData["active"]=="1"?1:0),
        ];
 
        $courseModel = new \App\Models\CourseModel();
        $courseModel->insert($data);
        echo json_encode($data);
    }

    public function Remove($value='')
    {
        $postData = $_POST;  
        $whereClause=["id"=>$postData["id"]];
        $courseModel = new \App\Models\CourseModel();
        $courseModel->where($whereClause)->delete();
        array_push($postData, $_POST);
        array_push($postData, $_FILES);
        echo json_encode($postData); 
    }

    public function Update($value='')
    {
        $postData = $_POST;  
        $data = [ 
            "menu_id"=>$postData["menu_id"],
            "title"=>$postData["title"],
            "description"=>$postData["description"],
            "content"=>$postData["content"],
            "tags"=>$postData["tags"],
            "url"=>"/course/".$postData["url"],
            "row_order"=>$postData["row_order"],
            "active"=>($postData["active"]?1:0)
        ];
 
        $courseModel = new \App\Models\CourseModel();
        $courseModel->update($postData["id"],$data);
        
        array_push($postData, $_FILES);
        echo json_encode($postData); 
    }

    public function Get(){
        $postData = $_POST;
        $whereClause = [
            "C.id"=>$postData["id"]
        ];
        $courseModel = new \App\Models\CourseModel();
        $courses = $courseModel->from([],true)
                               ->from("courses as C")
                               ->select("C.*,CT.title as category_title")
                               ->join("menus as CT","CT.id=C.menu_id","left")
                               ->where($whereClause) 
                               ->findAll();

        $courses[0]["url"]= str_replace("/course/", "", $courses[0]["url"]);
        echo json_encode($courses);
    }

    public function GetList()
    {  
        $courseModel = new \App\Models\CourseModel();
        $courses = $courseModel->from([],true)
                               ->from("courses as C")
                               ->select("C.*,CT.title as category_title")
                               ->join("menus as CT","CT.id=C.menu_id","left")
                               ->orderBy("row_order","ASC")
                               ->findAll();
        $dt = new \App\Libraries\DateTimeLibrary();
        foreach ($courses as $key => $value) {
            $courses[$key]["insert_date_str"] = $dt->dbDateTimeToStr($value["insert_date"]);
            $courses[$key]["insert_date_ellapsed"]=$dt->getElapsedTime($value["insert_date"]);
        }

        echo json_encode($courses);
    }
}
