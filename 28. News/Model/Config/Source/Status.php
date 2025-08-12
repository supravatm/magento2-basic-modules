<?php
namespace SMG\News\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }
    /**
     * @inheritDoc
     */
    public function getOptions()
    {
        return [
            1 => __('Enable'),
            2 => __('Disabled')
        ];
    }
}
