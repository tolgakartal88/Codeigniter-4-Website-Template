<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
class SessionFilter implements FilterInterface
{  
    public function before(RequestInterface $request, $arguments = null)
    {
    	/*var_dump( $request->getUserAgent());
    	$agent = $request->getUserAgent();
    	if ($agent->isBrowser()) {
    		var_dump($agent->getBrowser());
    		# code...
    	}else if($agent->isRobot()){
    		var_dump($agent->getRobot());
    	}else if($agent->isMobile()){
    		var_dump($agent->getMobile());
    	}else if($agent->isRobot()){
    		var_dump("Undefined");
    	}

    	if ($agent->isMobile("iphone")) {
    		echo "IPhone";
    	}

    	if ($agent->isMobile("android")) {
    		echo "Android";
    	}
    	//var_dump($request->isValidIP($request->getIPAddress()));
    	var_dump($request->getIPAddress());
    	var_dump($agent->getReferrer());

    	var_dump($agent->getPlatform());
		*/
        $session = session(); 
        if (!$session->has("user")) {
           $data["errors"] = [
           		"code"=>"FLTR_SESSION",
                "error"=>"Sayfaya Giriş Yetkiniz Yok",
                "solutions"=>[
                    "Kullanıcınızın girişi yapınız.",
                    "Kullanıcınızın sayfayı kullanma yetkisi olup olmadığını kontrol ediniz."
                ]
            ];
           return \Config\Services::response()->setBody(view("/errors/adminerror",$data));
        }
    }

    public function after(RequestInterface $request,ResponseInterface $response, $arguments = null)
    {

    } 
}