<?php

namespace FondOfSpryker\Yves\DiscountWidget;

use FondOfSpryker\Yves\DiscountWidget\Handler\VoucherHandler;
use SprykerShop\Yves\DiscountWidget\DiscountWidgetFactory as SprykerShopDiscountWidgetFactory;

class DiscountWidgetFactory extends SprykerShopDiscountWidgetFactory
{
    /**
     * @return \SprykerShop\Yves\DiscountWidget\Handler\VoucherHandler
     */
    public function createVoucherHandler()
    {
        return new VoucherHandler(
            $this->getCalculationClient(),
            $this->getQuoteClient(),
            $this->getFlashMessenger()
        );
    }
}
