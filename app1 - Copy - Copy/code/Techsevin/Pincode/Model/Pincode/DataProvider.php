<?php
namespace Techsevin\Pincode\Model\Pincode;

use Techsevin\Pincode\Model\ResourceModel\Pincode\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Rsgitech\News\Model\ResourceModel\Allnews\Collection
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
        CollectionFactory $pincodeCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $pincodeCollectionFactory->create();
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
        /** @var $pincode \Techsevin\Pincode\Model\Pincode */
        foreach ($items as $pincode) {
            $this->loadedData[$pincode->getId()] = $pincode->getData();
        }

        $data = $this->dataPersistor->get('pincode_allpincode');
        if (!empty($data)) {
            $pincode = $this->collection->getNewEmptyItem();
            $pincode->setData($data);
            $this->loadedData[$pincode->getId()] = $pincode->getData();
            $this->dataPersistor->clear('pincode_allpincode');
        }

        return $this->loadedData;
    }
}
