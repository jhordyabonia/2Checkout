<?php


namespace VexSoluciones\Checkout2\Model\Payment;

class Checkout2 extends \Magento\Payment\Model\Method\AbstractMethod
{
    protected $_code = "checkout2";
    protected $_isOffline = true;

    public function isAvailable(
        \Magento\Quote\Api\Data\CartInterface $quote = null
    ) {
        return parent::isAvailable($quote);
    }
    public function getAccount2Checkout(){
        return $this->getConfigData('number_account');
    }
    public function getInstructions()
    {
        return trim($this->getConfigData('instructions'));
    }
}
