<?php
/**
 * @category   Ambab
 * @package    Ambab_Exchange
 * @author     letsdevelophp@gmail.com
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Ambab\Exchange\Block\Adminhtml\Items;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize form
     * Add standard buttons
     * Add "Save and Continue" button
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_items';
        $this->_blockGroup = 'Ambab_Exchange';

        parent::_construct();

        $this->buttonList->add(
            'save_and_continue_edit',
            [
                'class' => 'save',
                'label' => __('Save and Continue Edit'),
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            10
        );
        $item = $this->_coreRegistry->registry('current_ambab_exchange_items');
        // if ($this->getRmaDetail()->getData('status') == '1' && $this->getRmaDetail()->getData('admin_status') == '1') {
            // $this->addButton(
            //     'create_pickup_request',
            //     [
            //         'label' => __('Create Pickup Request'),
            //         'onclick' => 'window.open(\'' . $this->getUrl('rmasystem/allrma/createpickuprequest', ['id'=>$item->getId()]) . '\',"_blank")',
            //         'class' => 'scalable print',
            //         'level' => -1
            //     ]
            // );
        // }
        $this->buttonList->remove('delete');
        $this->buttonList->remove('reset');
    }

    /**
     * Getter for form header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $item = $this->_coreRegistry->registry('current_ambab_exchange_items');
        if ($item->getId()) {
            return __("Edit Item '%1'", $this->escapeHtml($item->getName()));
        } else {
            return __('New Item');
        }
    }
}
