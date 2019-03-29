<?php

declare(strict_types=1);

namespace Esgi\Job\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for Brand job search results.
 * @api
 */
interface BrandSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get jobs list.
     *
     * @return \Esgi\Job\Api\Data\BrandInterface[]
     */
    public function getItems();

    /**
     * Set jobs list.
     *
     * @param \Esgi\Job\Api\Data\BrandInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
