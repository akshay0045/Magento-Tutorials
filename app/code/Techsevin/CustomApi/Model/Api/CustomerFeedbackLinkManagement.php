<?php
 
namespace Techsevin\CustomApi\Model\Api;
 
use Psr\Log\LoggerInterface;
use \Techsevin\Customerfeedback\Model\CustomerfeedbackFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Webapi\Rest\Request;
 
class CustomerFeedbackLinkManagement
{
    protected $logger;

    protected $request;

	protected $_customerfeedbackFactory;

    public function __construct(
        LoggerInterface $logger,
        Request $request,
        CustomerfeedbackFactory $customerfeedbackFactory
    )
    {
        $this->logger = $logger;
        $this->request = $request;
		$this->_customerfeedbackFactory = $customerfeedbackFactory;
    }
 
    /**
     * @inheritdoc
     */
 
    public function getAssignedFeedback($feedbackId)
    {
        $data = $this->request->getParams();
        $customerFeedbackData = $this->_customerfeedbackFactory->create()->load($data['feedbackId'], 'pk_i_id');
        
        $response = ['success' => true, 'data' => $customerFeedbackData->getData()];
        header('Content-Type: application/json');
        echo json_encode($response); exit;
        return $response;
    }
}