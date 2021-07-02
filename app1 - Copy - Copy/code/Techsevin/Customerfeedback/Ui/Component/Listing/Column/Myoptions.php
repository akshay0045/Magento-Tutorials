<?php

namespace Techsevin\Customerfeedback\Ui\Component\Listing\Column;

class Myoptions implements \Magento\Framework\Option\ArrayInterface
{
    //Here you can __construct Model

    public function toOptionArray()
    {
        return [
            ['value' => 'Very good', 'label' => __('Very good')],
            ['value' => 'Good', 'label' => __('Good')],
            ['value' => 'Bad', 'label' => __('Bad')],
            ['value' => 'Very Bad', 'label' => __('Very Bad')],
        ];
    }
}