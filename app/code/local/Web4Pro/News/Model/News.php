<?php
 
class Web4Pro_News_Model_News extends Mage_Core_Model_Abstract
{
	protected $_authors;
	
    public function _construct()
    {
        parent::_construct();
        $this->_init('news/news');
    }
    public function getCollectionForHomePage()
    {
		$collection = $this->getCollection();
        $collection->setPageSize(2);
        $collection->setOrder('created_time','DESC');
        return $collection;
 	}
 	
 	public function getCollectionForGrid()
 	{
		$collection = parent::getCollection();
		$this->_authors = Mage::getModel('news/authors')->getAuthorsArray();
        foreach($collection as $element)
        {
			$authorId = $element->getAuthor();
			if( array_key_exists($authorId, $this->_authors))
			{
				$element->setAuthor($this->_authors[$authorId]);
			}
			else
			{
				$element->setAuthor('');
			}
		}
		return $collection;
	}	
}
