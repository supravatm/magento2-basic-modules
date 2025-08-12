<?php

declare(strict_types=1);

namespace SMG\CustomProductAttribute\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Material extends AbstractSource
{
    /**
     * Gets Options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        $this->_options = [
            ['label' => 'Material Type 001', 'value' => '0'],
            ['label' => 'Cotton 001', 'value' => 'cotton'],
            ['label' => 'Linen 001', 'value' => 'linen'],
            ['label' => 'Silk 001', 'value' => 'silk'],
            ['label' => 'Leather 001', 'value' => 'leather'],
            ['label' => 'Nylon 001', 'value' => 'nylon'],
            ['label' => 'Polyester 001', 'value' => 'polyester'],
            ['label' => 'Velvet 001', 'value' => 'velvet']

        ];
        return $this->_options;
    }
}
