<?php
class CartWidget extends CWidget
{
    public function run()
    {       
		$cartItems = array();
		$total_items = 0;
		$ListModelProduct = TspProduct::getListProductFromCookie($cartItems);
		if(count($cartItems)){
			foreach($cartItems['id'] as $key=>$product_id) {
				$total_items += $cartItems['qty'][$key];
			}
		}
        $this->render('cartbox', array('total_items'=>$total_items));
    }
}