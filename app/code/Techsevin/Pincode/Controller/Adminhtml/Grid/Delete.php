<?php

namespace Techsevin\Pincode\Controller\Adminhtml\Grid;

class Delete extends \Techsevin\Pincode\Controller\Adminhtml\Grid
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('pk_i_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Techsevin\Pincode\Model\Pincode');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the Pincode.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['pk_i_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a Pincode to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
