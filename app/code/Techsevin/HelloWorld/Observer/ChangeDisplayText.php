<?php
namespace Techsevin\HelloWorld\Observer;
class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface
{
	protected $_logger;

	public function __construct(
        \Psr\Log\LoggerInterface $logger,
        array $data = []
    )
    {        
        $this->_logger = $logger;
    }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$displayText = $observer->getData('mp_text');

		$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/events.log');
		$logger = new \Zend\Log\Logger();
		$logger->addWriter($writer);


		file_put_contents(BP.'/var/log/events.log', ' ::::: EVENT OCCURED :::: '.print_r(array($displayText),true).PHP_EOL,FILE_APPEND);
		
		$displayText->setText($displayText->getText() . " - Event <br/>Execute event successfully.");

		return $this;
	}
}