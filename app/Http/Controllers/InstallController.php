<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class InstallController extends Controller
{
    //
    public function __construct()
    {
    	parent::__construct();
    }

    public function access(Request $request){

      /*  if(Session::has('access_token')){
            $sh = $this->_getShopifyObject(Session::get('shop'), Session::get('access_token'));
            return redirect('/');
        }
        else {*/
            if(!empty($request->input('storeName')))
            {
                if(strpos($request->input('storeName'), '.myshopify.com' ) !== false )
                {
                   return redirect()->back()->withInput()->with('error', 'Remove \'.myshopify.com\' from Store Name.');
                }
                $shop = $request->input('storeName').".myshopify.com";
                return $this->doAuth($shop);
            }
            else
            {
                return redirect()->back()->withInput()->with('error', 'Please Enter your Shopify Store Name.');
            }
      /*  }*/
    }

    public function authCallback (Request $request){
       // dd($request->all());
        $shop = $request->shop;
        $shopify =  $this->_getShopifyObject($shop);
        $code = $_GET['code'];
        $access_token = $shopify->getAccessToken($code);
       
        $flag = 0;
        $flag = DB::table('tbl_usersettings')->where('store_name', $shop)->count();
        if($flag == 0) {
            DB::table('tbl_usersettings')->insert(['access_token'=> $access_token, 'store_name'=> $shop]);
        } else {
            DB::table('tbl_usersettings')->where('store_name', $shop)->update(['access_token'=> $access_token]);
        }
        return redirect('https://'.$shop.'/admin/apps');
    }

}
