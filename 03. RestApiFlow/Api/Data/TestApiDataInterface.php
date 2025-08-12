<?php
declare(strict_types=1);

namespace SMG\RestApiTest\Api\Data;

interface TestApiDataInterface
{
    /**
     * Get id
     *
     * @api
     * @return string
     */
    public function getId();

    /**
     * Set id
     *
     * @api
     * @param string $id
     * @return SMG\RestApiTest\Api\Data\TestApiDataInterface
     */
    public function setId($id);

    /**
     * Get Title
     *
     * @api
     * @return string
     */
    public function getTitle();

    /**
     * Set title
     *
     * @api
     * @param string $title
     * @return SMG\RestApiTest\Api\Data\TestApiDataInterface
     */
    public function setTitle($title);
    /**
     * Get description
     *
     * @api
     * @return SMG\RestApiTest\Api\Data\TestApiDataInterface
     */
    public function getDescription();
    /**
     * Set description
     *
     * @api
     * @param string $desc
     * @return SMG\RestApiTest\Api\Data\TestApiDataInterface
     */
    public function setDescription($desc);
}
