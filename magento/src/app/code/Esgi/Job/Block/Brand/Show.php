<?php
namespace Esgi\Job\Block\Brand;

//use Magento\Framework\View\Element\Template;
//use Magento\Framework\View\Element\Template\Context;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Framework\App\Request\Http;
use Esgi\Job\Api\BrandRepositoryInterface;
/**
 * Brand block
 */
class Show extends \Magento\Catalog\Block\Product\AbstractProduct
{
    protected $collectionFactory;
    protected $request;
    protected $brandRepository;

    public function __construct(
        Http $request,
        CollectionFactory $collectionFactory,
        BrandRepositoryInterface $brandRepository,
        \Magento\Catalog\Block\Product\Context $context,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->request = $request;
        $this->brandRepository = $brandRepository;
        parent::__construct($context, $data);
    }

    public function getBrand()
    {
        $brandId = $this->request->getParam('id');

        $brand = $this->brandRepository->getById($brandId);

        return $brand;
    }

    public function getLinkedProductsByBrand($brand)
    {
        $productIds = explode(',', $brand->getLinkedProducts());
        $productCollection = $this->collectionFactory->create();
        $productCollection
            ->addAttributeToFilter('entity_id', ['in' => $productIds])
            ->addAttributeToSelect('*');
        $countProduct = count($productCollection->getItems());
        if($countProduct > 0) {
            return $productCollection;
        }
        return false;
    }




}