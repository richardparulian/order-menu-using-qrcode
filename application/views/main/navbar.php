<?php if ($this->uri->segment(1) == 'main' || $this->uri->segment(1) == "" || $this->uri->segment(1) == "milou-order" || $this->uri->segment(1) == "milou-add-order") : ?>

<?php else : ?>
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <?php if ($this->uri->segment(1) != 'cart-item') : ?>
            <!-- <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div> -->
        <?php else : ?>
            <div class="navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a href="<?= base_url('menu-order/' . $this->uri->segment(2)); ?>">
                    <i class="bx bx-arrow-back bx-sm"></i>
                </a>
            </div>
        <?php endif; ?>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <?php if ($this->uri->segment(1) != 'cart-item') : ?>
                <!-- Search -->
                <div class="navbar-nav align-items-left w-100">
                    <div class="nav-item d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="findMenu" name="findMenu" class="form-control border-0 shadow-none" placeholder="what would you like to eat?" aria-label="Find Menu" />
                    </div>
                </div>
                <!-- /Search -->
            <?php else : ?>
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center">Cart</div>
                </div>
            <?php endif; ?>

            <?php if ($this->uri->segment(1) != 'cart-item') : ?>
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a href="<?= base_url('cart-item/' . $this->uri->segment(2)); ?>" class="nav-link">
                            <div id="" class="top-right">
                                <i class="bx bx-cart bx-md"></i>
                                <p class="count" id="showTotalCart">

                                </p>
                            </div>
                        </a>
                    </li>
                    <!--/ User -->
                </ul>
            <?php endif; ?>

        </div>
    </nav>
    <!-- / Navbar -->
<?php endif; ?>

<!-- Content wrapper -->
<div class="content-wrapper">