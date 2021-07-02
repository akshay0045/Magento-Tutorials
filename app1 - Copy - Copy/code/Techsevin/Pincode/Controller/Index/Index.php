<?php
namespace Techsevin\Pincode\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_pincodeData;
	protected $resultPageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Techsevin\Pincode\Helper\Data $helper,
		\Techsevin\Pincode\Block\Index $pincodeData,
		\Magento\Framework\Controller\Result\JsonFactory $resultPageFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_pincodeData = $pincodeData;
		$this->helper = $helper;
		$this->resultPageFactory = $resultPageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		if($this->getRequest()->isAjax()){

            $pincode = $this->getRequest()->getParam('pincode', false);

            $pincodeStatus = $this->helper->getPincodeStatus($pincode);

            $message = $this->helper->getMessage($pincodeStatus, $pincode);
    
            $resultJson = $this->resultPageFactory->create();
            
            return $resultJson->setData($message);
        }

		$pincodeDatas = $this->_pincodeData->getPincodeData();
		return $this->_pageFactory->create();
	}
}