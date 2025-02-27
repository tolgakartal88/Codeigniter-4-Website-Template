<?php
namespace App\Libraries;
/**
 * 
 */
class StringLibrary
{ 
	public function getStringToUrl($str,$lover=false)
	{
		$before = array("ı","ö","ü","ğ","ş","ç","İ","Ö","Ü","Ğ","Ş","Ç");
		$after	= array("i","o","u","g","s","c","I","O","U","G","S","C");
		$clean	= str_replace($before, $after, $str);
		$clean	= preg_replace('/[^a-zA-Z0-9 ]/','',$clean);
		$clean	= preg_replace('!\s+!', '-', $clean);
		if ($lover) {
			$clean = strtolower(trim($clean,'-'));
		}
		return $clean;
	}
}