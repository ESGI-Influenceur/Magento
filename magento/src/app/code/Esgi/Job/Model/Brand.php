<?php

declare(strict_types=1);

namespace Esgi\Job\Model;

use Esgi\Job\Api\Data\BrandInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Esgi\Job\Model\ResourceModel\Brand as BrandResourceModel;

class Brand extends AbstractModel implements BrandInterface, IdentityInterface
{
    /**
     * Esgi Brand Brand cache tag
     */
    const CACHE_TAG = 'esgi_brand_brand';

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'esgi_brand';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'brand';

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BrandResourceModel::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve Brand id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Retrieve Brand name
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return BrandInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $title
     * @return BrandInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set linked products
     *
     * @param string $product_id
     * @return BrandInterface
     */
    public function setLinkedProducts($product_id)
    {
        return $this->setData(self::LINKED_PRODUCTS, $product_id);
    }

    /**
     * Set linked products
     *
     * @param string $product_id
     * @return BrandInterface
     */
    public function getLinkedProducts()
    {
        return $this->getData(self::LINKED_PRODUCTS);
    }
}