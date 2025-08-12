<?php
declare(strict_types=1);
namespace SMG\CustomProductAttribute\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class Material extends AbstractFrontend
{
    /**
     * @inheritDoc
     */
    public function getValue(DataObject $object)
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attributeCode);

        if ($value) {
            $valueOption = $this->getOption($value);
            // phpcs:disable
            return !($valueOption)?: nl2br(htmlspecialchars($valueOption));
            // phpcs:enable
        }
    }
}
