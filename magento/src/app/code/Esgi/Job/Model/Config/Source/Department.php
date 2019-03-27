<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Job\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Esgi\Job\Model\ResourceModel\Department\Collection;
use Esgi\Job\Model\ResourceModel\Department\CollectionFactory;

/**
 * Options provider for countries list
 *
 * @api
 * @since 100.0.2
 */
class Department implements ArrayInterface
{
    /**
     * Countries
     *
     * @var CollectionFactory $departmentCollectionFactory
     */
    protected $departmentCollectionFactory;

    /**
     * Options array
     *
     * @var array
     */
    protected $options;

    /**
     * Department constructor
     *
     * @param CollectionFactory $departmentCollectionFactory
     */
    public function __construct(
        CollectionFactory $departmentCollectionFactory
    ) {
        $this->departmentCollectionFactory = $departmentCollectionFactory;
    }

    /**
     * Return options array
     *
     * @param boolean $isMultiselect
     * @param string|array $foregroundCountries
     * @return array
     */
    public function toOptionArray($isMultiselect = false, $foregroundCountries = ''): array
    {
        $options[] = ['label' => '', 'value' => ''];
        $departmentCollection = $this->departmentCollectionFactory->create()
            ->addFieldToSelect('entity_id')
            ->addFieldToSelect('title');
        foreach ($departmentCollection as $department) {
            $options[] = [
                'label' => $department->getTitle(),
                'value' => $department->getId(),
            ];
        }
        return $options;
    }
}
