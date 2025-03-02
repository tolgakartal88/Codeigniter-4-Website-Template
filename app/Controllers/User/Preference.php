<?php

namespace App\Controllers\User;

class Preference extends BaseController
{
	public function index(): string
	{
		return view('user/preference.php', $this->data);
	}

	public function GetList()
	{
		$userPreferenceModel = new \App\Models\UserPreferenceModel();
		$userPreferences = $userPreferenceModel->findAll();
		echo json_encode($userPreferences);
	}
}