<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y" style="padding-top: 1rem !important;">
    <div class="fw-bold mb-2">
        <span class="badge rounded-pill bg-info px-3">Table - <?= $transaction['TableNumber']; ?></span>
    </div>
    <!-- Examples -->
    <div class="w-100 mb-2">
        <form id="formConfirm" method="post">
            <div id="showCartItems" class="row">

            </div>
            <div id="showBtnConfirm" class="mb-3">

            </div>
        </form>
    </div>
</div>

<div id="alertDestroy" class="my-alert-container">
    <div class="my-alert text-sm">
        1 menu deleted successfully.
    </div>
</div>

<div id="alertAddOn" class="my-alert-container">
    <div class="my-alert text-sm">
        1 add on successfully added to cart.
    </div>
</div>

<div id="alertConfirm" class="my-alert-container">
    <div class="my-alert text-sm" style="margin: 0 5% 0 5%">
        Congratulations, your order has been received.
    </div>
</div>