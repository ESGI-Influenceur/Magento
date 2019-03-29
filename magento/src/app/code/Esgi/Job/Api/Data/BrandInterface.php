<?php

declare(strict_types=1);

namespace Esgi\Job\Api\Data;

/**
 * Esgi Brand interface.
 * @api
 */
interface BrandInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID      = 'entity_id';
    const TITLE    = 'title';
    const LINKED_PRODUCTS    = 'linked_products';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get linked products
     *
     * @return string|null
     */
    public function getLinkedProducts();

    /**
     * Set ID
     *
     * @param int $id
     * @return BrandInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $title
     * @return BrandInterface
     */
    public function setTitle($title);

    /**
     * Set linked products
     *
     * @param string $productId
     * @return BrandInterface
     */
    public function setLinkedProducts($productId);
}
