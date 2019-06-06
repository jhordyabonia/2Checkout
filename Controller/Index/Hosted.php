<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile
namespace VexSoluciones\Checkout2\Controller\Index;
require_once(BP.'/lib/internal/Twocheckout.php');
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Context;

class Hosted extends \Magento\Framework\App\Action\Action
{    
    protected $tco = null;
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
        #\Twocheckout $tco,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \VexSoluciones\Checkout2\Model\Checkout2 $checkout2,
        \Magento\Framework\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository       
    ) {
        #$this->tco=$tco;
        $this->resultPageFactory=$resultPageFactory;
        $this->_quoteRepository = $quoteRepository;
        $this->_checkoutSession = $checkoutSession; 
		$this->_checkout2=$checkout2;
        $this->logger = $logger;
        parent::__construct($context);
    }
    public function execute()
    {   
        \Twocheckout::privateKey('BE632CB0-BB29-11E3-AFB6-D99C28100996');
        \Twocheckout::sellerId('901248204');

        // Your username and password are required to make any Admin API call.
        \Twocheckout::username('testlibraryapi901248204');
        \Twocheckout::password('testlibraryapi901248204PASS');

        // If you want to turn off SSL verification (Please don't do this in your production environment)
        \Twocheckout::verifySSL(false);  // this is set to true by default

        // To use your sandbox account set sandbox to true
        \Twocheckout::sandbox(true);

        // All methods return an Array by default or you can set the format to 'json' to get a JSON response.
        \Twocheckout::format('json');Twocheckout::privateKey('BE632CB0-BB29-11E3-AFB6-D99C28100996');
        \Twocheckout::sellerId('901248204');

        // Your username and password are required to make any Admin API call.
        \Twocheckout::username('testlibraryapi901248204');
        \Twocheckout::password('testlibraryapi901248204PASS');

        // If you want to turn off SSL verification (Please don't do this in your production environment)
        \Twocheckout::verifySSL(false);  // this is set to true by default

        // To use your sandbox account set sandbox to true
        \Twocheckout::sandbox(true);

        // All methods return an Array by default or you can set the format to 'json' to get a JSON response.
        \Twocheckout::format('json');
        // Twocheckout::sandbox(true);  #Uncomment to use Sandbox
        
        try {
            $charge = \Twocheckout_Charge::auth(array(
                "merchantOrderId" => "123",
                "token" => 'Y2U2OTdlZjMtOGQzMi00MDdkLWJjNGQtMGJhN2IyOTdlN2Ni',
                "currency" => 'USD',
                "total" => '10.00',
                "billingAddr" => array(
                    "name" => 'Vex Soluciones',
                    "addrLine1" => 'Calle Grimaldo del Solar 162, Oficina 807',
                    "city" => 'Lima',
                    "state" => 'Miraflores',
                    "zipCode" => '07001',
                    "country" => 'PE',
                    "email" => 'soporte@vexsoluciones.com',
                    "phoneNumber" => '+51 970771094'
                ),
                "shippingAddr" => array(
                    "name" => 'Vex Soluciones',
                    "addrLine1" => 'Calle Grimaldo del Solar 162, Oficina 807',
                    "city" => 'Liam',
                    "state" => 'Miraflores',
                    "zipCode" => '07001',
                    "country" => 'PE',
                    "email" => 'soporte@vexsoluciones.com',
                    "phoneNumber" => '+51 970771094'
                )
            ), 'array');
            if ($charge['response']['responseCode'] == 'APPROVED') {
                echo "Thanks for your Order!";
            }
        } catch (\Twocheckout_Error $e) {
            $e->getMessage();
        }        
    }
}