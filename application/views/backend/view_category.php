<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section_content section_content--p30">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="overview-wrap">
                         <h2 class="title-1"><?= $page_title ?></h2>
                         <a href="<?= site_url("home/add_category") ?>" class="au-btn au-btn-icon au-btn--blue">
                             <i class="zmdi zmdi-plus-square"></i>Add Category</a>
                     </div>
                 </div>
             </div>
             <div class="row m-t-25">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table" id="section_list">
                                     <thead>
                                         <tr>
                                             <th>ID</th>
                                             <th>Category Name</th>
                                             <th>Parent Category</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            if (sizeof($category) > 0) {
                                                $no = 1;
                                                foreach ($category as $key => $value) {

                                            ?>
                                                 <tr>
                                                     <td><?= $no ?></td>
                                                     <td><?= $value['cat_name'] ?></td>
                                                     <td><?= (empty($value['parent_category'])) ? "--" : $value['parent_category']; ?></td>
                                                     <td>
                                                         <a href="<?= site_url("home/edit_category/" . $value['cat_id']) ?>" class="btnbtn-primary"><i class="fa fa-edit" style="font-size:16px"></i></a>
                                                         <button class="btn btn-danger" onclick="confirm_modal('<?= site_url('home/delete_category/' . $value['cat_id']) ?>')"><i class="fa fa-trash" style="font-size:15px"></i></button>
                                                     </td>
                                                 </tr>
                                         <?php
                                                    $no++;
                                                }
                                            }
                                            ?>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>