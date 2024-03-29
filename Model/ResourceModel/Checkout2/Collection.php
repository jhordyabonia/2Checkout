<?php


namespace AgSoftware\Checkout2\Model\ResourceModel\Checkout2;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \AgSoftware\Checkout2\Model\Checkout2::class,
            \AgSoftware\Checkout2\Model\ResourceModel\Checkout2::class
        );
    }
}
