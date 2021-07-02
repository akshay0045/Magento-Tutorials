<?php
namespace Techsevin\BannerSlider\Controller\Adminhtml\Banner;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Techsevin\BannerSlider\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\Filesystem\Driver\File;
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Techsevin_BannerSlider::banner_delete';

    /**
     * @var Filter
     */
    protected $filter;

    protected $_file;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory, File $file)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->_file = $file;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $filePath = "techsevin/banners_slider/";
        $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
		$mediaRootDir = $mediaDirectory->getAbsolutePath();
		        
        $collectionSize = $collection->getSize();

        foreach ($collection as $block) {

        	if ($this->_file->isExists($mediaRootDir.$filePath.$block->getData('image')))  {
			    $this->_file->deleteFile($mediaRootDir.$filePath.$block->getData('image'));
			}
        	
            $block->delete();
        }
        
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath($this->_redirect->getRefererUrl());
    }
}