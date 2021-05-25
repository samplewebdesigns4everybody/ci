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
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#home" class="nav-link active" data-toggle="tab">Size</a>
                </li>
                <li class="nav-item">
                    <a href="#profile" class="nav-link" data-toggle="tab">Colour</a>
                </li>
                <li class="nav-item">
                    <a href="#messages" class="nav-link" data-toggle="tab">Weight</a>
                </li>
            </ul>
            <div class="row m-t-25">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url("home/add_attributes") ?>" method="post" enctype="multipart/form-data">

                                <div class="table-responsive">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home">
                                            <table class="table" id="section_list">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Size Id</th>
                                                        <th>Available Sizes</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    if (sizeof($size) > 0) {
                                                        $no = 1;
                                                        foreach ($size as $key => $value) {

                                                    ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $value['s_id'] ?></td>
                                                                <td><?= $value['size_type'] ?></td>
                                                                <td>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $no++;
                                                        }
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="size_type">Add size</label>
                                                    <input type="text" name="size_type" id="size_type" class="form-control" value="<?= (isset($_POST['size_type'])) ? $_post['size_type'] : ""; ?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Add Size</button>
                                                    <a href="<?= site_url("home/add_attributes") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <table class="table" id="section_list">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Colour Id</th>
                                                        <th>Available Colours</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    if (sizeof($colour) > 0) {
                                                        $no = 1;
                                                        foreach ($colour as $key => $value) {

                                                    ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $value['pro_color_id'] ?></td>
                                                                <td><?= $value['color'] ?></td>
                                                                <td>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $no++;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="color">Add Colour</label>
                                                    <input type="text" name="color" id="color" class="form-control" value="<?= (isset($_POST['color'])) ? $_post['color'] : ""; ?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Add Colour</button>
                                                    <a href="<?= site_url("home/add_attributes") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="tab-pane fade" id="messages">
                                                <table class="table" id="section_list">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Weight Id</th>
                                                            <th>Available Weights</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        if (sizeof($size) > 0) {
                                                            $no = 1;
                                                            foreach ($weights as $key => $value) {

                                                        ?>
                                                                <tr>
                                                                    <td><?= $no ?></td>
                                                                    <td><?= $value['wt_id'] ?></td>
                                                                    <td><?= $value['weight_type'] ?></td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                $no++;
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="weight">Add Weight</label>
                                                        <input type="text" name="weight_type" id="weight_type" class="form-control" value="<?= (isset($_POST['weight_type'])) ? $_post['weight_type'] : ""; ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Add Weight</button>
                                                        <a href="<?= site_url("home/add_attributes") ?>" class="btn btn-outline-primary"><i class="fa fa-times"></i>Cancel</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>