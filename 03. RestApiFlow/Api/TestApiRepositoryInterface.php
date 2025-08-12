<?php
declare(strict_types=1);
namespace SMG\RestApiTest\Api;

interface TestApiRepositoryInterface
{
    /**
     * Get Api Data
     *
     * @api
     * @param int $id
     * @return SMG\RestApiTest\Api\Data\TestApiDataInterface
     */
    public function getApiData($id);
}
