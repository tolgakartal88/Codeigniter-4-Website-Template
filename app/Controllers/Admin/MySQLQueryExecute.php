<?php
namespace App\Controllers\Admin;
use CodeIgniter\Database\Exceptions\DatabaseException;

class MySQLQueryExecute extends BaseController
{
	public function index():string
	{
		return view('admin/mysql-query-execute.php', $this->data);
	}

	public function Run($value='')
	{
		$result=[];
		$r=[];
		try
		{

			$db = db_connect();
			$db->transException(true)->transStart();

			$query = $db->query($_POST["query"]);
			$r = $query->getResultArray(); 

			$db->transComplete();
		}
		catch(DatabaseException $e)
		{   
			
			$result =[
				"status"=>false,
				"error"=>$e->getMessage(),
				"data"=>null,
			];
			echo json_encode($result); 
			return;
		}

		$result =[
			"status"=>true,
			"error"=>"",
			"data"=>$r,
		];
		echo json_encode($result);
	}
}