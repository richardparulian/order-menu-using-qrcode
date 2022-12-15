<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="w-100 text-center">
        <img src="<?= base_url('assets/img/logo/logo-milou.png'); ?>" style="height: 100px; width: 100px" />
    </div>
    <h4 class="fw-bold py-1 mb-2 text-center">Browse our menu</h4>

    <div class="nav-align-top mb-4">
        <div class="my">
            <ul id="showCategory" class="nav nav-pills mb-3 nav-fill" role="tablist" style="white-space: no-wrap; flex-wrap: unset; width: 100%; overflow: auto;">

            </ul>
        </div>

        <div class="tab-content" style="background: unset; box-shadow: unset; padding: unset;">
            <div class="tab-pane fade show active" id="#" role="tabpanel">
                <!-- Examples -->
                <div id="showMenu" class="row mb-1">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="alertMenu" class="my-alert-container">
    <div class="my-alert text-sm">
        1 menu successfully added to cart.
    </div>
</div>

<div id="loadMenu" class="w-100 text-center visually-hidden" style="height: -webkit-fill-available">
    <button class="btn btn-sm btn-dark d-inline-block align-middle" type="button" style="margin: 0 25% 0 25%" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span> Loading...</span>
    </button>
</div>