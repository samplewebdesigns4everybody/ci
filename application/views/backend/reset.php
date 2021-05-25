<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="<?= site_url("home/reset") ?>">
                    <img src="<?= site_url("assets/images/icon/logo.png") ?>" alt="<?= $this->config->item("Website_title"); ?>">
                </a>
            </div>
            <div class="login-form">
                <form action="<?= site_url("home/reset") ?>" method="post">
                    <div class="form-group">
                        <label>New Password</label>
                        <input class="au-input au-input--full" type="password" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="au-input au-input--full" type="password" name="confirm_password" placeholder="Confirm Password">
                    </div>
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Submit</button>

                </form>

                <div>
                    <?php
                    if ($this->session->flashdata("error_message")) {
                        echo $this->session->flashdata("error_message");
                    }
                    if ($this->session->flashdata("password_reset")) {
                        echo $this->session->flashdata("password_reset");
                    }
                    ?>
                </div>


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