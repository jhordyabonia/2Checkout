<?php

namespace VexSoluciones\Checkout2\Controller\Success;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{    
    protected $logger = null;
    protected $checkout2 = null;
    protected $scopeConfig = null;
     /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \VexSoluciones\Checkout2\Model\Checkout2 $checkout2,
        \Magento\Sales\Api\Data\OrderInterface $order,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->orderModel = $order;
		$this->checkout2=$checkout2;
        parent::__construct($context);
    }
    public function getOnepage()
    {
        return $this->_objectManager->get(\Magento\Checkout\Model\Type\Onepage::class);
    }
    public function execute()
    {        
            
        if(!isset($_GET['quote_id'])){
            return $this->resultRedirectFactory->create()->setPath('checkout/cart');
        }

        $order = $this->orderModel->load($_GET['quote_id'],'quote_id');

        if(!$order ){
            return $this->resultRedirectFactory->create()->setPath('checkout/cart');
        }

        if($order->getStatus()!='pending_checkout2'){
            return $this->resultRedirectFactory->create()->setPath('checkout/cart');
        }

        $comment = new \Magento\Framework\Phrase('Paid 2Checkout');
        $order->addStatusHistoryComment($comment);
        $order->setStatus('paid_checkout2');
        $order->save();

        $this->checkout2->load($_GET['quote_id'],'increment_id');
        $this->checkout2->setResponse(json_encode($_GET));
        $this->checkout2->save();     
       
        $session = $this->getOnepage()->getCheckout();
        $session->clearQuote();
        //@todo: Refactor it to match CQRS
        $resultPage = $this->resultPageFactory->create();
        $this->_eventManager->dispatch(
            'checkout_onepage_controller_success_action',
            ['order_ids' => [$order->getId()]]
        );
        return $resultPage;     
    }
}