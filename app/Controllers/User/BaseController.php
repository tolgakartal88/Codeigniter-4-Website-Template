<?php

namespace App\Controllers\User;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */

    protected $session;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        
        $this->session = session();
        $this->data["page"]["settings"]["title"] = "Tolga KARTAL - Anasayfa";
        $this->data["page"]["settings"]["nav_title"] = "Tolga KARTAL";
        $this->session = session();
        $user_in = ($this->session->has('user')?1:0);
        $admin_in =($this->session->has('user') && $this->session->get('user')["is_admin"]=='1' ? 1 : 0);
 
        $whereClause = [];
        if ($admin_in==1) {
            $whereClause    = ["menus.is_admin"=>1];
        }
        else if($user_in==1){
            $whereClause    = ["menus.is_user"=>1];
        }
        else{
            $whereClause    = ["menus.is_public"=>1];
        }
  
        $menus_model = new \App\Models\MenuModel();  
        $menus = $menus_model->select("menus.*
                                                ,ms.id as sub_id
                                                ,ms.title as sub_title
                                                ,if(ms.parent_id=2,concat('category/',ms.url),ms.url) as sub_url
                                                ,ms.active as sub_active")
                                       ->where("menus.parent_id",null) 
                                       ->join("menus as ms","menus.id = ms.parent_id","left")
                                       ->where($whereClause)
                                       ->where("menus.active",1)  
                                       ->where("(ms.active=1 OR ms.active IS NULL)")   
                                       ->orderBy("parent_row_order","ASC")
                                       ->orderBy("ms.row_order","ASC")
                                       ->findAll();    
 
        $parent_id = 0;
        $index = 0;
        foreach ($menus as $key => $value) {
            if ($value["sub_id"]!=null && $parent_id!=$value["id"]) {
                $this->data["page"]["menus"][] =
                [ 
                    "title"=>$value["title"]
                    ,"url"=>"/" 
                    ,"sub_menu"=>[]
                ];
                $parent_id = $value["id"];
                $index = count($this->data["page"]["menus"])-1;

            }

            if ($value["sub_id"]==null){
                $this->data["page"]["menus"][] =
                [ 
                    "title"=>$value["title"]
                    ,"url"=>$value["url"] 
                    ,"sub_menu"=>null
                ];

                $parent_id = $value["id"];
            }

            if($value["sub_id"]!=null && $value["id"] == $parent_id)
            {
                $this->data["page"]["menus"][$index]["sub_menu"][] = 
                [
                    "sub_title"=>$value["sub_title"] 
                    ,"sub_url"=>$value["sub_url"] 

                ];
                $parent_id = $value["id"];
            }
            
        }   
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
