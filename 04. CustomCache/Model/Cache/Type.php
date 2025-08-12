<?php
declare(strict_types=1);
namespace SMG\CustomCache\Model\Cache;

use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\Frontend\Decorator\TagScope;

/**
 * System / Cache Management / Cache type "Your Cache Type Label"
 */
class Type extends TagScope
{

    /**
     * Type Code for Cache. It should be unique
     */
    public const TYPE_IDENTIFIER = 'smg_cache';

    /**
     * Tag of Cache
     */
    public const CACHE_TAG = 'SMG_CACHE';

    /**
     * @param FrontendPool $cacheFrontendPool
     */
    public function __construct(
        FrontendPool $cacheFrontendPool
    ) {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }
}
