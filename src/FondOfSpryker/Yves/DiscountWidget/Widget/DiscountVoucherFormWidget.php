<?php

namespace FondOfSpryker\Yves\DiscountWidget\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \FondOfSpryker\Yves\DiscountWidget\DiscountWidgetFactory getFactory()
 */
class DiscountVoucherFormWidget extends AbstractWidget
{
    public const NAME = 'DiscountVoucherFormWidgetPlugin';

    /**
     * DiscountVoucherFormWidget constructor.
     *
     * @param  \ArrayObject|null  $data
     */
    public function __construct(?\ArrayObject $data)
    {
        $voucherForm = $this->getFactory()
            ->getCartVoucherForm();

        $this->addParameter('voucherForm', $voucherForm->createView());
        $this->addParameter('discount', $data[0] ?? null);
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
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@DiscountWidget/views/cart-discount-voucher-form/cart-discount-voucher-form.twig';
    }
}
