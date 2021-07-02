<?php
namespace Techsevin\HelloWorld\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
class Test extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_coreRegistry;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Framework\Registry $coreRegistry
	) {
		$this->_pageFactory = $pageFactory;
		$this->_coreRegistry = $coreRegistry;
		return parent::__construct($context);
	}
	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'Techsevin'));
		$this->_eventManager->dispatch('techsevin_helloworld_display_text', ['mp_text' => $textDisplay]);
		$text = $textDisplay->getText();
		$this->_coreRegistry->register('foo', $text);
		return $this->_pageFactory->create();
	}
}