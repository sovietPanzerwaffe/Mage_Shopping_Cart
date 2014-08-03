<?php
 
class Web4Pro_News_Block_Adminhtml_Authors_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

	
    protected function _prepareForm()
    { 
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('authors_form', array('legend'=>Mage::helper('news')->__('Author information')));
		
		$wysiwygConfig = Mage::getModel('cms/wysiwyg_config')->getConfig(array(
												'add_variables' => false, 
												'add_widgets' => false, 
												'files_browser_window_url' => $this->getBaseUrl() . 'admin/cms_wysiwyg_images/index/'
												));

        $fieldset->addField('name', 'text', array(
            'label'     => Mage::helper('news')->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'name',
        ));
 
       
        $fieldset->addField('annotation', 'editor', array(
            'name'      => 'annotation',
            'label'     => Mage::helper('news')->__('Annotation'),
            'title'     => Mage::helper('news')->__('Annotation'),
            'style'     => 'height:12em;',
            'config'    => $wysiwygConfig,
            'wysiwyg'   => true,
            'required'  => true,
        ));
        
        
        if ( Mage::getSingleton('adminhtml/session')->getNewsData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getNewsData());
            Mage::getSingleton('adminhtml/session')->setNewsData(null);
        } 
        elseif ( Mage::registry('author_data') ) 
        {
            $form->setValues(Mage::registry('author_data')->getData());
        }
        return parent::_prepareForm();
    }
}
