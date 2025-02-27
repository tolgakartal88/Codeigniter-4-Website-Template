<?php
namespace App\Controllers\Admin; 

class Test extends BaseController
{
	public function index():string
	{
		return view('admin/test.php', $this->data);
	}

	public function Upload($value='')
	{
		sleep(1);
	}

	public function Ckeditor($value='')
	{
		return view('admin/test-ckeditor.php', $this->data);
	}
}