<?php
 
class Web4Pro_News_Block_Adminhtml_News_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

	
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $authors = Mage::getModel('news/authors')->getAuthorsArray();
        $fieldset = $form->addFieldset('news_form', array('legend'=>Mage::helper('news')->__('Item information')));
		$wysiwygConfig = Mage::getModel('cms/wysiwyg_config')->getConfig(array(
												'add_variables' => false, 
												'add_widgets' => false, 
												'files_browser_window_url' => $this->getBaseUrl() . 'admin/cms_wysiwyg_images/index/'
												));
       
       
       
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('news')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
 
       
        $fieldset->addField('main', 'editor', array(
            'name'      => 'main',
            'label'     => Mage::helper('news')->__('Content'),
            'title'     => Mage::helper('news')->__('Content'),
            'style'     => 'height:12em;',
            'config'    => $wysiwygConfig,
            'wysiwyg'   => true,
            'required'  => true,
        ));
        		
		$fieldset->addField('description', 'editor', array(
            'name'      => 'description',
            'label'     => Mage::helper('news')->__('Short Annotation'),
            'title'     => Mage::helper('news')->__('Short Annotation'),
            'style'     => 'height:12em;',
            'config'    => $wysiwygConfig,
            'wysiwyg'   => true,
            'required'  => true,
        ));
        

		
		
        $fieldset->addField('author', 'select', array(
            'label'     => Mage::helper('news')->__('Author'),
            'name'      => 'author',
            'values'    => $authors,
            'selected'  => 'author',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getNewsData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getNewsData());
            Mage::getSingleton('adminhtml/session')->setNewsData(null);
        } 
        elseif 
        ( Mage::registry('news_data') ) 
        {
            $form->setValues(Mage::registry('news_data')->getData());
        }
        return parent::_prepareForm();
    }
}
