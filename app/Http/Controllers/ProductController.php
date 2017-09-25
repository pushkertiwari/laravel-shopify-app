<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function fetchProducts(){
		$sh = $this->_getShopifyObject();
		$result = $sh->call([ 
			'METHOD'    => 'GET', 
			'URL'       => '/admin/products.json?page=1' 
		]); 
		$products = $result->products; 

    // Print out the title of each product we received 
		foreach($products as $product) { 
			echo ' ' . $product->id . ': ' . $product->title . ' '; 
		} 
	}

	public function showTabs(){
		return view('tabs');
	}
}
