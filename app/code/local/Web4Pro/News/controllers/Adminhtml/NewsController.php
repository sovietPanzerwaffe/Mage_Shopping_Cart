<?php
 
class Web4Pro_News_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
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
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('news/adminhtml_news'));
        $this->renderLayout();
    }
 
    public function editAction()
    {
        $newsId     = $this->getRequest()->getParam('id');
        $newsModel  = Mage::getModel('news/news')->load($newsId);
        if ($newsModel->getId() || $newsId == 0) {
 
            Mage::register('news_data', $newsModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('news/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('news/adminhtml_news_edit'))
                 ->_addLeft($this->getLayout()->createBlock('news/adminhtml_news_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
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
                //echo var_dump($postData); die();
                $newsModel = Mage::getModel('news/news');
                $newsModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
					->setMain($postData['main'])
					->setAuthor($postData['author'])
                    ->setCreatedTime(date('m/d/Y h:i:s a', time()))
					->setDescription($postData['description'])
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setNewsData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setNewsData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $newsModel = Mage::getModel('news/news');
               
                $newsModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('news/adminhtml_news_grid')->toHtml()
        );
    }
}
