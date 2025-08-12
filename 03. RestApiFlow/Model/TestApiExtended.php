<?php
declare(strict_types=1);

namespace SMG\RestApiTest\Model;

use SMG\RestApiTest\Model\TestApi;

class TestApiExtended extends TestApi
{
    /**
     * @var string
     */
    protected $title = "This is title of extended class";
    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return  ucfirst($this->title);
    }
}
