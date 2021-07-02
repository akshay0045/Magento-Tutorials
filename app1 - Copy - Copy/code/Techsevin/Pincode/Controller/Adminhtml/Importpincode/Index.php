<?php
/**
 * Grid Record Index Controller.
 * @category  Techsevin
 * @package   Techsevin_Grid
 * @author    Techsevin
 * @copyright Copyright (c) 2010-2017 Techsevin Software Private Limited (https://Techsevin.com)
 * @license   https://store.Techsevin.com/license.html
 */
namespace Techsevin\Pincode\Controller\Adminhtml\Importpincode;
use Magento\Framework\App\ResourceConnection;
class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    private $resourceConnection;
    const PINCODE_TABLE = "shipment_patner_pincode_flat";
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ResourceConnection $resourceConnection
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Mapped eBay Order List page.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $connection  = $this->resourceConnection->getConnection();
            $tableName = $connection->getTableName(self::PINCODE_TABLE);
            
            
            //Import Csv file in database
            $fileName = $_FILES["file"]["tmp_name"];
    
            if ($_FILES["file"]["size"] > 0) {
                
                $file = fopen($fileName, "r");
                $i =0;
                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                    
                    $pincode = "";
                    if (isset($column[0])) {
                        $pincode = $column[0];
                    }

                    $city = "";
                    if (isset($column[1])) {
                        $city = $column[1];
                    }

                    $state = "";
                    if (isset($column[2])) {
                        $state = $column[2];
                    }

                    $country = "";
                    if (isset($column[3])) {
                        $country = $column[3];
                    }

                    $prepaid = "";
                    if (isset($column[4])) {
                        $prepaid = $column[4];
                    }

                    $cod = "";
                    if (isset($column[5])) {
                        $cod = $column[5];
                    }

                    $logistic_partner = "";
                    if (isset($column[6])) {
                        $logistic_partner = $column[6];
                    }

                    $region_id = "";
                    if (isset($column[7])) {
                        $region_id = $column[7];
                    }
                    if($i != 0){
                        $paramArray = [
                            'pk_i_id' => null,
                            'pincode' =>$pincode,
                            'city' => $city,
                            'state' => $state,
                            'country' => $country,
                            'prepaid' => $prepaid,
                            'cod' => $cod,
                            'logistic_partner' => $logistic_partner,
                            'region_id' => $region_id
                        ];
                        $countData = $connection->insert($tableName,$paramArray);
                    }
                    $i++;
                }
            }

            $this->messageManager->addSuccess(__('Pincode Inserted using csv file successfully.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('grid/grid');
            
        }else{
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend(__('Import Pincode'));
            return $resultPage;
        }
        
    }
}
