<?php

namespace Mythememodule\Mymodule\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Mythememodule\Mymodule\Model\ArticalFactory;

class Delete extends Action
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
        ArticalFactory $articalFactory
    ) {
        parent::__construct(
            $context
        );
        $this->resultPageFactory = $resultPageFactory;
        $this->_articalFactory = $articalFactory;
    }

    /**
     * Prints the information 
     * @return Page
     */
    public function execute()
    {

        $id = $this->getRequest()->getParam('id');
        $artical = $this->_articalFactory->create();
        $artical->setId($id);
        $artical->delete();
        $this->messageManager->addSuccessMessage(__("Data Deleted Successfully."));
        return $this->_redirect('mymodule');
    }
}