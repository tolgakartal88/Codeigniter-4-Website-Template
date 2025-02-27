<?php

namespace App\Controllers\Admin;

class Admin extends BaseController
{
    public function index(): string
    {  
        return view('admin/admin-panel.php', $this->data);
    } 
 
}
