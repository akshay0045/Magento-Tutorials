<?php
 
namespace Techsevin\CustomApi\Model\Api;
 
use Psr\Log\LoggerInterface;
 
class Custom
{
    protected $logger;
 
    public function __construct(
        LoggerInterface $logger
    )
    {
 
        $this->logger = $logger;
    }
 
    /**
     * @inheritdoc
     */
 
    public function getPost($customer_name, $customer_email, $customer_phone, $customer_subject, $customer_message, $rating, $image)
    {
        $response = ['success' => false];
 
        try {
            // Your Code here
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            
            $customerFeedbackData = $objectManager->create('\Techsevin\Customerfeedback\Model\CustomerfeedbackFactory')->create();
            
            $input = [
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_phone' => $customer_phone,
                'customer_subject' => $customer_subject,
                'customer_message' => $customer_message,
                'rating' => $rating,
                'image' => $image
            ];

            $customerFeedbackData->setData($input)->save();

            $response = ['success' => true, 'message' => "Data Inserted Successfully."];
        

        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            $this->logger->info($e->getMessage());
        }
        $returnArray = json_encode($response);
        return $returnArray; 
    }
}