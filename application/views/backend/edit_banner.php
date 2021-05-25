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
            <div class="row m-t-25">
                <div class="col-md-12">
                    <div class="profile">
                        <div class="profile-content">
                            <form action="<?= site_url("home/edit_banner/") ?>" method="post" enctype="multipart/form-data"> 

                          <!--  <?php 
                             $sliders=$sliders [0];
                            ?>-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="heading1">Heading 1</label>
                                            <input type="text" name="heading1" id="heading1" class="form-control" value="<?= $sliders['heading1'] ?>" required >
                                        </div>
                                        <div class="form-group">

                                            <label for="heading2">Heading 2</label>
                                            <input type="text" name="heading2" id="heading2" class="form-control" value="<?= $sliders['heading2'] ?>" required >
                                        </div>
                                        <div class="form-group">

                                            <label for="link">Link</label>
                                            <input type="text" name="link" id="link" class="form-control" value="<?= $sliders['link'] ?>" required >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addbanner">Edit Banner</label>
                                            <input type="file" name="url" id="url" class="form-control" required >
                                            <input type="hidden" name="url" value="<?= $sliders['slide_image']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="preview">Banner Preview</label>
                                            <img id="preview" src="<?= site_url($sliders['slide_image']); ?>" alt="banner image" class="img-fluid" style="height: 200px;object-fit:scale-down" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                <input type="hidden" name="id" value="<?= $sliders['id'] ?>">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
                                    <a href="<?= site_url("home/view_banner") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>