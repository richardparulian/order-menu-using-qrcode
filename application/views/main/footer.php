<?php if ($this->uri->segment(1) == 'main' || $this->uri->segment(1) == "" || $this->uri->segment(1) == "milou-order" || $this->uri->segment(1) == "milou-add-order") : ?>

<?php else : ?>
    <!-- Footer -->
    <!-- <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , made with by
                <a href="#" target="_blank" class="footer-link fw-bolder">Triquetra</a>
            </div>
        </div>
    </footer> -->
    <!-- / Footer -->
<?php endif; ?>

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/libs/popper/popper.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/js/bootstrap.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/js/menu.js'); ?>"></script>
<!-- endbuild -->

<!-- Main JS -->
<script src="<?= base_url('assets/js/main.js'); ?>"></script>
<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
    /* show active sidebar */
    var url = window.location.href
    var segment1 = "<?= $this->uri->segment(1) ?>"
    var segment2 = "<?= $this->uri->segment(2) ?>"

    $('ul.menu-inner li.menu-item a').filter(function() {
        return this.href == url
    }).parent().addClass('active')

    if (segment1 == '' || segment2) {
        $('#menu').addClass('active')
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    const slider = document.querySelector('.nav-item')
    let isDown = false
    let startX
    let scrollLeft

    $('#notes').keyup(function() {

        var characterCount = $(this).val().length,
            current = $('#current'),
            maximum = $('#maximum'),
            theCount = $('#the-count')

        current.text(characterCount);

        /*This isn't entirely necessary, just playin around*/
        if (characterCount < 70) {
            current.css('color', '#666')
        }
        if (characterCount > 70 && characterCount < 90) {
            current.css('color', '#666')
        }
        if (characterCount > 90 && characterCount < 100) {
            current.css('color', '#666')
        }
    });

    function showCategory() {
        var url = "<?= site_url('main/getCategory') ?>"

        $.ajax({
            type: "ajax",
            url: url,
            method: "GET",
            async: true,
            dataType: "json",
            success: function(data) {
                var html = ""

                html = '<li class="nav-item" style="margin-right: 10px; font-size: small;">' +
                    '<button type="button" id="btnAllCategory" class="nav-link text-sm active" role="tab" data-bs-toggle="tab" data-bs-target="#" aria-controls="navs-pills-justified-home" aria-selected="true" style="border: 1px solid #233446; width: 200px; padding: 0.25rem 0.25rem;">All</button>' +
                    '</li>'

                for (var i = 0; i < data.length; i++) {
                    html += '<li class="nav-item" style="margin-right: 10px; font-size: small;">' +
                        '<button type="button" id="btnCategory" data-category="' + data[i].CategoryName + '" class="btnCategory nav-link text-sm" role="tab" data-bs-toggle="tab" data-bs-target="#" aria-controls="navs-pills-justified-home" aria-selected="true" style="border: 1px solid #233446; width: 200px; padding: 0.25rem 0.25rem;">' +
                        data[i].CategoryName +
                        '</button>' +
                        '</li>'
                }
                $("#showCategory").html(html)
            },
            error: (error) => {
                console.log(JSON.stringify(error))
            }
        })
    }

    function showMenu() {
        var url = "<?= site_url('main/getMenu') ?>"

        $.ajax({
            type: "ajax",
            url: url,
            method: "GET",
            async: true,
            dataType: "json",
            success: function(data) {
                var html = ""
                var image = ""

                for (var i = 0; i < data.length; i++) {

                    if (data[i].MenuImage == null || data[i].MenuImage == '') {
                        image = '<img class="card-img card-img-left" src="<?= site_url('assets/img/product/logo-milou.png'); ?>" alt="Milou Farm House" />'
                    } else {
                        image = '<img class="card-img card-img-left" src="http://151.106.113.196:8097/assets/dist/menuimg/' + data[i].MenuImage + '" alt="' + data[i].MenuName + '" />'
                    }

                    html += '<div class="col-md-6">' +
                        '<div class="card mb-3">' +
                        '<div class="row g-0">' +
                        '<div class="col-md-4">' +
                        image +
                        '<div class="card-img-overlay">' +
                        '<span class="badge bg-light text-black text-sm font-extrabold" style="box-shadow: 0 0.125rem 0.25rem 0 rgb(109 110 119 / 40%);">' + new Intl.NumberFormat("id-ID", {
                            currency: "IDR"
                        }).format(data[i].MenuPrice) + ' IDR</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-8">' +
                        '<div class="card-body border-0" style="position: relative; padding: 0.25rem 1rem 1rem;">' +
                        '<label class="card-title">' + data[i].MenuName + '</label>' +
                        '<div class="main-info">' +
                        '<div class="main-info-icon text-sm">' +
                        '<button type="submit" id="btnCartAllCategory" data-id="' + data[i].MenuID + '" class="btn btn-sm btn-dark"><i class="bx bxs-cart-add bx-sm"></i> Add to cart</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                }
                $("#showMenu").html(html)
            },
            error: (error) => {
                console.log(JSON.stringify(error))
            }
        })
    }

    function showCart() {
        var segment1 = "<?= $this->uri->segment(1) ?>"
        var segment2 = "<?= $this->uri->segment(2) ?>"
        var url = "<?= site_url('main/getTransactionDetail/') ?>" + segment2

        if (segment1 != "milou-order") {

            $.ajax({
                type: "ajax",
                url: url,
                method: "GET",
                async: true,
                dataType: "json",
                success: function(data) {
                    var html = ""
                    var htmlBtn = ""
                    var input = ""
                    var image = ""
                    var notes = ""
                    var qty = ""
                    var confirm = ""
                    var btnNotes = ""
                    var btnAddOn = ""
                    var btnTrash = ""
                    var btnIncDec = ""
                    var count = 0
                    var countStatus = 0

                    for (var x = 0; x < data['transDetail'].length; x++) {
                        count++
                    }

                    if (count > 0) {
                        for (var i = 0; i < data['transDetail'].length; i++) {

                            if (data['transDetail'][i].StatusForKitchen == 0) {
                                countStatus++

                                for (var j = 0; j < data['menu'].length; j++) {
                                    if (data['menu'][j].MenuID == data['transDetail'][i].MenuID) {
                                        if (data['menu'][j].MenuType == "AddOn") {
                                            btnAddOn = ''
                                        } else {
                                            btnAddOn = '<button type="button" id="addOn" data-id="' + data['menu'][j].MenuID + '" data-bs-toggle="modal" data-bs-target="#addOnModal" class="btn btn-icon btn-outline-secondary" style="height: calc(1.9rem)"><i class="tf-icons bx bx-add-to-queue bx-sm"></i></button>'
                                        }
                                    }
                                }

                                if (data['transDetail'][i].NoteDetail == '') {
                                    notes = ''
                                    btnNotes = '<button type="button" id="btnNotesID" data-id="' + data['transDetail'][i].TransactionDetailID + '" data-bs-toggle="modal" data-bs-target="#notesModal" class="btn btn-icon btn-outline-secondary" style="height: calc(1.9rem); margin-left: 3px"><i class="tf-icons bx bx-note bx-sm"></i></button>'
                                } else {
                                    notes = '<textarea class="form-control" id="" rows="1" disabled>' + data['transDetail'][i].NoteDetail + '</textarea>'
                                    btnNotes = '<button type="button" id="btnNotesID" data-id="' + data['transDetail'][i].TransactionDetailID + '" data-bs-toggle="modal" data-bs-target="#notesModal" class="btn btn-icon btn-outline-secondary" style="height: calc(1.9rem); margin-left: 3px"><i class="tf-icons bx bx-edit bx-sm"></i></button>'
                                }

                                qty = ''
                                confirm = ''
                                input = '<span class="info-box-text py-5" style="margin-right: 10px"><input class="check form-check-input" type="checkbox" name="id[]" value="' + data['transDetail'][i].TransactionDetailID + '" checked></span>'
                                btnTrash = '<button type="button" id="btnDestroy" data-id="' + data['transDetail'][i].TransactionDetailID + '" class="btn btn-icon btn-outline-secondary" style="height: calc(1.9rem); margin-left: 3px"><span class="tf-icons bx bx-trash bx-sm"></span></button>'
                                btnIncDec = '<span class="input-number-decrement" data-id="' + data['transDetail'][i].TransactionDetailID + '" data-qty="' + data['transDetail'][i].Qty + '" style="margin-left: 3px;"><i class="bx bx-minus bx-xs"></i></span><input id="myInput" data-id="' + data['transDetail'][i].TransactionDetailID + '" pattern="+62[7-9]{2}-[0-9]{3}-[0-9]{4}" onkeypress="return isNumber(event)" class="input-number text-sm" type="tel" name="qty" value="' + data['transDetail'][i].Qty + '" maxlength="3" min="1" /><span class="input-number-increment" data-id="' + data['transDetail'][i].TransactionDetailID + '" data-qty="' + data['transDetail'][i].Qty + '"><i class="bx bx-plus bx-xs"></i></span>'
                            } else {
                                btnAddOn = ''
                                btnNotes = ''
                                btnTrash = ''
                                btnIncDec = ''
                                qty = '(X' + data['transDetail'][i].Qty + ')'
                                confirm = '<small class="badge rounded-pill bg-success">confirmed</small>'
                                input = '<span class="info-box-text py-5" style="margin-right: 10px"><input class="form-check-input" type="checkbox" value="' + data['transDetail'][i].TransactionDetailID + '" checked disabled></span>'

                                if (data['transDetail'][i].NoteDetail == '') {
                                    notes = ''
                                } else {
                                    notes = '<textarea class="form-control" id="" rows="1" disabled>' + data['transDetail'][i].NoteDetail + '</textarea>'
                                }
                            }

                            if (data['transDetail'][i].MenuImage == null || data['transDetail'][i].MenuImage == '') {
                                image = '<img class="card-img card-img-left" src="<?= base_url('assets/img/product/logo-milou.png'); ?>" alt="Menu image" />'
                            } else {
                                image = '<img class="card-img card-img-left" src="http://151.106.113.196:8097/assets/dist/menuimg/' + data['transDetail'][i].MenuImage + '" alt="Menu image" />'
                            }

                            html += '<div class="col-12 col-sm-6 col-md-12">' +
                                '<div class="info-box mb-1">' +
                                input +
                                '<span class="info-box-icon bg-white elevation-1">' + image + '</span>' +
                                '<div class="info-box-content">' +
                                '<span class="info-box-text">' + data['transDetail'][i].MenuName + '<br />' + confirm + '</span>' +
                                '<span class="info-box-number" style="margin-top: unset">' + new Intl.NumberFormat("id-ID", {
                                    currency: "IDR"
                                }).format(data['transDetail'][i].Price) + ' IDR ' + qty + '</span>' +
                                notes +
                                '<div class="info-box-qty mt-1">' +
                                btnAddOn +
                                btnNotes +
                                btnTrash +
                                btnIncDec +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                        }
                    } else {
                        html = '<div class="w-100 position-relative" style="height: 500px">' +
                            '<span class="m-0 position-absolute" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">Your cart is empty</span>' +
                            '</div>';
                    }
                    if (countStatus > 0) {
                        htmlBtn = '<button type="button" id="btnConfirm" class="btn btn-dark d-grid w-100">Confirm your order</button>'
                    } else {
                        htmlBtn += ''
                    }
                    $("#showBtnConfirm").html(htmlBtn)
                    $("#showCartItems").html(html)
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        } else {
            return false
        }
    }

    function showTotalCart() {
        var segment1 = "<?= $this->uri->segment(1) ?>"
        var segment2 = "<?= $this->uri->segment(2) ?>"
        var url = "<?= site_url('main/countCart/') ?>" + segment2

        if (segment1 != "milou-order") {
            $.ajax({
                type: "ajax",
                url: url,
                method: "GET",
                async: true,
                dataType: "json",
                success: function(data) {
                    var html = ""
                    var total = 0

                    for (var i = 0; i < data.length; i++) {
                        var qty = parseInt(data[i].Qty)
                        total += qty
                    }
                    html = total
                    $("#showTotalCart").html(html)
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        } else {
            return false
        }
    }

    function showFindMenu(query) {
        var url = "<?= site_url('main/findMenu') ?>"

        $.ajax({
            type: "ajax",
            url: url,
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                var html = ""
                var image = ""
                if (JSON.parse(data) != "") {

                    $.each(JSON.parse(data), function(index, value) {

                        if (value.MenuImage == null || value.MenuImage == '') {
                            image = '<img class="card-img card-img-left" src="<?= base_url('assets/img/product/logo-milou.png'); ?>" alt="Menu image" />'
                        } else {
                            image = '<img class="card-img card-img-left" src="http://151.106.113.196:8097/assets/dist/menuimg/' + value.MenuImage + '" alt="Menu image" />'
                        }

                        html += '<div class="col-md-6">' +
                            '<div class="card mb-3">' +
                            '<div class="row g-0">' +
                            '<div class="col-md-4">' +
                            image +
                            '<div class="card-img-overlay">' +
                            '<span class="badge bg-light text-black text-sm font-extrabold" style="box-shadow: 0 0.125rem 0.25rem 0 rgb(109 110 119 / 40%);">' + new Intl.NumberFormat("id-ID", {
                                currency: "IDR"
                            }).format(value.MenuPrice) + ' IDR</span>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-8">' +
                            '<div class="card-body border-0" style="position: relative; padding: 0.25rem 1rem 1rem;">' +
                            '<label class="card-title">' + value.MenuName + '</label>' +
                            '<div class="main-info">' +
                            '<div class="main-info-icon text-sm">' +
                            '<button type="submit" id="btnCartAllCategory" data-id="' + value.MenuID + '" class="btn btn-sm btn-dark"><i class="bx bxs-cart-add bx-sm"></i> Add to cart</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                    })
                } else {
                    html = '<div class="container-xxl container-p-y text-center" style="margin-top: 100px">' +
                        '<div class="misc-wrapper">' +
                        '<h2 class="mb-2 mx-2">Hm, couldn`t find "' + query + '" :(</h2>' +
                        '<p class="mb-4 mx-2">Try typing a dish or cuisine type.</p>' +
                        '<div class="mt-3">' +
                        '<img src="<?= base_url('assets/img/error/page-misc-error-light.png') ?>" alt="menu-not-found" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png" />' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                }
                $("#showMenu").html(html)
            },
            error: (error) => {
                console.log(JSON.stringify(error))
            }
        })
    }

    // callback function
    $(document).ready(function() {
        showCategory()
        showMenu()
        showTotalCart()
        showCart()

        // alert add to cart
        var alertMenu = $("#alertMenu")
        alertMenu.hide()

        var alertAddOn = $("#alertAddOn")
        alertAddOn.hide()

        // alert destroy cart
        var alertDestroy = $("#alertDestroy")
        alertDestroy.hide()

        // alert confirm
        var alertConfirm = $("#alertConfirm")
        alertConfirm.hide()

        $(document).on("click", "#btnCategory", function() {
            var url = "<?= site_url('main/getMenu') ?>"
            var category = $(this).data("category")

            $.ajax({
                type: "ajax",
                url: url,
                method: "GET",
                async: true,
                dataType: "json",
                success: function(data) {
                    var html = ""
                    var image = ""

                    for (var i = 0; i < data.length; i++) {

                        if (data[i].MenuImage == null || data[i].MenuImage == '') {
                            image = '<img class="card-img card-img-left" src="<?= site_url('assets/img/product/logo-milou.png'); ?>" alt="Milou Farm House" />'
                        } else {
                            image = '<img class="card-img card-img-left" src="http://151.106.113.196:8097/assets/dist/menuimg/' + data[i].MenuImage + '" alt="' + data[i].MenuName + '" />'
                        }

                        if (category == data[i].CategoryName) {
                            html += '<div class="col-md-6">' +
                                '<div class="card mb-3">' +
                                '<div class="row g-0">' +
                                '<div class="col-md-4">' +
                                image +
                                '<div class="card-img-overlay">' +
                                '<span class="badge bg-light text-black text-sm font-extrabold" style="box-shadow: 0 0.125rem 0.25rem 0 rgb(109 110 119 / 40%);">' + new Intl.NumberFormat("id-ID", {
                                    currency: "IDR"
                                }).format(data[i].MenuPrice) + ' IDR</span>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-md-8">' +
                                '<div class="card-body border-0" style="position: relative; padding: 0.25rem 1rem 1rem;">' +
                                '<label class="card-title">' + data[i].MenuName + '</label>' +
                                '<div class="main-info">' +
                                '<div class="main-info-icon">' +
                                '<button type="submit" id="btnCartCategory" data-id="' + data[i].MenuID + '" class="btn btn-sm btn-dark"><i class="bx bxs-cart-add bx-sm"></i> Add to cart</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                        }
                    }
                    $("#showMenu").html(html)
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        })

        $(document).on("click", "#btnAllCategory", function() {
            showMenu()
        })

        $(document).on("click", "#btnCartAllCategory", function() {
            var segment = "<?= $this->uri->segment(2) ?>"
            var url = "<?= site_url('main/addToCart/') ?>" + segment
            var id = $(this).data("id");

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    alertMenu.slideDown()
                    window.setTimeout(function() {
                        alertMenu.slideUp()
                    }, 1500);
                    showTotalCart()
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        })

        $(document).on("click", "#btnCartCategory", function() {
            var segment = "<?= $this->uri->segment(2) ?>"
            var url = "<?= site_url('main/addToCart/') ?>" + segment
            var id = $(this).data("id")

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    alertMenu.slideDown()
                    window.setTimeout(function() {
                        alertMenu.slideUp();
                    }, 1500)
                    showTotalCart()
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        })

        $(document).on("click", "#btnDestroy", function() {
            var url = "<?= site_url('main/destroyItems') ?>"
            var id = $(this).data("id")

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    alertDestroy.slideDown()
                    window.setTimeout(function() {
                        alertDestroy.slideUp();
                    }, 1500)
                    showCart()
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        })

        $(document).on("click", ".input-number-decrement", function(e) {
            e.preventDefault()
            var url = "<?= site_url('main/incdec') ?>"
            var id = $(this).data("id")
            var qty = parseInt($(this).data("qty")) - 1

            if (qty >= 1) {
                $.ajax({
                    type: "ajax",
                    url: url,
                    method: "POST",
                    data: {
                        id: id,
                        qty: qty
                    },
                    success: function(data) {
                        showCart()
                    },
                    error: (error) => {
                        console.log(JSON.stringify(error))
                    }
                })
                return false
            }
        })

        $(document).on("click", ".input-number-increment", function(e) {
            e.preventDefault()
            var url = "<?= site_url('main/incdec') ?>"
            var id = $(this).data("id")
            var qty = parseInt($(this).data("qty")) + 1

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: {
                    id: id,
                    qty: qty
                },
                success: function(data) {
                    showCart()
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
            return false
        })

        $(document).on("change", ".input-number", function(e) {
            e.preventDefault()
            var url = "<?= site_url('main/incdec') ?>"
            var id = $(this).data("id")
            var qty = $(this).val()

            if (qty < 1) {
                qty = $(this).val(1)
            } else {
                $.ajax({
                    type: "ajax",
                    url: url,
                    method: "POST",
                    data: {
                        id: id,
                        qty: qty
                    },
                    success: function(data) {
                        showCart()
                    },
                    error: (error) => {
                        console.log(JSON.stringify(error))
                    }
                })
            }
        })

        // add notes
        $(document).on("click", "#btnNotesID", function() {
            var url = "<?= site_url('main/getTransDetailForNotes') ?>"
            var id = $(this).data("id")
            $('input[name=transId]').val(id)

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    var val = ""

                    $.each(JSON.parse(data), function(index, value) {
                        val = value.NoteDetail;
                    })
                    $("#notes").val(val)
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        })

        $(document).on("click", "#formNotes", function() {
            var url = "<?= site_url('main/addNotes') ?>"
            var formData = $("#formNotes").serialize()

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: formData,
                success: function(data) {
                    showCart()
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        })

        $(document).on("keyup", "#findMenu", function() {
            var search = $(this).val()

            if (search != "") {
                showFindMenu(search)
            } else {
                showFindMenu()
            }
        })

        $(document).on("click", "#addOn", function() {
            var url = "<?= site_url('main/getMenuAddOn') ?>"
            var menuId = $(this).data("id")

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: {
                    menuId: menuId
                },
                success: function(data) {
                    var html = ""

                    $.each(JSON.parse(data), function(index, value) {
                        html += '<div class="form-check">' +
                            '<input class="form-check-input" name="menuIdAddOn[]" type="checkbox" value="' + value.MenuID + '" id="defaultCheck3">' +
                            '<label class="form-check-label" for="defaultCheck3"> ' + value.MenuName + ' </label>' +
                            '<label class="form-check-label w-100" for="defaultCheck3"> ' + new Intl.NumberFormat("id-ID", {
                                currency: "IDR"
                            }).format(value.MenuPrice) + ' IDR</label>' +
                            '</div>'
                    })
                    $("#showAddOn").html(html)
                },
                error: (error) => {
                    console.log(JSON.stringify(error))
                }
            })
        })

        $(document).on("click", "#btnAddOn", function() {
            var transactionNumber = "<?= $this->uri->segment(2) ?>"
            var url = "<?= site_url('main/addOnMenu/') ?>" + transactionNumber
            var formData = $("#formAddOn").serializeArray()

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: formData,
                success: function(data) {
                    $('.modal').each(function() {
                        $(this).modal('hide')
                    });

                    alertAddOn.slideDown()
                    window.setTimeout(function() {
                        alertAddOn.slideUp()
                    }, 1500)
                    showCart()
                }
            })
        })

        $(document).on("click", "#btnConfirm", function() {
            var url = "<?= site_url('main/confirmOrder') ?>"
            formData = $("#formConfirm").serializeArray()

            $.ajax({
                type: "ajax",
                url: url,
                method: "POST",
                data: formData,
                success: function(data) {
                    alertConfirm.slideDown()
                    window.setTimeout(function() {
                        alertConfirm.slideUp()
                    }, 1500)
                    showCart()
                }
            })


        })
    })
</script>
</body>

</html>