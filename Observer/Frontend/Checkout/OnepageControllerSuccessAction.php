<?php


namespace AgSoftware\Checkout2\Observer\Frontend\Checkout;

class OnepageControllerSuccessAction implements \Magento\Framework\Event\ObserverInterface
{


    private $url;
    private $logger;
    private $responseFactory;
    private $orderModel;
    private $checkout2;
    protected $_checkoutSession;

    /**
     * OnepageControllerSuccessAction constructor.
     * @param \Magento\Framework\App\ResponseFactory $responseFactory
     * @param \Magento\Framework\UrlInterface $url
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Sales\Api\Data\OrderInterface $order,
        \Magento\Checkout\Model\Session $checkoutSession,
        \AgSoftware\Checkout2\Model\Checkout2 $checkout2,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Psr\Log\LoggerInterface $logger
    )  {
        $this->scopeConfig = $scopeConfig;
        $this->_checkoutSession = $checkoutSession; 
        $this->responseFactory = $responseFactory;
        $this->url = $url;
        $this->logger = $logger;
        $this->orderModel = $order;
        $this->checkout2 = $checkout2;
    }

    public function getConfigData($config_path)
    {
        return $this->scopeConfig->getValue(
            'payment/checkout2/'.$config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        try {
            $url="https://www.2checkout.com/checkout/purchase?";

            if($this->getConfigData('test'))
                $url="https://sandbox.2checkout.com/checkout/purchase?";

            $orderIds = $observer->getEvent()->getOrderIds();
            foreach ($orderIds as $order_id) {
                $order = $this->orderModel->load($order_id);
                $this->checkout2->load($order->getQuoteId(),'increment_id');
                if($this->checkout2->getResponse()==null){
                    if($this->checkout2->getFormData()!=null){
                        if($order->getPayment()->getMethod() == 'checkout2') {
                            if($order->getStatus()=='pending'){
                                $comment = new \Magento\Framework\Phrase('Awaiting confirmation of 2Checkout');
                                $order->addStatusHistoryComment($comment);
                                $order->setStatus('pending_checkout2');
                                $order->save();
                                $params=(Object)json_decode($this->checkout2->getFormData());
                                $params->quote_id=$order->getQuoteId();
                                $params->sid=$this->getConfigData('number_account');
                                $CustomRedirectionUrl = $url.http_build_query( $params, '', '&' );
                                $this->responseFactory->create()->setRedirect($CustomRedirectionUrl)->sendResponse();        
                                exit();                        
                            }//endif($order->getStatus()=='pending')
                        }//endif ($order->getPayment()->getMethod() == 'checkout2')
                    }//endif($this->checkout2->getFormData()!=null)
                }//endif($this->checkout2->getResponse()==null)
            }//endforecah
        }catch (\Exception $e){
            $this->logger->error($e->getMessage());
        }
    }
}
