<?php
class Web4Pro_News_Block_Adminhtml_Authors_Renderer_AuthorsRenderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
		
		$authors = Mage::getModel('news/authors')->getAuthorsArray();
        $authorName =  $row->getData('author');
        $authorId = array_search($authorName, $authors);
        if($authorId)
        {
			return '<a href="'.$this->getUrl('*/authors/edit', array('id' => $authorId)).'">'.$authorName.'</a>';
		}
		return '';
    }
}
?>
