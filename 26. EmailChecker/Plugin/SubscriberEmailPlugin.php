<?php
declare(strict_types=1);

namespace SMG\EmailChecker\Plugin;

use Magento\Newsletter\Controller\Subscriber\NewAction;
use Magento\Newsletter\Model\Config as NewsletterConfig;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Controller\ResultFactory;
use SMG\EmailChecker\Model\Api as EmailCheckerApi;

class SubscriberEmailPlugin
{
    /**
     * @var NewsletterConfig
     */
    protected NewsletterConfig $newsletterConfig;
    /**
     * @var ManagerInterface
     */
    protected ManagerInterface $messageManager;
    /**
     * @var RedirectInterface
     */
    protected RedirectInterface $redirect;
    /**
     * @var ResultFactory
     */
    protected ResultFactory $resultFactory;
    /**
     * @var EmailCheckerApi
     */
    protected EmailCheckerApi $emailCheckerApi;

    /**
     *
     * @param NewsletterConfig $newsletterConfig
     * @param ManagerInterface $messageManager
     * @param RedirectInterface $redirect
     * @param ResultFactory $resultFactory
     * @param EmailCheckerApi $emailCheckerApi
     */
    public function __construct(
        NewsletterConfig $newsletterConfig,
        ManagerInterface $messageManager,
        RedirectInterface $redirect,
        ResultFactory $resultFactory,
        EmailCheckerApi $emailCheckerApi
    ) {
        $this->newsletterConfig = $newsletterConfig;
        $this->messageManager = $messageManager;
        $this->resultFactory = $resultFactory;
        $this->redirect = $redirect;
        $this->emailCheckerApi = $emailCheckerApi;
    }
    /**
     * Around Plugin
     *
     * @param NewAction $subject
     * @param \Closure $proceed
     * @return void
     */
    public function aroundExecute(NewAction $subject, \Closure $proceed)
    {
        if ($subject->getRequest()->isPost()
            && $subject->getRequest()->getPost('email')
            && $this->newsletterConfig->isActive()
        ) {
            $email = (string)$subject->getRequest()->getPost('email');
            $isDisposalEmail = $this->emailCheckerApi->emailValidation($email);
            if ($isDisposalEmail !== true) {
                $this->messageManager->addErrorMessage(
                    'Subscription is disabled for you domain'
                );
                /** @var Redirect $redirect */
                $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                // phpcs:ignore Magento2.Legacy.ObsoleteResponse
                $redirectUrl = $this->redirect->getRedirectUrl();

                return $redirect->setUrl($redirectUrl);
            }
            return $proceed();
        }
    }
}
