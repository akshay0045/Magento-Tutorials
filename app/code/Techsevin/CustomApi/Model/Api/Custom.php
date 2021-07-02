<?php
 
namespace Techsevin\CustomApi\Model\Api;
 
use Psr\Log\LoggerInterface;
use \Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use \Techsevin\Customerfeedback\Model\CustomerfeedbackFactory;
use Magento\Framework\Exception\LocalizedException;

 
class Custom
{
    protected $logger;

    protected $request;

	protected $_customerfeedbackFactory;

	protected $_fileUploaderFactory;

	protected $filesystem;

    public function __construct(
        LoggerInterface $logger,
        \Magento\Framework\Webapi\Rest\Request $request,
        UploaderFactory $fileUploaderFactory,
		Filesystem $filesystem,
		CustomerfeedbackFactory $customerfeedbackFactory
    )
    {
        $this->logger = $logger;
        $this->request = $request;
		$this->_customerfeedbackFactory = $customerfeedbackFactory;
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->filesystem = $filesystem;
    }
 
    /**
     * @inheritdoc
     */
 
    public function getPost()
    {
        $image = $this->request->getFiles('image');


        $input = $this->request->getPostValue();

        if ($input['pk_i_id'] == null) {
            
            $validation['error'] = [];

            if ($input['customer_name'] == null) {
                $validation['error']['customer_name'] = "required";
            }
            if ($input['customer_email'] == null) {
                $validation['error']['customer_email'] = "required";
            }
            if ($input['customer_phone'] == null) {
                $validation['error']['customer_phone'] = "required";
            }
            if ($input['customer_subject'] == null) {
                $validation['error']['customer_subject'] = "required";
            }
            if ($input['customer_message'] == null) {
                $validation['error']['customer_message'] = "required";
            }
            if ($input['rating'] == null) {
                $validation['error']['rating'] = "required";
            }
            if($validation['error'] != null){
                header('Content-Type: application/json');
                echo json_encode(['status'=>false, 'message' => $validation]);exit;
            }
            
        }else {

            if ($input['customer_name'] == null) {
                unset($input['customer_name']);
            }
            if ($input['customer_email'] == null) {
                unset($input['customer_email']);
            }
            if ($input['customer_phone'] == null) {
                unset($input['customer_phone']);
            }
            if ($input['customer_subject'] == null) {
                $validation['error']['customer_subject'] = "required";
            }
            if ($input['customer_message'] == null) {
                unset($input['customer_message']);
            }
            if ($input['rating'] == null) {
                unset($input['rating']);
            }
        }
        

        try {

            if($image['name'] != null){
                $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
		 
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                
                $uploader->setAllowRenameFiles(true);
                
                $uploader->setFilesDispersion(true);

                $path = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('techsevin/customerfeedback/');

                $result = $uploader->save($path);

                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $path)
                    );
                }

                $imagePath = 'techsevin/customerfeedback'.$result['file'];

                $input['image'] = $imagePath; 

            }

            $customerFeedbackData = $this->_customerfeedbackFactory->create()->load($input['pk_i_id'], 'pk_i_id');
            
            if($customerFeedbackData->getId()){
                //echo 1; exit;
                $customerFeedbackData->setData($input);
                $customerFeedbackData->setId($input['pk_i_id'], 'pk_i_id');
                
            }else {
                unset($input['pk_i_id']);
			    $customerFeedbackData->setData($input); 
            }

            $customerFeedbackData->save();

             $response = [
                'success'=>true, 
                'message' => "Data saved successfully",
                'data' => $input,
             ];

        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            $this->logger->info($e->getMessage());
        } catch (LocalizedException $e) {
            header('Content-Type: application/json');
            echo json_encode(['status'=>false, 'message' => $e->getMessage()]);exit;
        }
        header('Content-Type: application/json');
        echo $returnArray = json_encode($response); exit;
        return $returnArray; 
    }
}