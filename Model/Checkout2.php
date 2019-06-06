<?php


namespace AgSoftware\Checkout2\Model;

use AgSoftware\Checkout2\Api\Data\Checkout2Interface;
use Magento\Framework\Api\DataObjectHelper;
use AgSoftware\Checkout2\Api\Data\Checkout2InterfaceFactory;

class Checkout2 extends \Magento\Framework\Model\AbstractModel
{

    protected $checkout2DataFactory;

    protected $dataObjectHelper;

    protected $_code = "checkout2";
    protected $_eventPrefix = 'agsoftware_checkout2';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param Checkout2InterfaceFactory $checkout2DataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \AgSoftware\Checkout2\Model\ResourceModel\Checkout2 $resource
     * @param \AgSoftware\Checkout2\Model\ResourceModel\Checkout2\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        Checkout2InterfaceFactory $checkout2DataFactory,
        DataObjectHelper $dataObjectHelper,
        \AgSoftware\Checkout2\Model\ResourceModel\Checkout2 $resource,
        \AgSoftware\Checkout2\Model\ResourceModel\Checkout2\Collection $resourceCollection,
        array $data = []
    ) {
        $this->checkout2DataFactory = $checkout2DataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function getAccount2Checkout(){
        return $this->getConfigData('number_account');
    }
    /**
     * Retrieve 2Checkout model with tucompra data
     * @return Checkout2Interface
     */
    public function getDataModel()
    {
        $checkout2Data = $this->getData();
        
        $checkout2DataObject = $this->checkout2DataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $checkout2DataObject,
            $checkout2Data,
            Checkout2Interface::class
        );
        
        return $checkout2DataObject;
    }
 
}



