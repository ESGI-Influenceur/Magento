<?php

declare(strict_types=1);

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Job\Model;

use Esgi\Job\Api\BrandRepositoryInterface;
use Esgi\Job\Api\Data;
use Esgi\Job\Model\ResourceModel\Brand as BrandResource;
use Esgi\Job\Model\ResourceModel\Brand\CollectionFactory as BrandCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BrandRepository implements BrandRepositoryInterface
{
    /**
     * @var BrandResource
     */
    protected $resource;

    /**
     * @var BrandFactory
     */
    protected $brandFactory;

    /**
     * @var BrandCollectionFactory
     */
    protected $brandCollectionFactory;

    /**
     * @var Data\BrandSearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @param BrandResource $resource
     * @param BrandFactory $brandFactory
     * @param BrandCollectionFactory $brandCollectionFactory
     * @param Data\BrandSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        BrandResource $resource,
        BrandFactory $brandFactory,
        \Esgi\Job\Api\Data\BrandInterfaceFactory $databrandFactory,
        BrandCollectionFactory $brandCollectionFactory,
        Data\BrandSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->brandFactory = $brandFactory;
        $this->brandCollectionFactory = $brandCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Brand.php data
     *
     * @param \Esgi\Job\Api\Data\BrandInterface $brand
     * @return Brand
     * @throws CouldNotSaveException
     */
    public function save(Data\BrandInterface $brand)
    {
        try {
            $this->resource->save($brand);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $brand;
    }

    /**
     * Load Brand.php data by given Brand.php Identity
     *
     * @param string $brandId
     * @return Brand
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($brandId)
    {
        $brand = $this->brandFactory->create();
        $this->resource->load($brand, $brandId);
        if (!$brand->getId()) {
            throw new NoSuchEntityException(__('Brand.php with id "%1" does not exist.', $brand));
        }

        return $brand;
    }

    /**
     * Load Brand.php data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Esgi\Job\Api\Data\BrandSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Esgi\Job\Model\ResourceModel\Brand\Collection $collection */
        $collection = $this->brandCollectionFactory->create();

        /** @var Data\BrandSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete Brand.php
     *
     * @param \Esgi\Job\Api\Data\BrandInterface $brand
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\BrandInterface $brand)
    {
        try {
            $this->resource->delete($brand);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Brand.php by given Brand.php Identity
     *
     * @param string $brandId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($brandId)
    {
        return $this->delete($this->getById($brandId));
    }
}
