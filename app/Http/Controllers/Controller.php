<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
    	$this->appSettings = DB::table('tbl_appsettings')->first();
    }


     public function doAuth($shop){
       $shopify = $this->_getShopifyObject($shop);

        $permissions_url  = $shopify->installURL([
            'permissions' => json_decode($this->appSettings->permissions, true),
            'redirect'    => $this->appSettings->redirect_url
        ]);

        return view('authurl', ['installurl' => $permissions_url]);
    }


    public function _checkParameters()
	{
		if( empty($_GET['hmac']) || empty($_GET['shop']) || empty($_GET['timestamp']))
		{
			echo "Sorry : Something is not right.";
			die;
		}
	}

    public  function _getShopifyObject($shop = '', $access_token = ''){

    	return $shopify = app()->makeWith('ShopifyAPI', [ 
    		'API_KEY'      => $this->appSettings->api_key,
    		'API_SECRET'   => $this->appSettings->shared_secret,
    		'ACCESS_TOKEN' => $access_token,
    		'SHOP_DOMAIN'  => $shop
    	]); 
    }
}
