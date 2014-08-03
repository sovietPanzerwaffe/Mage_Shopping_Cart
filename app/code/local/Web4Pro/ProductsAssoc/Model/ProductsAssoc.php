<?php
 
class Web4Pro_ProductsAssoc_Model_ProductsAssoc extends Mage_Core_Model_Abstract
{
	protected $_crossCellProductsArray;
	protected $_productsInCartIds;
	
    public function _construct()
    {   
		parent::_construct();
        $this->_init('productsassoc/productsassoc');
    }
   
}
