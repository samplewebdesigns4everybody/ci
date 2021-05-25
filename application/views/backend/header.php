  <!-- HEADER DESKTOP-->
  <?php
    if (empty($admin["profile_pic"])) {
        $profile_pic = site_url("assets/images/icon/avatar-01.jpg");
    } else {
        $profile_pic = site_url($admin["profile_pic"]);
    }
    ?>
  <header class="header-desktop">
      <div class="section__content section__content--p30">
          <div class="container-fluid">
              <div class="header-wrap">
                  <form class="form-header" action="" method="POST">

                  </form>
                  <div class="header-button">

                      <div class="account-wrap">
                          <div class="account-item clearfix js-item-menu">
                              <div class="image">
                                  <img src="<?= $profile_pic ?>" alt="John Doe" />
                              </div>
                              <div class="content">
                                  <a class="js-acc-btn" href="#">
                                      <h6><?= $admin["firstname"] ?></h6>
                                  </a>
                              </div>
                              <div class="account-dropdown js-dropdown">
                                  <div class="info clearfix">
                                      <div class="image">
                                          <a href="#">
                                              <img src="<?= $profile_pic ?>" alt="John Doe" />
                                          </a>
                                      </div>
                                      <div class="content">
                                          <h5 class="name">
                                              <a href="#"><?= $admin["firstname"] ?></a>
                                          </h5>
                                          <span class="email"><?= $admin["email"] ?></span>
                                      </div>
                                  </div>
                                  <div class="account-dropdown__body">
                                      <div class="account-dropdown__item">
                                          <a href="<?= site_url("home/profile") ?>">
                                              <i class="zmdi zmdi-account"></i>Account</a>
                                      </div>
                                      <div class="account-dropdown__item">
                                          <a href="#">
                                              <i class="zmdi zmdi-settings"></i>Setting</a>
                                      </div>

                                  </div>
                                  <div class="account-dropdown__footer">
                                      <a href="<?= site_url("home/logout") ?>">
                                          <i class="zmdi zmdi-power"></i>Logout</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header>
  <!-- HEADER DESKTOP-->