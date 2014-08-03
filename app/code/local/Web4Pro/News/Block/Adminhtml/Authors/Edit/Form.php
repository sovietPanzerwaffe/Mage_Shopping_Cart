<?php
 
class Web4Pro_News_Block_Adminhtml_Authors_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
       $form = new Varien_Data_Form(array(
                                        'id' => 'edit_form',
                                       'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                                        'method' => 'post',
                                     ));					
									
		//echo var_dump($form->getId()); die();
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
