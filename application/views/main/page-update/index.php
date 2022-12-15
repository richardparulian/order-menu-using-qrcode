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
                    <?= $this->session->flashdata('message'); ?>
                    <h5 class="mb-2">Welcome back to Milou Farm House! 👋</h5>
                    <p class="mb-4">Please re-enter your phone number</p>

                    <form id="formAuthentication" class="mb-3" action="<?= base_url('main/login/' . $transaction2['TransactionNumber']); ?>" method="POST">
                        <div class="mb-1">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" pattern="+62[7-9]{2}-[0-9]{3}-[0-9]{4}" onkeypress="return isNumber(event)" id="phone" name="phone" placeholder="Enter phone number" maxlength="12" autofocus required />
                        </div>
                        <div class="mb-3">
                            <div class="alert alert-info" role="alert">Enter the phone number that has been registered at this restaurant!</div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="transNum" value="<?= $transaction2['TransactionNumber']; ?>" />
                            <input type="hidden" name="tableNum" value="<?= $transaction2['TableNumber']; ?>" />
                            <button class="btn btn-dark d-grid w-100" type="submit">Continue Order</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
</div>