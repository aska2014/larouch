<?php

class Larouch2012_Sp_Images_Controller extends Controller {

	public function action_index() {

		//$products = Product::where('id', '<', '14')->get();

		foreach ($products as $product) {
			
			$image = new SimpleImage($product->img());
			$image->save('products_no/product'.$product->id.'.jpg');

			$image->resize_crop(635,371);
			$image->save( 'products/product'.$product->id.'.jpg');

			$image->resize_crop(220,120);
			$image->save( 'products_sp/product'.$product->id.'.jpg');

			$image->resize_crop(205,143);
			$image->save( 'products_th/product'.$product->id.'.jpg');

		}


	}

}