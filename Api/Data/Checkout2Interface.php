<?php


namespace VexSoluciones\Checkout2\Api\Data;

interface Checkout2Interface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CHECKOUT2_ID = 'checkout2_id';
    const FORM_DAT = 'form_data';
    const RESPONSE = 'response';
    const INCREMENT_ID = 'increment_id';

    /**
     * Get checkout2_id
     * @return string|null
     */
    public function getCheckout2Id();

    /**
     * Set checkout2_id
     * @param string $checkout2_id
     * @return  \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setCheckout2Id($checkout2_id);

    /**
     * Get increment_id
     * @return string|null
     */
    public function getIncrementId();

    /**
     * Set increment_id
     * @param string $incrementId
     * @return  \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setIncrementId($incrementId);

    /**
     * Get response
     * @return string|null
     */
    public function getResponse();

    /**
     * Set response
     * @param string $response
     * @return  \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setResponse($form_data);

    /**
     * Get form_data
     * @return string|null
     */
    public function getFormData();

    /**
     * Set form_data
     * @param string $form_data
     * @return  \VexSoluciones\Checkout2\Api\Data\Checkout2Interface
     */
    public function setFormData($form_data);
    
}
