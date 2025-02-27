<?php
namespace App\Controllers\Public;
use App\Libraries\LoggerLibrary;
class Home extends BaseController
{
    public function index(): string
    { 
    	$db      = \Config\Database::connect();
    	$sql = 'SELECT * FROM 
                        (select 
                            ROW_NUMBER() over (PARTITION BY menu_id ORDER BY C.insert_date DESC) AS po
                            , M.title AS category_title
                            , C.* 
                        from courses AS C left join menus AS M on C.menu_id = M.id 
                        WHERE M.active=1 and C.active=1) AS tbl 
                where po<=5'; 
    	$query = $db->query($sql); 
    	$result = $query->getResultArray(); 

    	$groupedItems = array_reduce($result, function ($carry, $item) {
		    $carry[$item['category_title']][] = $item;
		    return $carry;
		}, []);
		$this->data["page"]["last_courses"] = $result;
		$this->data["page"]["last_categories"] = array_keys($groupedItems);
        return view('public/home.php', $this->data);
    }
 
}
