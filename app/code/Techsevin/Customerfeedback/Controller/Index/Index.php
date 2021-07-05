<?php

namespace Techsevin\Customerfeedback\Controller\Index;

use \Techsevin\Customerfeedback\Model\CustomerfeedbackFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;


class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_customerfeedbackFactory;

	protected $_fileUploaderFactory;

	protected $filesystem;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
		Filesystem $filesystem,
		CustomerfeedbackFactory $customerfeedbackFactory
	) {
		$this->_pageFactory = $pageFactory;
		$this->_customerfeedbackFactory = $customerfeedbackFactory;
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->filesystem = $filesystem;
		return parent::__construct($context);
	}

	public function execute()
	{
		if ($this->getRequest()->isPost()) {

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
			$imagePath = 'techsevin/customerfeedback' . $result['file'];

			$input = $this->getRequest()->getPostValue();

			unset($input['form_key']);

			$input['image'] = $imagePath;

			$customerFeedbackData = $this->_customerfeedbackFactory->create();

			$customerFeedbackData->setData($input)->save();

			$this->messageManager->addSuccessMessage(__("Data Inserted Successfully."));

			return $this->_redirect('customerfeedback');
		} else {
			$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
			return $this->_pageFactory->create();
		}
	}
}
