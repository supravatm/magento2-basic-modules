<?php
declare(strict_types=1);

namespace SMG\ControllerResponseTypes\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Serialize\SerializerInterface;

class Index extends Template
{

    /**
     *
     * @var SerializerInterface
     */
    protected SerializerInterface $serializerInterface;
    /**
     * Construct
     *
     * @param Context $context
     * @param SerializerInterface $serializerInterface
     */
    public function __construct(
        Context $context,
        SerializerInterface $serializerInterface
    ) {
        $this->serializerInterface = $serializerInterface;
        parent::__construct($context);
    }
    /**
     * Sample function
     *
     * @return string
     */
    public function myJson()
    {
        $data = [
            'Foo' => 'Bar'
        ];
        return $this->serializerInterface->serialize($data);
    }
}
