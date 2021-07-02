<?php
namespace Techsevin\Customerfeedback\Block;

use \Magento\Framework\View\Element\Template;

class Websitefeedback extends Template
{
    protected $_customerfeedbackFactory;

    protected $_customerfeedbackCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Mythememodule\Mymodule\Model\ArticalFactory $articalFactory,
        \Techsevin\Customerfeedback\Model\CustomerfeedbackFactory $customerfeedbackFactory,
        \Techsevin\Customerfeedback\Model\ResourceModel\Customerfeedback\CollectionFactory $customerfeedbackCollection

    ){
        parent::__construct($context);
        $this->_customerfeedbackFactory = $customerfeedbackFactory;
        $this->_customerfeedbackCollection = $customerfeedbackCollection;
     }

    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('My Custom Pagination'));
        parent::_prepareLayout();
        $page_size = $this->getPagerCount();
        $page_data = $this->getAllwebSitefeedback();
        if ($this->getAllwebSitefeedback()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'techsevin.customerfeedback.record.pager'
            )
                ->setAvailableLimit(array(5=>5,10=>10,15=>15))
                ->setShowPerPage(true)
                ->setCollection($page_data);
            $this->setChild('pager', $pager);
            $this->getAllwebSitefeedback()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getAllwebsitefeedback() {

        // get param values
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5; // set minimum records

        $customerfeedbackData = $this->_customerfeedbackFactory->create();
        $collection = $customerfeedbackData->getCollection();
        $collection->addFieldToFilter('is_approved',1);
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getPagerCount()
    {
        // get collection
        $minimum_show = 5; // set minimum records
        $page_array = [];
        $list_data = $this->_customerfeedbackCollection->create();
        $list_count = ceil(count($list_data->getData()));
        $show_count = $minimum_show + 1;
        if (count($list_data->getData()) >= $show_count) {
            $list_count = $list_count / $minimum_show;
            $page_nu = $total = $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
            for ($x = 0; $x <= $list_count; $x++) {
                $total = $total + $page_nu;
                $page_array[$total] = $total;
            }
        } else {
            $page_array[$minimum_show] = $minimum_show;
            $minimum_show = $minimum_show + $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
        }
        return $page_array;
    }
}