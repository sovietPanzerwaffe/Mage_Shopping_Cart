<?php
 
class Web4Pro_News_Block_Adminhtml_Authors_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('author_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('news')->__('Authors Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('news')->__('Author Information'),
            'title'     => Mage::helper('news')->__('Author Information'),
            'content'   => $this->getLayout()->createBlock('news/adminhtml_authors_edit_tab_form')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}
