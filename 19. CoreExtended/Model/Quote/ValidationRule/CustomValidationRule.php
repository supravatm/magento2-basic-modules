<?php

declare(strict_types=1);

namespace SMG\CoreExtended\Model\Quote\ValidationRule;

use Magento\Framework\Validation\ValidationResultFactory;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\ValidationRules\QuoteValidationRuleInterface;

class CustomValidationRule implements QuoteValidationRuleInterface
{
    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @param ValidationResultFactory $validationResultFactory
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
    ) {
        $this->validationResultFactory = $validationResultFactory;
    }

    /**
     * @inheritdoc
     *
     * @param Quote $quote
     * @return array
     */
    public function validate(Quote $quote): array
    {
        // $validationErrors = [];
        // if ($quote->getCustomerIsGuest()) {
        //     $validationErrors[] = __(
        //         'Check custom validation!'
        //     );
        // }
        return [];
    }
}
