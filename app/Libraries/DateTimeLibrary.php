<?php 

/**
 * 
 */
namespace App\Libraries; 
 
class DateTimeLibrary
{
	
	function __construct()
	{ 
		
	} 

	public static function getDBDateTimeNow():string
	{
		$now = new \DateTime("now",new \DateTimeZone("Europe/Istanbul"));
		return $now->format("Y-m-d H:i:s");
	}

	public static function strToDbDateTime($date_str):\DateTime
	{ 
		$dt = new \DateTime($date_str,new \DateTimeZone("Europe/Istanbul")); 
		return new \DateTime($dt,new \DateTimeZone("Europe/Istanbul"));
	}

	public static function dbDateTimeToStr($date_str):string
	{
		$dt = new \DateTime($date_str,new \DateTimeZone("Europe/Istanbul")); 
		return $dt->format("H:i:s d.m.Y");
	}

	public static function getElapsedTime($date_str)
	{    
		$dt = new \DateTime($date_str,new \DateTimeZone("Europe/Istanbul"));
		$now = new \DateTime("now",new \DateTimeZone("Europe/Istanbul"));   
		//echo $now->diff($dt)->format("%r %y years ,%m month, %d days, %h hours, %i minutes,%s seconds");

		$elapsed="";
		if ((int)$now->diff($dt)->format("%y")>0) {
			$elapsed.= $now->diff($dt)->format("%y")." yıl";
		}
		elseif ((int)$now->diff($dt)->format("%m")>0) {
			$elapsed.= $now->diff($dt)->format("%m")." ay";
		}
		elseif ((int)$now->diff($dt)->format("%d")>0) {
			$elapsed.= $now->diff($dt)->format("%d")." gün";
		}
		elseif ((int)$now->diff($dt)->format("%h")>0) {
			$elapsed.= $now->diff($dt)->format("%h")." saat";
		}
		elseif ((int)$now->diff($dt)->format("%i")>0) {
			$elapsed.= $now->diff($dt)->format("%i")." dakika";
		}
		elseif ((int)$now->diff($dt)->format("%s")>0) {
			if($now->diff($dt)->format("%s")<10)
				$elapsed.="Biraz";
			else
				$elapsed.= $now->diff($dt)->format("%s")." saniye";
		}

		return $elapsed." önce";
	}
}