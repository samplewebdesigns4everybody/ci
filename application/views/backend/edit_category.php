<div class="main-content">
    <div class="section_content section_content--p30">
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
                            <form action="<?= site_url("home/edit_category/") ?>" method="post" enctype="multipart/form-data">
                            <?php 
                             $category=$category [0];
                            ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cat_name">Category</label>
                                            <input type="text" name="cat_name" id="cat_name" class="form-control" value="<?= $category['cat_name'] ?>" required >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent">Parent Category</label>
                                            <select name="parent" id="parent" class="form-control">
                                                 <option value="" selected disabled>--select Parent Category</option>
                                                 <?php
                                                    foreach ($categoryall as $key => $value) {
                                                    ?>
                                                     <option value="<?= $value['cat_name'] ?>"><?= $value['cat_name'] ?></option>
                                                 <?php
                                                    }
                                                    ?>

                                             </select>
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="cat_id" value="<?= $category['cat_id'] ?>">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Update Category</button>
                                        <a href="<?= site_url("home/view_category") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>