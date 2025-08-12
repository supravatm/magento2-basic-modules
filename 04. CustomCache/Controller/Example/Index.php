<?php
// phpcs:ignoreFile
namespace SMG\CustomCache\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\Cache;
use Magento\Framework\App\Cache\State;
use Magento\Store\Model\StoreManagerInterface;
use SMG\CustomCache\Model\Cache\Type as CacheType;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class Index implements ActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Cache
     */
    protected $cache;
    /**
     * @var State
     */
    protected $cacheState;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var SerializerInterface
     */
    protected $serializer;
    /**
     * @var TimezoneInterface
     */
    protected $dateTime;

    public function __construct(
        PageFactory $resultPageFactory,
        SerializerInterface $serializer,
        Cache $cache,
        State $cacheState,
        StoreManagerInterface $storeManager,
        TimezoneInterface $dateTime
    ) {
        $this->resultPageFactory    = $resultPageFactory;
        $this->serializer           = $serializer;
        $this->cache                = $cache;
        $this->cacheState           = $cacheState;
        $this->storeManager         = $storeManager;
        $this->dateTime             = $dateTime;
    }

    public function execute()
    {

        $cacheKey  = CacheType::TYPE_IDENTIFIER;
        $cacheTag  = CacheType::CACHE_TAG;

        $cacheData = [
            'page_laoded' => $this->dateTime->date()->format('Y-m-d H:i:s')
        ];
        $storeData = $this->cache->save(
            $this->serializer->serialize($cacheData),
            $cacheKey,
            [$cacheTag],
            86400
        );

        $cacheKey  = CacheType::TYPE_IDENTIFIER;

        $data = $this->serializer->unserialize($this->cache->load($cacheKey));
        sleep(3);
        echo '<pre>';
        print_r($data);
        echo $this->dateTime->date()->format('Y-m-d H:i:s'); 
        echo "<br>";
        return $this->resultPageFactory->create('raw');
    }
}
