<?php

namespace Mythememodule\Mymodule\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Mythememodule\Mymodule\Model\ArticalFactory;

class Insert extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $_articalFactory;
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
        if ($this->getRequest()->isPost()) {

            $input = $this->getRequest()->getPostValue();
            $artical = $this->_articalFactory->create();
            $artical->setData($input)->save();
            $this->messageManager->addSuccessMessage(__("Data Inserted Successfully."));
            return $this->_redirect('mymodule');
        }else{
            return $this->resultPageFactory->create();
        }
    }
}