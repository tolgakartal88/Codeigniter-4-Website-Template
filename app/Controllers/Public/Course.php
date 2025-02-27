<?php

namespace App\Controllers\Public;
use PhpOffice\PhpWord\PhpWord; 
use PhpOffice\PhpWord\Writer\Word2007;
class Course extends BaseController
{
  public function index($url): string
  { 
   $course_model = new \App\Models\CourseModel();
   $course = $course_model ->from([],true)
   ->from("courses as C")
   ->select("C.*,Ct.title as category_title,Ct.url as category_url")
   ->join("menus as Ct","C.menu_id = Ct.id","left")
   ->where(["C.active"=>1,"C.url"=>"/course/".$url])
   ->orderBy("C.row_order","ASC")
   ->findAll(); 
   $this->data["page"]["course_content"] = $course;
   return view('public/course.php', $this->data);
 }

 public function DownloadWordDocument()
 {
  $course_model = new \App\Models\CourseModel();
  $postData = $_POST;
  $course = $course_model->where(["id"=>$postData["id"]])->first();  
  $phpWord = new PhpWord();
  $section = $phpWord->addSection();
      //$section->addText('Hello World!');
  \PhpOffice\PhpWord\Shared\Html::addHtml($section,str_replace("<br>","",str_replace("\n","", $course["content"])),false,false);
  $file = $course["menu_id"]."_".$course["title"].".docx";
  $filePath = WRITEPATH."uploads/".$file;
  header("Content-Description: File Transfer");
  header('Content-Disposition: attachment; filename="' . $file . '"');
  header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
  header('Content-Transfer-Encoding: binary');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Expires: 0');
  $phpWord->save($filePath,"Word2007");
  $this->response->download($filePath,null)->setFileName($file);
  }
}