<?php
namespace Techsevin\Customerfeedback\Model\Customerfeedback;

use Techsevin\Customerfeedback\Model\ResourceModel\Customerfeedback\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Techsevin\Customerfeedback\Model\ResourceModel\Customerfeedback\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $pincodeCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $customerfeedbackCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        //echo $name; exit;
        $this->collection = $customerfeedbackCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var $customerfeedback \Techsevin\Customerfeedback\Model\Customerfeedback */
        foreach ($items as $customerfeedback) {
            $this->loadedData[$customerfeedback->getId()] = $customerfeedback->getData();
        }

        $data = $this->dataPersistor->get('customerfeedback_allcustomerfeedback');
        if (!empty($data)) {
            $customerfeedback = $this->collection->getNewEmptyItem();
            $customerfeedback->setData($data);
            $this->loadedData[$customerfeedback->getId()] = $customerfeedback->getData();
            $this->dataPersistor->clear('customerfeedback_allcustomerfeedback');
        }

        return $this->loadedData;
    }
}
