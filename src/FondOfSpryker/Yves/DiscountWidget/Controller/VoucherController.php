<?php

namespace FondOfSpryker\Yves\DiscountWidget\Controller;

use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use SprykerShop\Yves\DiscountWidget\Controller\VoucherController as SprykerShopVoucherController;
use SprykerShop\Yves\DiscountWidget\Form\CartVoucherForm;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Yves\DiscountWidget\DiscountWidgetFactory getFactory()
 */
class VoucherController extends SprykerShopVoucherController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $form = $this->getFactory()
            ->getCartVoucherForm()
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voucherCode = $form->get(CartVoucherForm::FIELD_VOUCHER_CODE)->getData();

            $this->getFactory()
                ->createVoucherHandler()
                ->add($voucherCode);
        }

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }
}
