<?php
class Web4Pro_News_IndexController extends Mage_Core_Controller_Front_Action
{
	public function preDispatch()
	{
			$this->loadLayout();
            $this->renderLayout();
	}
	
	
	
    public function indexAction()
    {
		
    }
    
   
    public function viewAction()
    {

	}
	
}
