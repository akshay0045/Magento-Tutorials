<?php
namespace Mythememodule\Mymodule\Block;

use \Magento\Framework\View\Element\Template;

class Article extends Template
{
    /**
     * Constructor
     *
     * @param Context $context
     * @param array $data
    */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Mythememodule\Mymodule\Model\ArticalFactory $articalFactory
    ){
        parent::__construct($context);
        $this->_articalFactory = $articalFactory;
     }

    /**
     * @return Post[]
    */
    public function getArticles()
    {
        //return 'getArticles function of the Block class called successfully';
        $artical = $this->_articalFactory->create();
        $collection = $artical->getCollection();
        return $collection;
    }

    public function getSingleArtical()
     {
        $id = $this->getRequest()->getParam('id');
        $singleArtical = $this->_articalFactory->create()->load($id, 'article_id');
        return $singleArtical;
     }
}
?>