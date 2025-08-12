<?php
// phpcs:ignoreFile
namespace SMG\CustomCache\Helper;

use Magento\Framework\App\Helper;

class Cache extends Helper\AbstractHelper
{
    const CACHE_TAG = 'SMG_CUSTOM_CACHE';
    const CACHE_ID = 'smg_custom_cache';
    const CACHE_LIFETIME = 86400;

    protected $cache;
    protected $cacheState;
    protected $storeManager;
    private $storeId;

    /**
     * Cache constructor.
     * @param Helper\Context $context
     * @param \Magento\Framework\App\Cache $cache
     * @param \Magento\Framework\App\Cache\State $cacheState
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        Helper\Context $context,
        \Magento\Framework\App\Cache $cache,
        \Magento\Framework\App\Cache\State $cacheState,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->cache = $cache;
        $this->cacheState = $cacheState;
        $this->storeManager = $storeManager;
        $this->storeId = $storeManager->getStore()->getId();
        parent::__construct($context);
    }

    /**
     * @param $method
     * @param array $vars
     * @return string
     */
    public function getId($method, $vars = [])
    {
        return base64_encode($this->storeId . self::CACHE_ID . $method . implode('', $vars));
    }

    /**
     * @param $cacheId
     * @return bool|string
     */
    public function load($cacheId)
    {
        if ($this->cacheState->isEnabled(self::CACHE_ID)) {
            return $this->cache->load($cacheId);
        }

        return false;
    }

    /**
     * @param $data
     * @param $cacheId
     * @param int $cacheLifetime
     * @return bool
     */
    public function save($data, $cacheId, $cacheLifetime = self::CACHE_LIFETIME)
    {
        if ($this->cacheState->isEnabled(self::CACHE_ID)) {
            $this->cache->save($data, $cacheId, [self::CACHE_TAG], $cacheLifetime);
            return true;
        }
        return false;
    }
}
