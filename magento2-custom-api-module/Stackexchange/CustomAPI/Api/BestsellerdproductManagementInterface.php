<?php

/**
 * Product type provider
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Stackexchange\CustomAPI\Api;

/**
 * @api
 */

interface BestsellerdproductManagementInterface
{

    /**
     * Retrieve available product types
     *
     * @return \Magento\Catalog\Api\Data\ProductTypeInterface[]
     */

    public function getproducts();

}