<?php

namespace Techsevin\Customerfeedback\Model\Customerfeedback;

use Techsevin\Customerfeedback\Model\ResourceModel\Customerfeedback\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Techsevin\Customerfeedback\Model\Customerfeedback\FileInfo;
use Magento\Framework\Filesystem;

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
     * @var Filesystem
     */
    private $fileInfo;


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
            $customerfeedback = $this->convertValues($customerfeedback);
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

    /**
     * Converts image data to acceptable for rendering format
     *
     * @param \Techsevin\Customerfeedback\Model\Customerfeedback $customerfeedback
     * @return \PHPCuTechsevinong\customerfeedback\Model\Customerfeedback $customerfeedback
     */
    private function convertValues($customerfeedback)
    {
        $fileName = $customerfeedback->getImage();
        $image = [];
        if ($this->getFileInfo()->isExist($fileName)) {
            $stat = $this->getFileInfo()->getStat($fileName);
            $mime = $this->getFileInfo()->getMimeType($fileName);
            $image[0]['name'] = $fileName;
            $image[0]['url'] = $customerfeedback->getImageUrl();
            $image[0]['size'] = isset($stat) ? $stat['size'] : 0;
            $image[0]['type'] = $mime;
        }
        $customerfeedback->setImage($image);
        return $customerfeedback;
    }

    /**
     * Get FileInfo instance
     *
     * @return FileInfo
     *
     */
    private function getFileInfo()
    {
        if ($this->fileInfo === null) {
            $this->fileInfo = ObjectManager::getInstance()->get(FileInfo::class);
        }
        return $this->fileInfo;
    }
}
