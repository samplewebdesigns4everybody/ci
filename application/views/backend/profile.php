<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title1"><?= $page_title ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile">
                        <div class="profile-content">
                            <form action="<?= site_url("home/profile") ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" name="firstname" id="fname" class="form-control" value="<?= $admin['firstname'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" name="lastname" id="lname" class="form-control" value="<?= $admin['lastname'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?= $admin['email'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="<?= $admin['phone'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="male" <?= ($admin['gender'] === "male") ? "selected" : ""; ?>>Male</option>
                                                <option value="female" <?= ($admin['gender'] === "female") ? "selected" : ""; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profilepic">Change Profile</label>
                                            <input type="file" name="profile" id="profile" class="form-control">
                                            <input type="hidden" name="url" value="<?= $admin['profile_pic'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="preview">Profile Picture</label>
                                            <img id="preview" src="<?= (empty($admin['profile_pic'])) ? site_url("assets/images/icon/avatar-01.jpg") : site_url($admin['profile_pic']); ?>" alt="profile pic" class="img-fluid" style="height: 200px;object-fit:scale-down" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="admin_id" value="<?= $admin['admin_id'] ?>">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Update Profile</button>
                                        <a href="<?= site_url("home/profile") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if ($this->session->userdata("error_message")) {
                                echo $this->session->userdata("error_message");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>