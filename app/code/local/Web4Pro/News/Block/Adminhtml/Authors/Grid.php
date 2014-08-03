<?php
 
class Web4Pro_News_Block_Adminhtml_Authors_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	protected $_authors;
    public function __construct()
    {
        parent::__construct();
        $this->setId('authorsGrid');
        $this->setDefaultSort('authors_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('news/authors')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('author_id', array(
            'header'    => Mage::helper('news')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'author_id',
        ));
 
        $this->addColumn('name', array(
            'header'    => Mage::helper('news')->__('Name'),
            'width'     => '80px',
            'align'     =>'left',
            'index'     => 'name',
        ));

		
		$this->addColumn('annotation', array(
            'header'    => Mage::helper('news')->__('Annotation'),
            'width'     => '250px',
            'index'     => 'annotation',
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
