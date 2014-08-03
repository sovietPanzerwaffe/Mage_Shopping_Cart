<?php
 class Web4Pro_ProductsAssoc_IndexController extends Mage_Core_Controller_Front_Action
 {
	public function preDispatch()
	{
		$this->loadLayout();
		$this->renderLayout();
	}
    public function indexAction()
    {
		//echo var_dump($_POST); die();
	}
    
 }
