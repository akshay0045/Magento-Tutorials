<?php

namespace Techsevin\CustomAddressAttribute\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;

use Magento\Framework\DB\Ddl\Table;

/**

* Custom Attribute Renderer

*/

class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource

{

/**

* @var OptionFactory

*/

protected $optionFactory;

/**

* @param OptionFactory $optionFactory

*/

/**

* Get all options

*

* @return array

*/

    public function getAllOptions()

    {

        /* your Attribute options list*/

        $this->_options=[ ['label'=>'Home', 'value'=>'home'],

        ['label'=>'Office', 'value'=>'office']

        ];
        return $this->_options;

    }

}