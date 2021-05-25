<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section_content section_content--p30">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="overview-wrap">
                         <h2 class="title-1"><?= $page_title ?></h2>
                         <a href="<?= site_url("home/view_category") ?>" class="au-btn au-btn-icon au-btn--blue">
                             <i class="zmdi zmdi-eye"></i>View Category</a>
                     </div>
                 </div>
             </div>
             <div class="row m-t-25">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-body">
                             <form action="<?= site_url("home/add_category") ?>" method="post">
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="name">Category Name</label>
                                             <input type="text" name="cat_name" id="cat_name" class="form-control" required value="<?= (isset($_POST['cat_name'])) ? $_post['cat_name'] : ""; ?>">
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="parent">Parent Category</label>
                                             <select name="parent" id="parent" class="form-control">
                                                 <option value="" selected disabled>--select Parent Category</option>
                                                 <?php
                                                    foreach ($category as $key => $value) {
                                                    ?>
                                                     <option value="<?= $value['cat_name'] ?>"><?= $value['cat_name'] ?></option>
                                                 <?php
                                                    }
                                                    ?>

                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-12 text-right">
                                     <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
                                     <a href="<?= site_url("home/add_category") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>cancel</a>
                                 </div>

                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>