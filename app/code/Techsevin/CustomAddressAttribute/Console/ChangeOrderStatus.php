<?php

namespace Techsevin\CustomAddressAttribute\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
//This is for  order status
use Magento\Sales\Model\Order;
//This is for sending mail
use Magento\Framework\Mail\TransportInterfaceFactory;

class ChangeOrderStatus extends Command
{

	const ORDERID = 'OrderId';

	protected $mailTransportFactory;

	
    public function __construct(
        TransportInterfaceFactory $mailTransportFactory
    )
    {
        $this->mailTransportFactory = $mailTransportFactory;
        parent::__construct();
    }

	protected function configure()
	{

		$options = [
			new InputOption(
				self::ORDERID,
				null,
				InputOption::VALUE_REQUIRED,
				'OrderId'
			)
		];

		$this->setName('change:orderstatus')
			->setDescription('Change order status by order id')
			->setDefinition($options);

		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if ($orderId = $input->getOption(self::ORDERID)) {

			$output->writeln("Hello " . $orderId);

			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$order = $objectManager->create('\Magento\Sales\Model\Order') ->load($orderId);
			$orderState = Order::STATE_PROCESSING;
			$order->setState($orderState)->setStatus(Order::STATE_PROCESSING);
			$order->save();

			$orderUpdated = $objectManager->create('\Magento\Sales\Model\Order') ->load($orderId);
			echo '<pre/>'; print_r($orderUpdated->getData()); exit;


		} else {

			$output->writeln("Hello World");

			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$orderCollectionFactory = $objectManager->create('Magento\Sales\Model\ResourceModel\Order\CollectionFactory')->create();
			$orderCollection = $orderCollectionFactory
                            ->addAttributeToSelect("*")
                            ->setOrder('created_at','asc');

			if ($orderCollection && count($orderCollection) > 0) {
                foreach ($orderCollection AS $order) {
					if($order->getStatus() == "pending"){
						$orderId = $order->getId();
						
						$order = $objectManager->create('\Magento\Sales\Model\Order') ->load($orderId);
						$orderState = Order::STATE_PROCESSING;
						$order->setState($orderState)->setStatus(Order::STATE_PROCESSING);
						$order->save();
					}
				}
			}

			$orderCollectionFactory = $objectManager->create('Magento\Sales\Model\ResourceModel\Order\CollectionFactory')->create();
			$orderCollection = $orderCollectionFactory
							->addAttributeToSelect("*")
							->setOrder('created_at','asc');

			$message = new \Magento\Framework\Mail\Message();
			$firstname = "Akshay";
			$lastname = "Shah";

			// Send Mail functionality starts from here 
			$from = "akshay.shah451981@gmail.com";
			$nameFrom = "Akshay Shah";
			$to = "to_akshay@gmail.com";
			$nameTo = $firstname. " ". $lastname;
			header('Content-Type: application/json');
			$body = "
			<div>
				<p>Hello, <b>Order Status Cahnge show billow array</i></p><br/>
				<p><pre>". json_encode($orderCollection->getData()) ."</pre></p><br/>
				<p>Thanks,</p>
				<p>Techsevin Solution LLP</p>
				<p>If any query Please contact with email ".$from."</p>
			</div>";
			$message->setSubject("Order Change status"); 
			$message->setBodyHtml($body);     // use it to send html data
			//$email->setBodyText($body);   // use it to send simple text data
			$message->setFrom($from, $nameFrom);
			$message->addTo($to, $nameTo);
			$transport = $this->mailTransportFactory->create(['message' => $message]);
			$transport->sendMessage();
			$output->writeln("Order status change 'Pending to processing' information to mail");
		}

		return $this;

	}
}
