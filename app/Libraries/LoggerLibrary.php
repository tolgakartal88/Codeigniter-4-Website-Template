<?php
namespace App\Libraries;
use App\Libraries\DateTimeLibrary;
use CodeIgniter\HTTP\RequestInterface;
/**
 * 
 */
class LoggerLibrary
{  
	public static function sendUserLog($description):bool
	{ 
		$session = session();
		$userSession = $session->get("user"); 

		$userLog = new \App\Models\UserLogModel();
		$userInfo = [
			  'user_id'=>$userSession["id"]
			 ,'action_time' =>DateTimeLibrary::getDBDateTimeNow()
			 ,'description'=>$description 
		];
		DateTimeLibrary::getDBDateTimeNow();
		$getInfo = self::getInfo();

		$values = array_merge($userInfo,$getInfo);
		$userLog->insert($values);
		//LoggerLibrary::getInfo();
		return true;
	}

	private static function getInfo():array
	{
		$resultValues =[
			 "platform"=>"" 
			,"ip_address"=>""
			,"agent"=>""
		];

		$request = \Config\Services::request();
    	$agent = $request->getUserAgent();
    	if ($agent->isBrowser()) {
    		$resultValues["agent"] = $agent->getBrowser(); 
    	}else if($agent->isRobot()){
    		$resultValues["agent"] = $agent->getRobot();
    	}else if($agent->isMobile()){
    		$resultValues["agent"] = $agent->getMobile();
    	}else if($agent->isRobot()){
    		$resultValues["agent"] = "Undefined";
    	}
 
    	//var_dump($request->isValidIP($request->getIPAddress()));
    	$resultValues["ip_address"] = $request->getIPAddress();
    	//var_dump($agent->getReferrer());

    	$resultValues["platform"] = $agent->getPlatform();

    	return  $resultValues;
		
	}
}