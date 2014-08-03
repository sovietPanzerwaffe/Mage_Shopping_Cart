<?php
 
class Web4Pro_News_Block_Adminhtml_Authors_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'news';
        $this->_controller = 'adminhtml_authors';
        $this->_updateButton('save', 'label', Mage::helper('news')->__('Save Author'));
        $this->_updateButton('delete', 'label', Mage::helper('news')->__('Delete Author'));
    }   
	
	protected function _prepareLayout() 
	{
		parent::_prepareLayout();
		if(Mage::getModel('cms/wysiwyg_config')->isEnabled()) 
		{
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
	}
 
    public function getHeaderText()
    { 
        if( Mage::registry('author_data') && Mage::registry('author_data')->getId() ) 
        {
            return Mage::helper('news')->__("Edit Author '%s'", $this->htmlEscape(Mage::registry('author_data')->getName()));
        } 
        else 
        {
            return Mage::helper('news')->__('Add Author');
        }
    }
}
