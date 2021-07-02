<?php


namespace Techsevin\Pincode\Controller\Adminhtml\Grid;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {

            if (empty($data['pk_i_id'])) {
                $data['pk_i_id'] = null;
            }

            $id = $this->getRequest()->getParam('pk_i_id');
        
            $model = $this->_objectManager->create('Techsevin\Pincode\Model\Pincode')->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Pincode no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Pincode.'));
                $this->dataPersistor->clear('pincode_allpincode');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['pk_i_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Pincode.'));
            }
        
            $this->dataPersistor->set('pincode_allpincode', $data);
            return $resultRedirect->setPath('*/*/edit', ['pk_i_id' => $this->getRequest()->getParam('pincode_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
