<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile
namespace VexSoluciones\Checkout2\Observer\Sales;

use Magento\Framework\Event\ObserverInterface;
use VexSoluciones\Checkout2\Model\Payment\Checkout2;

class OrderPaymentSaveBefore implements \Magento\Framework\Event\ObserverInterface
{
    
    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {

        #$this->logger->info("hellow");

        /** @var \Magento\Sales\Model\Order\Payment $payment */
        $payment = $observer->getEvent()->getPayment();
        $instructionMethods = [
            "checkout2"
        ];
        if (in_array($payment->getMethod(), $instructionMethods)) {
            $payment->setAdditionalInformation(
                'instructions',
                $payment->getMethodInstance()->getInstructions()
            );
        }
    }


}