<?php
 
class Web4Pro_News_Adminhtml_AuthorsController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('news/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        if(Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) 
		{
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
        return $this;
    }   
   
    public function indexAction() 
    {
        $this->_initAction();   
		$this->_addContent($this->getLayout()->createBlock('news/adminhtml_authors'));
        $this->renderLayout();
    }
 
    public function editAction()
    {
        $authorId     = $this->getRequest()->getParam('id');
        $authorModel  = Mage::getModel('news/authors')->load($authorId);
        if ($authorModel->getId() || $authorId == 0) 
        {
            Mage::register('author_data', $authorModel);
            $this->loadLayout();
            $this->_setActiveMenu('news/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Authors Manager'), Mage::helper('adminhtml')->__('Authors Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Authors'), Mage::helper('adminhtml')->__('Item Authors'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('news/adminhtml_authors_edit'))
                 ->_addLeft($this->getLayout()->createBlock('news/adminhtml_authors_edit_tabs'));
            $this->renderLayout();
        } 
        else 
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
    
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) 
        {
            try 
            {
                $authors = Mage::getModel('news/authors');
				$authorId = $this->getRequest()->getParam('id');
                $authors->setId($this->getRequest()->getParam('id'))
                    ->delete();
                $newsCollection = Mage::getModel('news/news')->getCollection();
				$newsCollection->addFieldToFilter('author',$authorId);
				foreach($newsCollection as $news)           
				{
					$news->setAuthor(NULL);
				}
				$newsCollection->save();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } 
            catch (Exception $e) 
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function newAction()
    {
       $this->_forward('edit');
    }
   
    public function saveAction()
    {
         if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $newsModel = Mage::getModel('news/authors');
                //echo var_dump($postData); die();
                $newsModel->setId($this->getRequest()->getParam('id'))
                    ->setName($postData['name'])
					->setAnnotation($postData['annotation'])
                    ->save();
         
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setNewsData(false);
 
                $this->_redirect('*/*/');
                return;
            } 
            catch (Exception $e) 
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setNewsData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('news/adminhtml_authors_grid')->toHtml()
        );
    }
}
