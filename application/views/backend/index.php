<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "meta.php";
    include "styles.php";
    ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php
        if ($this->session->userdata("admin_user_logged_in")) {
            include "sidemenu.php";
        }
        ?>
        <!-- PAGE CONTAINER-->
        <?php
        if ($this->session->userdata("admin_user_logged_in")) {
        ?>
            <div class="page-container">
            <?php
            include "header.php";
        } else {
            ?>
                <div class="page-content--bge5">
                <?php
            }
                ?>
                <?php
                if ($page_name === null) {
                    include $path;
                } else {
                    include $page_name . '.php';
                }
                ?>
                <!-- END PAGE CONTAINER-->
                </div>
            </div>
            <?php
            include "scripts.php";
            include "common_scripts.php";
            include "footer.php";
            include "modal.php";
            ?>
</body>

</html>