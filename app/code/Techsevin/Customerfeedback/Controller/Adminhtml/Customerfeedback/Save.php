<?php


namespace Techsevin\Customerfeedback\Controller\Adminhtml\Customerfeedback;

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
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context, $coreRegistry);
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
        
            $model = $this->_objectManager->create('Techsevin\Customerfeedback\Model\Customerfeedback')->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Feedback no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the Pincode.'));
                $this->dataPersistor->clear('customerfeedback_allcustomerfeedback');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['pk_i_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Pincode.'));
            }
        
            $this->dataPersistor->set('customerfeedback_allcustomerfeedback', $data);
            return $resultRedirect->setPath('*/*/edit', ['pk_i_id' => $this->getRequest()->getParam('pk_i_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}