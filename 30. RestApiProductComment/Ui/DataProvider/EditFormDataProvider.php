<?php
namespace SMG\RestApiProductComment\Ui\DataProvider;

use SMG\RestApiProductComment\Model\ResourceModel\ProductComment\CollectionFactory;

class EditFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var CollectionFactory
     */
    protected $commentCollectionFactory;

    /**
     * @var array
     */
    protected $_loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $commentCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $commentCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $commentCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $comment) {
            $this->_loadedData[$comment->getId()] = $comment->getData();
        }
        return $this->_loadedData;
    }
}
