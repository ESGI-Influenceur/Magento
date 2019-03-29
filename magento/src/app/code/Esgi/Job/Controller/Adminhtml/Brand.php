<?php

namespace Esgi\Job\Controller\Adminhtml;

abstract class Brand extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Esgi_Job::brand';
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry         $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        parent::__construct($context);

        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Esgi_Job::brand')->addBreadcrumb(__('Brand'), __('Brand'))->addBreadcrumb(
            __('Brand'),
            __('Brand')
        );

        return $resultPage;
    }
}
