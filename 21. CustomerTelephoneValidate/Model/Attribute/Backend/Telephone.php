<?php
declare(strict_types=1);
namespace SMG\CustomerTelephoneValidate\Model\Attribute\Backend;

use \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

/**
 * Backend model class inherited from AbstractBackend
 */
class Telephone extends AbstractBackend
{
    /**
     * Validate minimum digit before save
     *
     * @param [type] $object
     * @return void
     */
    public function beforeSave($object)
    {
        $attribute = $this->getAttribute();
        $attrCode = $attribute->getAttributeCode();
        $value = $object->getData($attrCode);
        $label = $attribute->getFrontend()->getLabel();
        if (strlen($value)<10) {
            throw new LocalizedException(
                __("Invalid 10-digit '%1'", $label)
            );
        }
        return $this;
    }
}
