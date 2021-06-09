<?php
namespace Mythememodule\News\Controller\Adminhtml\AllNews;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory;
	protected $helperData;
	//protected $allnewsFactory;
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Mythememodule\News\Helper\Data $helperData
		//\Mythememodule\News\Model\AllnewsFactory $allnewsFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
		$this->helperData = $helperData;
		//$this->allnewsFactory = $allnewsFactory;
	}
	
	public function execute()
	{
		//direct sql query
		// $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		// $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
		// $connection = $resource->getConnection();
		// $tableName = $resource->getTableName('mythemmodule_news');
		// $where = ' where news_id = 1';
		// $attribute_information = "Select * FROM " . $tableName.$where;
		// $result = $connection->fetchAll($attribute_information);
		// echo '<pre>'; print_r($result);

		//using collection
		/*$allnews = $this->allnewsFactory->create();
		$newsCollection = $allnews->getCollection();
		echo '<pre>';
		print_r($newsCollection->getData()); 
		echo $this->helperData->getStorefrontConfig('news_link'); 
		exit;
		return $resultPage = $this->resultPageFactory->create();*/

		//direct call
		/*$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
		$connection = $resource->getConnection();
		$tableName = $resource->getTableName('mythemmodule_news');
		$select  = $connection->select()
            ->from(
                ['c' => $tableName],
                ['*']
            )
            ->where(
                "c.news_id = :news_id"
            );
        $bind = ['news_id'=> 1];
        $records = $connection->fetchAll($select, $bind);
        echo '<pre>';
		print_r($records);*/

		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend(__('All News'));
		return $resultPage;
	}
}