<?php


namespace VexSoluciones\Checkout2\Model\Data;

use VexSoluciones\Checkout2\Api\Data\Checkout2Interface;

class Checkout2 extends \Magento\Framework\Api\AbstractExtensibleObject implements Checkout2Interface
{
 
    /**
     * Get checkout2_id
     * @return string|null
     */
    public function getCheckout2Id()
    {
        return $this->_get(self::TUCOMPRA_ID);
    }

     /**
     * Set checkout2_id
     * @param string $checkout2_id
     * @return  \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setCheckout2Id($checkout2_id)
    {
        return $this->setData(self::TUCOMPRA_ID, $tucompraId);
    }

    /**
     * Get increment_id
     * @return string|null
     */
    public function getIncrementId()
    {
        return $this->_get(self::INCREMENT_ID);
    }

    /**
     * Set increment_id
     * @param string $incrementId
     * @return \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setIncrementId($incrementId)
    {
        return $this->setData(self::INCREMENT_ID, $incrementId);
    }


    /**
     * Get response
     * @return string|null
     */
    public function getResponse()
    {
        return $this->_get(self::RESPONSE);
    }

    /**
     * Set response
     * @param string $response
     * @return \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setResponse($response)
    {
        return $this->setData(self::RESPONSE, $response);
    }
     /**
     * Get form_data
     * @return string|null
     */
    public function getFormData()
    {
        return $this->_get(self::FORM_DATA);
    }


    /**
     * Set form_data
     * @param string $form_data
     * @return  \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setFormData($form_data)
    {
        return $this->setData(self::FORM_DATA, $form_data);
    }

}
