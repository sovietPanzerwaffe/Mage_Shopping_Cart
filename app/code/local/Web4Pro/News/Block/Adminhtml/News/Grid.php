<?php
 
class Web4Pro_News_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	protected $_authors;
    public function __construct()
    {
        parent::__construct();
        $this->setId('newsGrid');
        $this->setDefaultSort('news_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('news/news')->getCollectionForGrid();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('news_id', array(
            'header'    => Mage::helper('news')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'news_id',
        ));
 
        $this->addColumn('title', array(
            'header'    => Mage::helper('news')->__('Title'),
            'width'     => '80px',
            'align'     =>'left',
            'index'     => 'title',
        ));

		
		$this->addColumn('description', array(
            'header'    => Mage::helper('news')->__('Item Short Description'),
            'width'     => '250px',
            'index'     => 'description',
        ));
        
 
        $this->addColumn('created_time', array(
            'header'    => Mage::helper('news')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '30px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));
        
         $this->addColumn('author', array(
            'header'    => Mage::helper('news')->__('Author'),
            'align'     => 'left',
            'width'     => '30px',
            'index'   => 'author',
            'renderer'     => 'Web4Pro_News_Block_Adminhtml_Authors_Renderer_AuthorsRenderer',
        ));
 
       

 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}
