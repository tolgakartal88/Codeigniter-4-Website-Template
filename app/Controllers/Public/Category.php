<?php

namespace App\Controllers\Public;

class Category extends BaseController
{
    public function index($val): string
    {
    	$whereClause  = [
    		"m.url" => $val,
    		"m.active"=>1,
    		"c.active"=>1
    	];

    	$category_model = new \App\Models\MenuModel();
    	$category = $category_model->from([],true)
    							   ->select("m.title as category_title,c.*")
    							   ->from("menus as m")
    							   ->join("courses as c","m.id=c.menu_id","left")
    							   ->where($whereClause)
                                   ->where("m.active",1)
                                   ->orderBy("c.row_order","ASC")
    							   ->findAll();
    							  // var_dump($category_model->getLastQuery());
    	$this->data["page"]["category_content"] = $category;
        return view('public/category.php', $this->data);
    }
}
