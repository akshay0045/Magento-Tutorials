<?php
/**
 * Grid Record Index Controller.
 * @category  Techsevin
 * @package   Techsevin_Grid
 * @author    Techsevin
 * @copyright Copyright (c) 2010-2017 Techsevin Software Private Limited (https://Techsevin.com)
 * @license   https://store.Techsevin.com/license.html
 */
namespace Techsevin\Pincode\Controller\Adminhtml\Grid;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Mapped eBay Order List page.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Pincode List'));
        return $resultPage;
    }
}
