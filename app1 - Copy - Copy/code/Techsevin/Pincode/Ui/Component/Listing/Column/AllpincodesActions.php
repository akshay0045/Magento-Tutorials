<?php


namespace Techsevin\Pincode\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;

class AllpincodesActions extends \Magento\Ui\Component\Listing\Columns\Column
{

    const URL_PATH_EDIT = 'grid/grid/edit';
    const URL_PATH_DELETE = 'grid/grid/delete';
    const URL_PATH_DETAILS = 'grid/grid/details';
    protected $urlBuilder;

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['pk_i_id'])) {
                    $title = $item['pincode'];
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'pk_i_id' => $item['pk_i_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'pk_i_id' => $item['pk_i_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete Pincode %1', $title),
                                'message' => __('Are you sure you want to delete a %1 record?', $title)
                            ]
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
