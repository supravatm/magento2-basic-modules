<?php

declare(strict_types=1);

namespace SMG\PluginExample\Controller\Plugin;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    /**
     * @var PageFactory
     */
    protected PageFactory $pageFactory;
    /**
     * Class construct
     *
     * @param PageFactory $pageFactory
     */
    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $result = $this->pageFactory->create();
        $result->getConfig()->getTitle()->set("Plugin Example in Magento 2");
        return $result;
    }
}
