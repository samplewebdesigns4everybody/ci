<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title1"><?= $page_title ?></h2>
                        <a href="<?= site_url("home/view_banner") ?>" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View Banner</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-md-12">
                    <div class="profile">
                        <div class="profile-content">
                            <form action="<?= site_url("home/add_banner") ?>" method="post" enctype="multipart/form-data"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="heading1">Heading 1</label>
                                            <input type="text" name="heading1" id="heading1" class="form-control" required value="<?= (isset($_POST['heading1'])) ? $_post['heading1'] : ""; ?>">
                                        </div>
                                        <div class="form-group">

                                            <label for="heading2">Heading 2</label>
                                            <input type="text" name="heading2" id="heading2" class="form-control" required value="<?= (isset($_POST['heading2'])) ? $_post['heading2'] : ""; ?>">
                                        </div>
                                        <div class="form-group">

                                            <label for="link">Link</label>
                                            <input type="text" name="link" id="link" class="form-control" required value="<?= (isset($_POST['link'])) ? $_post['link'] : ""; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addbanner">Add Banner</label>
                                            <input type="file" name="banner" id="banner" class="form-control" >
                                            <input type="hidden" name="url" value="<?= (isset($_POST['url'])) ? $_POST['url'] : ""; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="preview">Banner Preview</label>
                                            <img id="preview" src="<?= (empty($sliders['slide_image'])) ? site_url("assets/images/icon/avatar-01.jpg") : site_url($sliders['slide_image']); ?>" alt="banner image" class="img-fluid" style="height: 200px;object-fit:scale-down" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
                                    <a href="<?= site_url("home/add_banner") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>