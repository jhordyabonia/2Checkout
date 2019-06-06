<?php


namespace VexSoluciones\Checkout2\Model\ResourceModel;

class Checkout2 extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('vexsoluciones_checkout2', 'checkout2_id');
    }
}
