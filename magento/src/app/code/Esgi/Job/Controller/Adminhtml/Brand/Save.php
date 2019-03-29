<?php

namespace Esgi\Job\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action\Context;
use Esgi\Job\Model\Brand;
use Esgi\Job\Model\BrandFactory;
use Esgi\Job\Model\ResourceModel\Brand as BrandResourceModel;
use Esgi\Job\Api\BrandRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Esgi\Job\Controller\Adminhtml\Brand
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * Description $brandRepository field
     *
     * @var BrandRepositoryInterface $brandRepository
     */
    protected $brandRepository;
    /**
     * Description $brandFactory field
     *
     * @var BrandFactory $brandFactory
     */
    protected $brandFactory;
    /**
     * Description $brandResourceModel field
     *
     * @var BrandResourceModel $brandResourceModel
     */
    protected $brandResourceModel;

    /**
     * Save constructor
     *
     * @param Context                       $context
     * @param \Magento\Framework\Registry   $coreRegistry
     * @param DataPersistorInterface        $dataPersistor
     * @param BrandRepositoryInterface $brandRepository
     * @param BrandFactory             $brandFactory
     * @param BrandResourceModel       $brandResourceModel
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        BrandRepositoryInterface $brandRepository,
        BrandFactory $brandFactory,
        BrandResourceModel $brandResourceModel
    ) {
        parent::__construct($context, $coreRegistry);

        $this->dataPersistor           = $dataPersistor;
        $this->brandRepository    = $brandRepository;
        $this->brandFactory       = $brandFactory;
        $this->brandResourceModel = $brandResourceModel;
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data           = $this->getRequest()->getPostValue();

        if ($data) {
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            /** @var brand $model */
            $model = $this->brandFactory->create();

            $id = $this->getRequest()->getParam('entity_id');
            $productsId = $this->getRequest()->getParam('linked_products');

            if ($id) {
                try {
                    $model = $this->brandRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This brand no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            if ($productsId) {
                $model->setLinkedProducts(join(",", $productsId));
            }

            try {
                $this->brandRepository->save($model);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the brand.'));
            }

            $this->dataPersistor->set('job_brand', $data);

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
