<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="<?= site_url("home/login") ?>">
                    <img src="<?= site_url("assets/images/icon/logo.png") ?>" alt="<?= $this->config->item("Website_title"); ?>">
                </a>
            </div>
            <div class="login-form">
                <form action="<?= site_url("home/email_verify") ?>" method="post">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                    </div>
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Reset Password</button>
                </form>
                <div class="register-link">
                    <p>
                        Remember your password?
                        <a href="<?=site_url("home/login")?>">Sign In Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>