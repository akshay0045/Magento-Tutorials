<?php
namespace Techsevin\BannerSlider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Filesystem\Driver\File;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Techsevin_BannerSlider::banner_delete';

    protected $_file;

    /**
     * @param Context $context
     */
    public function __construct(Context $context,  File $file)
    {
        $this->_file = $file;
        parent::__construct($context);
    }

    /**
     * Delete Banner
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {

    	$filePath = "techsevin/banners_slider/";
        $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
		$mediaRootDir = $mediaDirectory->getAbsolutePath();


        // check if we know what should be deleted
        $bannerId = (int)$this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($bannerId && (int) $bannerId > 0) {
            try {
                $model = $this->_objectManager->create('Techsevin\BannerSlider\Model\Banner');
                $block = $model->load($bannerId);
                //echo "<pre>"; print_r($mediaRootDir.$filePath.$block->getData('image')); die();
                
                if ($this->_file->isExists($mediaRootDir.$filePath.$block->getData('image')))  {
				    $this->_file->deleteFile($mediaRootDir.$filePath.$block->getData('image'));
				}

                $model->delete();
                $this->messageManager->addSuccess(__('The Banner has been deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/*/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Banner doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/*/index');
    }
}