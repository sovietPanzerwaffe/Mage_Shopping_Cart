<?php
 
class Web4Pro_News_Model_Mysql4_Authors extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('news/authors', 'author_id');
    }
}
