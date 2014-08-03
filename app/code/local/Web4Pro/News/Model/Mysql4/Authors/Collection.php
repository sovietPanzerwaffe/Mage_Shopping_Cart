<?php
 
class Web4Pro_News_Model_Mysql4_Authors_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('authors/authors');
    }
}
