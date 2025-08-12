<?php
namespace SMG\RestApiProductComment\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
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
     * Get Options
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            2 => __('Rejected'),
            1 => __('Approved'),
            0 => __('Pending'),
        ];
    }
}
