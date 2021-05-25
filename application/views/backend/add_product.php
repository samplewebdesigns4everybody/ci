<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title1"><?= $page_title ?></h2>
                        <a href="<?= site_url("home/view_product") ?>" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View Products</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-md-12">
                    <div class="profile">
                        <div class="profile-content">
                            <form action="<?= site_url("home/add_product") ?>" method="post" enctype="multipart/form-data"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" name="pro_name" id="name" class="form-control" required value="<?= (isset($_POST['pro_name'])) ? $_post['pro_name'] : ""; ?>">
                                        </div>
                                        <div class="form-group">

                                            <label for="description">Description</label>
                                            <input type="textarea" name="description" id="description" class="form-control" required value="<?= (isset($_POST['description'])) ? $_post['description'] : ""; ?>">
                                        </div>
                                        <div class="form-group">

                                            <label for="quantity">Product Quantity</label>
                                            <input type="text" name="quantity" id="quantity" class="form-control" required value="<?= (isset($_POST['quantity'])) ? $_post['quantity'] : ""; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Product Price</label>
                                            <input type="text" name="price" id="price" class="form-control" required value="<?= (isset($_POST['price'])) ? $_post['price'] : ""; ?>">
                                        </div>

                                        <div class="form-group">

                                            <label for="sp">Product Selling Price</label>
                                            <input type="text" name="sp" id="sp" class="form-control" required value="<?= (isset($_POST['sp'])) ? $_post['sp'] : ""; ?>">
                                        </div>

                                        <div class="form-group">
                                             <label for="size">Product Size</label>
                                             <select name="size" id="size" class="form-control">
                                                 <option value="" selected disabled>--select Product size</option>
                                                 <?php
                                                    foreach ($size as $key => $value) {
                                                    ?>
                                                     <option value="<?= $value['size_type'] ?>"><?= $value['size_type'] ?></option>
                                                 <?php
                                                    }
                                                    ?>

                                             </select>
                                         </div>


                                    </div>

                                    <div class="col-md-6">

                                    <div class="form-group">
                                             <label for="weight">Product Weight</label>
                                             <select name="weight" id="weight" class="form-control">
                                                 <option value="" selected disabled>--select Product weight</option>
                                                 <?php
                                                    foreach ($weights as $key => $value) {
                                                    ?>
                                                     <option value="<?= $value['weight_type'] ?>"><?= $value['weight_type'] ?></option>
                                                 <?php
                                                    }
                                                    ?>

                                             </select>
                                         </div>

                                         <div class="form-group">
                                             <label for="color">Product Colour</label>
                                             <select name="color" id="color" class="form-control">
                                                 <option value="" selected disabled>--select Product Colour</option>
                                                 <?php
                                                    foreach ($colour as $key => $value) {
                                                    ?>
                                                     <option value="<?= $value['color'] ?>"><?= $value['color'] ?></option>
                                                 <?php
                                                    }
                                                    ?>

                                             </select>
                                         </div>
                                        <div class="form-group">
                                            <label for="image">Product Image</label>
                                            <input type="file" name="image" id="image" class="form-control" >
                                            <input type="hidden" name="image" value="<?= (isset($_POST['image'])) ? $_POST['image'] : ""; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="preview">Product Preview</label>
                                            <img id="preview" src="<?= (empty($product_details['slide_image'])) ? site_url("assets/images/icon/avatar-01.jpg") : site_url($produc_details['slide_image']); ?>" alt="banner image" class="img-fluid" style="height: 200px;object-fit:scale-down" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
                                    <a href="<?= site_url("home/add_product") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>