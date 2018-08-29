<?php

namespace FondOfSpryker\Yves\DiscountWidget\Plugin\CartPage;

use Pyz\Yves\CartPage\Dependency\Plugin\DiscountWidget\DiscountVoucherFormWidgetPluginInterface;
use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;
use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;

/**
 * @method \FondOfSpryker\Yves\DiscountWidget\DiscountWidgetFactory getFactory()
 */
class DiscountVoucherFormWidgetPlugin extends AbstractWidgetPlugin implements WidgetPluginInterface, DiscountVoucherFormWidgetPluginInterface
{
    /**
     * @param \ArrayObject|null $data
     */
    public function initialize(?\ArrayObject $data): void
    {
        $voucherForm = $this->getFactory()
            ->getCartVoucherForm();

        $this->addParameter('voucherForm', $voucherForm->createView());
        $this->addParameter('discount', $data[0]);
    }

    /**
     * @api
     *
     * @return string
     */
    public static function getName(): string
    {
        return static::NAME;
    }

    /**
     * @api
     *
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@DiscountWidget/views/cart-discount-voucher-form/cart-discount-voucher-form.twig';
    }
}

