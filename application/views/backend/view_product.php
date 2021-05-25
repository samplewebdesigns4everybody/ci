<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section_content section_content--p30">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="overview-wrap">
                         <h2 class="title-1"><?= $page_title ?></h2>
                         <a href="<?= site_url("home/add_product") ?>" class="au-btn au-btn-icon au-btn--blue">
                             <i class="zmdi zmdi-plus-square"></i>Add Product</a>
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
                                         
                                             <th>Product Name</th>
                                             <th>Description</th>
                                             <th>Quantity</th>
                                             <th>Price</th>
                                             <th>Selling Price</th>
                                             <th>Weight</th>
                                             <th>Colour</th>
                                             <th>Image</th>
                                        
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            if (sizeof($product) > 0) {
                                                $no = 1;
                                                foreach ($product as $key => $value) {

                                            ?>
                                                 <tr>
                                                    
                                                      
                                                     <td><?= $value['pro_name'] ?></td>
                                                     <td><?= $value['pro_description'] ?></td>
                                                     <td><?= $value['quantity'] ?></td>
                                                     <td><?= $value['price'] ?></td>
                                                     <td><?= $value['sp'] ?></td>
                                                     <td><?= $value['weight_type'] ?></td>
                                                     <td><?= $value['color'] ?></td>
                                                     <td>
                                                     <img src="<?=site_url($value['prod_image'])?>" alt="<?=$value['prod_image']?>" class ="img-fluid" style="height: 100px;object-fit:scale-down;">

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