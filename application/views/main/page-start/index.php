<div class="container-xxl" style="background: url('../assets/img/layouts/bg.jpg') no-repeat fixed left;">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Login -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="<?= base_url('assets/img/logo/logo-milou.png'); ?>" style="height: 150px; width: 150px" />
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h5 class="mb-2">Welcome to Milou Farm House! 👋</h5>
                    <p class="mb-4">Please enter your name and start ordering</p>

                    <form id="formAuthentication" class="mb-3" action="<?= base_url('main/addCustomer'); ?>" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Your name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autofocus required />
                            <input type="hidden" name="tableNum" value="<?= $table; ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" pattern="+62[7-9]{2}-[0-9]{3}-[0-9]{4}" onkeypress="return isNumber(event)" id="phone" name="phone" placeholder="Enter phone number" maxlength="12" autofocus required />
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark d-grid w-100" type="submit">Start Order</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
</div>