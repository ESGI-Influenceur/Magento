<?php

declare(strict_types=1);

namespace Esgi\Job\Api;

/**
 * Esgi brand CRUD interface.
 * @api
 */
interface BrandRepositoryInterface
{
    /**
     * Save block.
     *
     * @param \Esgi\Job\Api\Data\BrandInterface $brand
     * @return \Esgi\Job\Api\Data\BrandInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\BrandInterface $brand);

    /**
     * Retrieve $brand.
     *
     * @param int $brandId
     * @return \Esgi\Job\Api\Data\BrandInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($brandId);

    /**
     * Retrieve Brands matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Esgi\Job\Api\Data\BrandSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Brand.
     *
     * @param \Esgi\Job\Api\Data\BrandInterface $brand
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\BrandInterface $brand);

    /**
     * Delete Brand by ID.
     *
     * @param int $brandId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($brandId);
}
