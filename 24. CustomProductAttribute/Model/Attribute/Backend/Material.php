<?php
declare(strict_types=1);
namespace SMG\CustomProductAttribute\Model\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;

/**
 * Backend model class inherited from AbstractBackend
 */
class Material extends AbstractBackend
{
    /**
     * Validate object
     *
     * @param \Magento\Framework\DataObject $object
     * @return bool
     * @throws LocalizedException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function validate($object)
    {
        $attribute_code = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attribute_code);

        if ($value == 4) {
            $valueOption = $this->getOption($value);
            throw new \Magento\Framework\Exception\LocalizedException(__("Can't set value %1", $valueOption));
        }
        return true;
    }
    /**
     * Get Options
     *
     * @param int $optionId
     * @return void
     */
    public function getOption($optionId)
    {
        $source = $this->getAttribute()->getSource();
        if ($source) {
            return $source->getOptionText($optionId);
        }
        return false;
    }
}
