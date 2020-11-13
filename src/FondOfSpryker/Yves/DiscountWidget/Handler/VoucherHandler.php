<?php

namespace FondOfSpryker\Yves\DiscountWidget\Handler;

use ArrayObject;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerShop\Yves\DiscountWidget\Handler\VoucherHandler as SprykerShopVoucherHandler;

class VoucherHandler extends SprykerShopVoucherHandler
{
    /**
     * @param string $voucherCode
     *
     * @return void
     */
    public function add($voucherCode)
    {
        $quoteTransfer = $this->quoteClient->getQuote();
        $quoteTransfer = $this->removeExistingDiscount($quoteTransfer);

        $voucherDiscount = new DiscountTransfer();
        $voucherDiscount->setVoucherCode($voucherCode);
        $quoteTransfer->addVoucherDiscount($voucherDiscount);

        $quoteTransfer = $this->calculationClient->recalculate($quoteTransfer);
        $this->addFlashMessages($quoteTransfer, $voucherCode);

        $this->quoteClient->setQuote($quoteTransfer);
    }

    /**
     * @param string $voucherCode
     *
     * @return void
     */
    public function remove($voucherCode)
    {
        $quoteTransfer = $this->quoteClient->getQuote();
        $quoteTransfer = $this->removeExistingDiscount($quoteTransfer);
        $quoteTransfer = $this->calculationClient->recalculate($quoteTransfer);

        $this->setFlashMessagesFromLastZedRequest($this->calculationClient);
        $this->quoteClient->setQuote($quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    protected function removeExistingDiscount(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $quoteTransfer->setVoucherDiscounts(new ArrayObject());

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $voucherCode
     *
     * @return void
     */
    protected function addFlashMessages($quoteTransfer, $voucherCode)
    {
        if ($this->isVoucherFromPromotionDiscount($quoteTransfer, $voucherCode)) {
            return;
        }

        $this->setFlashMessagesFromLastZedRequest($this->calculationClient);
    }
}
