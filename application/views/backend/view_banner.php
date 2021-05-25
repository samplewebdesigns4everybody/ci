<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section_content section_content--p30">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="overview-wrap">
                         <h2 class="title-1"><?= $page_title ?></h2>
                         <a href="<?= site_url("home/add_banner") ?>" class="au-btn au-btn-icon au-btn--blue">
                             <i class="zmdi zmdi-plus-square"></i>Add Banner</a>
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
                                             <th>Heading 1</th>
                                             <th>Heading 2</th>
                                             <th>Link</th>
                                             <th>Banner Image</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            if (sizeof($sliders) > 0) {
                                                $no = 1;
                                                foreach ($sliders as $key => $value) {

                                            ?>
                                                 <tr>
                                                     <td><?= $no ?></td>
                                                     <td><?= $value['heading1'] ?></td>
                                                     <td><?= $value['heading2'] ?></td>
                                                     <td><?= $value['link'] ?></td>
                                                     <td>
                                                     <img src="<?=site_url($value['slide_image'])?>" alt="<?=$value['slide_image']?>" class ="img-fluid" style="height: 100px;object-fit:scale-down;">

                                                     </td>
                                                     <td>
                                                         <a href="<?= site_url("home/edit_banner/" . $value['id']) ?>" class="btnbtn-primary"><i class="fa fa-edit" style="font-size:16px"></i></a>
                                                         <button class="btn btn-danger" onclick="confirm_modal('<?= site_url('home/delete_banner/' . $value['id']) ?>')"><i class="fa fa-trash" style="font-size:15px"></i></button>
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