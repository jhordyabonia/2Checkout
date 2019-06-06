define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'checkout2',
                component: 'VexSoluciones_Checkout2/js/view/payment/method-renderer/checkout2-method'
            }
        );
        return Component.extend({});
    }
);