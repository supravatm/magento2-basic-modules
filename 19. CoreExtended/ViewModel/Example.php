<?php

declare(strict_types=1);

namespace SMG\CoreExtended\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Example implements ArgumentInterface
{
    /**
     * Example of return text value
     *
     * @return string|null
     */
    public function getAdditionalInfoData():?string
    {
        return "Additiona customer information data";
    }
}
