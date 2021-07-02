<?php

namespace Techsevin\CustomAddressAttribute\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Magento\Framework\Mail\TransportInterfaceFactory;

class Sayhello extends Command
{

	const NAME = 'name';

    /**
     * @var TransportInterfaceFactory
     */
    protected $mailTransportFactory;

    /**
     * @param ResourceConnection $dbConnection
     * @throws \LogicException
     */
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
				self::NAME,
				null,
				InputOption::VALUE_REQUIRED,
				'Name'
			)
		];

		$this->setName('example:sayhello')
			->setDescription('Demo command line')
			->setDefinition($options);

		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if ($name = $input->getOption(self::NAME)) {

			$output->writeln("Hello " . $name."!");


		} else {

            //$message = new \Magento\Framework\Mail\Message();
            /* $message->setFrom('mail.recipient@example.com');
            $message->addTo('mail.tosent@example.com');
            $message->setSubject('Subject');
            $message->setBodyHtml('<b>Body</b>');
            $transport = $this->mailTransportFactory->create(['message' => $message]);
            $transport->sendMessage(); */

            /* $firstname = "Akshay";
            $lastname = "Shah";

            // Send Mail functionality starts from here 
            $from = "akshay.shah451981@gmail.com";
            $nameFrom = "Akshay Shah";
            $to = "ankit.shah@gmail.com";
            $nameTo = "Ankit Shah";
            $body = "
            <div>
                <b>".$firstname."</b>
                <i>".$lastname."</i>
            </div>";

            $message->setSubject("Email Subject"); 
            $message->setBodyHtml($body);     // use it to send html data
            //$email->setBodyText($body);   // use it to send simple text data
            $message->setFrom($from, $nameFrom);
            $message->addTo($to, $nameTo);
            $transport = $this->mailTransportFactory->create(['message' => $message]);

            $transport->sendMessage(); */

            $output->writeln("Order Details");

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            
            $orderCollectionFactory = $objectManager->create('Magento\Sales\Model\ResourceModel\Order\CollectionFactory')->create();
            
            // Get order collection
            $orderCollection = $orderCollectionFactory
                            ->addAttributeToSelect("*")
                            ->setOrder('created_at','asc');
            
            echo "<pre>";
            //print_r($orderCollection->getData());
            echo "</pre>";
            foreach ($orderCollection AS $order) {

                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $orders= $objectManager->get('\Magento\Sales\Model\Order');
                $orderId=$order->getId();//your order id is here
                $orderData=$orders->load($orderId);
                print_r($orderData->getShippingAddress()->getData())."\n";// Here is Shipping Address
                print_r($orderData->getBillingAddress()->getData())."\n";
                echo "\n\n";
                /* echo $order->getData('customer_email') . "\n";
                echo $order->getData('customer_firstname') . "\n";
                echo $order->getData('customer_lastname') . "\n";
                echo $order->getId() . "\n";
                echo $order->getData('increment_id') . "\n";
                echo $order->getStatus() . "\n";
                echo "\n\n\n\n"; */
            }
            /* $message = new \Magento\Framework\Mail\Message();
            if ($orderCollection && count($orderCollection) > 0) {
                foreach ($orderCollection AS $order) {
                    if($order->getStatus() == "pending"){
                        $firstname = $order->getData('customer_firstname');
                        $lastname = $order->getData('customer_lastname');

                        // Send Mail functionality starts from here 
                        $from = "akshay.shah451981@gmail.com";
                        $nameFrom = "Akshay Shah";
                        $to = $order->getData('customer_email');
                        $nameTo = $firstname. " ". $lastname;
                        $body = "
                        <div>
                            <p>Hello, <b>".$firstname."</b> <i>".$lastname."</i></p><br/>
                            <p>Your order No ".$order->getData('increment_id')." status is ".$order->getStatus()." please pay ammount regarding order, so order will be completed.</p><br/>
                            <p>Thanks,</p>
                            <p>Techsevin Solution LLP</p>
                            <p>If any query Please contact with email ".$from."</p>
                        </div>";
                        $message->setSubject("Order panding mail to customer"); 
                        $message->setBodyHtml($body);     // use it to send html data
                        //$email->setBodyText($body);   // use it to send simple text data
                        $message->setFrom($from, $nameFrom);
                        $message->addTo($to, $nameTo);
                        $transport = $this->mailTransportFactory->create(['message' => $message]);
                        $transport->sendMessage();
                    }
                    // echo $order->getData('customer_email') . "\n";
                    // echo $order->getData('customer_firstname') . "\n";
                    // echo $order->getData('customer_lastname') . "\n";
                    // echo $order->getId() . "\n";
                    // echo $order->getData('increment_id') . "\n";
                    // echo $order->getStatus() . "\n";
                    // echo "\n\n\n\n";
                }
            } */

            /* $om = \Magento\Framework\App\ObjectManager::getInstance();
            $orderCollection  = $om->create('Magento\Sales\Model\ResourceModel\Order\CollectionFactory');
            $collection = $orderCollection->create()->addAttributeToSelect('*')->load();
            foreach($collection as $orderDatamodel1){
                echo $orderDatamodel1->getId()."\n";
                echo $orderDatamodel1->getData('customer_email')."\n";
                echo "\n\n\n\n";
            } */

            //https://prnt.sc/16ftyi4
		}
		return $this;
	}
}