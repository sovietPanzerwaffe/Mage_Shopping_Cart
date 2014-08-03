<?php
class Web4Pro_ProductsAssoc_Model_ProductsAssoc_Observer
{
    public function __construct()
    {
		//Mage::register('page_need_reload', false);
    }

    public function products_assoc_form_submit($observer)
    {
		if(!empty($_POST['idsinput']))
		{
			$productsIdsArray = array();
			$productsIdsArray = explode('|',$_POST['idsinput']);
			
			try
			{
				$cart = Mage::getModel('checkout/cart');
				$cart->init();
				$cart->addProductsByIds($productsIdsArray);
				Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
				$cart->save();
				Mage::register('page_need_reload', true);
				/*
				foreach ($cart->getQuote() as $itemId => $itemInfo) 
				{
					$item = $this->getQuote()->getItemById($itemId);
					if (!$item) 
					{
						continue;
					}
		
					if (!empty($itemInfo['remove']) || (isset($itemInfo['qty']) && $itemInfo['qty']=='0')) 
					{
						$this->removeItem($itemId);
						continue;
					}
		
					$qty = isset($itemInfo['qty']) ? (float) $itemInfo['qty'] : false;
					
					if ($qty > 0) 
					{
						$item->setQty($qty);
		
						$itemInQuote = $this->getQuote()->getItemById($item->getId());
		
						if (!$itemInQuote && $item->getHasError()) 
						{
							Mage::throwException($item->getMessage());
						}
		
						if (isset($itemInfo['before_suggest_qty']) && ($itemInfo['before_suggest_qty'] != $qty)) 
						{
							$qtyRecalculatedFlag = true;
							$message = $messageFactory->notice(Mage::helper('checkout')->__('Quantity was recalculated from %d to %d', $itemInfo['before_suggest_qty'], $qty));
							$session->addQuoteItemMessage($item->getId(), $message);
						}
					}
				}*/
			}
			catch(Exception $e)
			{
				return $e->getMessage(); 
			}
		}
    }
    
    public function products_assoc_form_calc_price()
    {
		$cartQuote =  Mage::getSingleton('checkout/session')->getQuote();
		$cartQuote->getBillingAddress();
		$cartQuote->getShippingAddress();
	}
}
