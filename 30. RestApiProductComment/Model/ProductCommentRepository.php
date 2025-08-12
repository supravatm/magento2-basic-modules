<?php
declare(strict_types=1);
namespace SMG\RestApiProductComment\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use SMG\RestApiProductComment\Model\ResourceModel\ProductComment as ResourceComment;
use \SMG\RestApiProductComment\Model\ProductCommentFactory;
use \SMG\RestApiProductComment\Model\ResourceModel\ProductComment\CollectionFactory;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use \SMG\RestApiProductComment\Api\ProductCommentRepositoryInterface;
use \SMG\RestApiProductComment\Api\Data\ProductCommentInterface as DataProductCommentInterface;

class ProductCommentRepository implements ProductCommentRepositoryInterface
{
    /**
     * @var ProductCommentFactory
     */
    protected $objectFactory;

    /**
     * @var ResourceComment
     */
    protected $resource;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var SearchResultsFactory
     */
    protected $searchResultsFactory;

    /**
     *
     * @param ProductCommentFactory $objectFactory
     * @param ResourceComment $resource
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ProductCommentFactory $objectFactory,
        ResourceComment $resource,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->objectFactory = $objectFactory;
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Comment data
     *
     * @param \SMG\RestApiProductComment\Api\Data\ProductCommentInterface $comment
     * @return \SMG\RestApiProductComment\Model\ProductComment
     * @throws CouldNotSaveException
     */
    public function save(DataProductCommentInterface $comment)
    {
        $productComment = $this->objectFactory->create();
        $productComment->setData($comment->getData());
        $this->resource->save($productComment);
        return $productComment;
    }
    
    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @inheritDoc
     */
    public function delete(DataProductCommentInterface $object)
    {
        try {
            $object = $this->objectFactory->create()->load($object->getCommentId());
            $this->resource->delete($object);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getById($id)
    {
        $comment = $this->objectFactory->create();
        $this->resource->load($comment, $id);
        if (!$comment->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(
                __('The Comment with the "%1" ID doesn\'t exist.', $id)
            );
        }
        return $comment;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();

        $searchResults->setSearchCriteria($criteria);
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        //\Zend_Debug::dump($fields); die;
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $objects = [];
        foreach ($collection as $objectModel) {
            $objects[] = $objectModel->getData();
        }
        $searchResults->setItems($objects);
        return $searchResults;
    }
}
