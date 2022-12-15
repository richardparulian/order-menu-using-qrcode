<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= base_url('assets/img/logo/logo-milou.png'); ?>" style="height: 75px; width: 75px" />
            </span>
            <span class="app-brand-text demo menu-text fw-bolder" style="font-size: unset; text-transform: unset;">Scan QR Code</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1" id="nav">
        <!-- Menu -->
        <li id="menu" class="menu-item">
            <a href="<?= base_url('menu/' . $this->uri->segment(2)) ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Analytics">Our Menu</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">About</span>
        </li>
        <!-- Contact Us -->
        <li class="menu-item">
            <a href="<?= base_url('contact-us'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-phone-call"></i>
                <div data-i18n="Analytics">Contact Us</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">