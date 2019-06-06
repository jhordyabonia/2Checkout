<?php

namespace AgSoftware\Checkout2\Controller\Index;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{    
    protected $logger = null;
    protected $_checkout2 = null;
    protected $_checkoutSession;
    protected $_quoteRepository;
     /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \AgSoftware\Checkout2\Model\Checkout2 $checkout2,
        \Magento\Framework\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
    ) {
        $this->resultPageFactory=$resultPageFactory;
        $this->_quoteRepository = $quoteRepository;
        $this->_checkoutSession = $checkoutSession; 
		$this->_checkout2=$checkout2;
        $this->logger = $logger;
        parent::__construct($context);
    }
    public function execute()
    {           
		$session=$this->_checkoutSession->getData();
        $data = [
			'increment_id' => $session['quote_id_1'],
			'form_data' => json_encode($_POST),
		];
		$this->_checkout2->setData($data);
		$success=$this->_checkout2->save();     
		echo '{"success":'.($success?'true':'false').',"checkout_id":"'.$this->_checkout2->getCheckuoutId().'"}'; 	        
    }
}