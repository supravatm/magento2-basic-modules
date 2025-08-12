<?php
declare(strict_types=1);

namespace SMG\RestApiTest\Model;

use SMG\RestApiTest\Api\Data\TestApiDataInterface;

class TestApi implements TestApiDataInterface
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    private $title = 'this is test title';
    /**
     * @var string
     */
    protected $desc = 'this is test api description';
    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set ids
     *
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
        return $this->id=$id;
    }
    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * Set Title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        return $this->title = $title;
    }
    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->desc;
    }
    /**
     * Set Description
     *
     * @param string $desc
     * @return void
     */
    public function setDescription($desc)
    {
        return $this->desc = $desc;
    }
}
