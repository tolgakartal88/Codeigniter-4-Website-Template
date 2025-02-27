<?php

namespace App\Controllers\Public;

class Contact extends BaseController
{
    public function index(): string
    {
    	$settingModel = new \App\Models\SettingModel();
    	$settings = $settingModel->from([],true)
    							 ->from("settings as s")
    							 ->join("setting_groups as sg","sg.id=s.set_group_id","left")
    							 ->whereIn("sg.set_group_key",["SOCIAL","CONTACT"])
    							 ->findAll();
    	$this->data["page"]["contact"] = $settings;
        return view('public/contact.php', $this->data);
    }
}
