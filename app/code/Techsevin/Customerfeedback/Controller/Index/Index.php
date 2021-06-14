<?php
namespace Techsevin\Customerfeedback\Controller\Index;

use \Techsevin\Customerfeedback\Model\CustomerfeedbackFactory;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_customerfeedbackFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		CustomerfeedbackFactory $customerfeedbackFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_customerfeedbackFactory = $customerfeedbackFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		if ($this->getRequest()->isPost()) {

			$input = $this->getRequest()->getPostValue();

			unset($input['form_key']);

			$customerFeedbackData = $this->_customerfeedbackFactory->create();

			$customerFeedbackData->setData($input)->save();

			$this->messageManager->addSuccessMessage(__("Data Inserted Successfully."));

            return $this->_redirect('customerfeedback');
		
		} else {

			return $this->_pageFactory->create();

		}
	}
}