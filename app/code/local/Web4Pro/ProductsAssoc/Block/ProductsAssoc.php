<?php
  class Web4Pro_ProductsAssoc_Block_ProductsAssoc extends Mage_Checkout_Block_Cart_Crosssell
  {
   protected function _construct()
   {
		parent::_construct(); 
		Mage::dispatchEvent('productsassoc_shoppingcart_entrance');
   }  
}
