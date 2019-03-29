<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Job\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

/**
 * Options provider for countries list
 *
 * @api
 * @since 100.0.2
 */
class Product implements ArrayInterface
{
    /**
     * Countries
     *
     * @var CollectionFactory $productCollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * Options array
     *
     * @var array
     */
    protected $options;

    /**
     * Department constructor
     *
     * @param CollectionFactory $productCollectionFactory;
     */
    public function __construct(
        CollectionFactory $productCollectionFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * Return options array
     *
     * @param boolean $isMultiselect
     * @return array
     */
    public function toOptionArray($isMultiselect = true): array
    {
        $options[] = ['label' => '', 'value' => ''];
        $productCollectionFactory = $this->productCollectionFactory->create()
            ->addFieldToSelect('entity_id')
            ->addFieldToSelect('name');
        foreach ($productCollectionFactory as $product) {
            $options[] = [
                'label' => $product->getName(),
                'value' => $product->getId(),
            ];
        }
        return $options;
    }
}
