<?php
namespace App\Controllers\Admin; 

class TemplateHtml extends BaseController
{
	public function index():string
	{
		return view('admin/template-html.php', $this->data);
	}

	public function Add($value='')
	{
		$postData = $_POST;  
        $data = [
            "title"=>$postData["title"],
            "content"=>$postData["content"]
        ]; 
        $templateModel = new \App\Models\TemplateHtmlModel();
        $templateModel->insert($data);
        echo json_encode($postData);
	}

	public function Remove($value='')
	{
		$postData = $_POST;  
        $whereClause=["id"=>$postData["id"]];
        $templateModel = new \App\Models\TemplateHtmlModel();
        $templateModel->where($whereClause)->delete();
        array_push($postData, $_POST);
        array_push($postData, $_FILES);
        echo json_encode($postData); 
	}

	public function Update($value='')
	{
		$postData = $_POST;  
        $data = [
            "title"=>$postData["title"],
            "content"=>$postData["content"]
        ]; 
        $templateModel = new \App\Models\TemplateHtmlModel();
        $templateModel->update($postData["id"],$data);
        
        array_push($postData, $_FILES);
        echo json_encode($postData); 
	}

	public function Get($value='')
	{
		$postData = $_POST;
        $whereClause = [
            "id"=>$postData["id"]
        ];
        $templateModel = new \App\Models\TemplateHtmlModel();
        $template = $templateModel->where($whereClause)->findAll();
        echo json_encode($template);
	}

	public function GetList($value='')
	{
		$templateModel = new \App\Models\TemplateHtmlModel();
		$templates = $templateModel->orderBy("title","ASC")->findAll();

		echo json_encode($templates);
	} 

	public function Preview($value='')
	{
		$postData = $_POST;
        $whereClause = [
            "id"=>$postData["id"]
        ];
		$templateModel = new \App\Models\TemplateHtmlModel();
		$templates = $templateModel->where($whereClause)->first();

		
        echo json_encode($templates["content"]);
	}
}