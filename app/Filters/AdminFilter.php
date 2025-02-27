<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
class AdminFilter implements FilterInterface
{  
    public function before(RequestInterface $request, $arguments = null)
    { 
        $session = session(); 
        if (!$session->has("user") || !$session->get('user')["is_admin"]=='1') {
            $data["errors"] = [
                "code"=>"FLTR_ADMIN",
                "error"=>"Sayfaya Giriş Yetkiniz Yok",
                "solutions"=>[
                    "Kullanıcınızın yetkisini kontrol ediniz",
                    "Admin Kullanıcısı ile giriş yaparak tekrar deneyin"
                ]
            ];
           return \Config\Services::response()->setBody(view("/errors/adminerror",$data));
        }
    }

    public function after(RequestInterface $request,ResponseInterface $response, $arguments = null)
    {

    } 
}