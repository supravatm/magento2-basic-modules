<?php
declare(strict_types=1);

namespace SMG\ControllerResponseTypes\Controller\Response;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;

class Index extends Action implements ActionInterface
{
        /**
         * The PageFactory to render with.
         *
         * @var PageFactory
         */
    protected $_resultsPageFactory;

    /**
     * Set the Context and Result Page Factory from DI.
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->_resultsPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Show the Hello World Index Page.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $a = "2---21";
        $b = "adsfdsa";
            //echo $a + $b;
        $resultPage = $this->_resultsPageFactory->create();
        $resultPage->getConfig()->getTitle()->set("Example block template");
        return $resultPage;
    }
}
