<?php
declare(strict_types=1);

namespace SMG\RestApiTest\Model;

use SMG\RestApiTest\Api\TestApiRepositoryInterface;
use SMG\RestApiTest\Api\Data\TestApiDataInterface;
use SMG\RestApiTest\Model\TestApiFactory;

class TestApiRepository implements TestApiRepositoryInterface
{
    /**
     * @var object
     */
    private $testApi;
    /**
     * Construct
     *
     * @param TestApi $testApi
     */
    public function __construct(TestApi $testApi)
    {
        $this->testApi = $testApi;
    }
    /**
     * Get test Api data
     *
     * @api
     *
     * @param int $id
     * @return TestApiDataInterface
     */
    public function getApiData($id)
    {
        try {
            $model = $this->testApi;
                
                $model->setId($id);
            if (!$model->getId()) {
                throw new \Magento\Framework\Exception\LocalizedException(__('no data found'));
            }
            return $model;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $returnArray['error'] = $e->getMessage();
            $returnArray['status'] = 0;
            $this->getJsonResponse(
                $returnArray
            );
        } catch (\Exception $e) {
            $returnArray['error'] = 'unable to process request';
            $returnArray['status'] = 2;
            $this->getJsonResponse(
                $returnArray
            );
        }
    }
}
