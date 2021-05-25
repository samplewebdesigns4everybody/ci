<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="<?= site_url("home/login") ?>">
                    <img src="<?= site_url("assets/images/icon/logo.png") ?>" alt="<?= $this->config->item("Website_title"); ?>">
                </a>
            </div>
            <div class="login-form">
                <form action="<?=site_url("home/login_verfication")?>" method="post">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="login-checkbox">
                        <label>
                            <input type="checkbox" name="remember">Remember Me
                        </label>
                        <label>
                            <a href="<?=site_url("home/forgot")?>">Forgotten Password?</a>
                        </label>
                    </div>
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                </form>               
            </div>
        </div>
    </div>
</div>