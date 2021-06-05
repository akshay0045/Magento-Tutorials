<?php

namespace Mythememodule\Mymodule\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Mythememodule\Mymodule\Model\ArticalFactory;

class Edit extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $resource;
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ArticalFactory $articalFactory,
        \Magento\Framework\App\ResourceConnection $resource
    ) {
        parent::__construct(
            $context
        );
        $this->resultPageFactory = $resultPageFactory;
        $this->_articalFactory = $articalFactory;
        $this->resource = $resource;
    }

    /**
     * Prints the information 
     * @return Page
     */
    public function execute()
    {

        if ($this->getRequest()->isPost()) {

            $input = $this->getRequest()->getPostValue();
            /*$connection  = $this->resource->getConnection();

            $data =[
                'article_id' => $input['id'],
                'article_subject' => $input['article_subject'],
                'content' => $input['content'],
            ];
            $id = $input['id'];
            $where = ['article_id = ?' => (int)$id];

            $tableName = $connection->getTableName("mythemmodule_article");

            $connection->update($tableName, $data, $where);*/

            $input = $this->getRequest()->getPostValue();

            $artical = $this->_articalFactory->create()->load($input['id'], 'article_id');
            //print_r($artical->getData()); exit;

            $artical->setData([
                'article_id' => $input['id'],
                'article_subject' => $input['article_subject'],
                'content' => $input['content'],
            ]);

            $artical->setId($input['id'], 'article_id');

            $artical->save();

            $this->messageManager->addSuccessMessage(__("Data Edited Successfully."));

            return $this->_redirect('mymodule');
        }else{
            return $this->resultPageFactory->create();
        }
    }
}