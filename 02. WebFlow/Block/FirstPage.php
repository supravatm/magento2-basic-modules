<?php
declare(strict_types=1);

namespace SMG\WebFlow\Block;

use Magento\Framework\View\Element\Template;

class FirstPage extends Template
{
    /**
     * First page action method
     *
     * @return string
     */
    public function sayHello()
    {
        return __('Hello World');
    }
}
