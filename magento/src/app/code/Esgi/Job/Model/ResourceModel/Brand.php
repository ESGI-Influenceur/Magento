<?php

declare(strict_types=1);

namespace Esgi\Job\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Brand extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('esgi_job_brand', 'entity_id');
    }
}