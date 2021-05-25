<script type="text/javascript">
    function confirm_modal(delete_url) {
        const confirmModal = new Promise(function(resolve, reject) {
            $('#modal-4').modal('show');
            $('#modal-4 .btn-yes').click(function() {
                console.log("btn clicked");
                resolve(true);
                location.href = delete_url;
            });
            $('#modal-4 .btn-cancel').click(function() {
                resolve(false);
            });
        });
        return confirmModal;
    }
</script>

<!-- (Normal Modal)-->
<div class="modal fade" id="modal-4">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <img src="<?= site_url('assets/images/icon/logo-mini.png') ?>" alt="7 organic " class="img-fluid" style="width: 75px;">
                    </div>
                </div>
                <div class="col-md-12 mt-3 mb-3">
                    <h4 class="modal-title text-center"><?php echo "Are you sure you want to delete"; ?> ?</h4>
                </div>
            </div>

            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <a href="#" class="btn btn-danger btn-yes" id="delete_link" data-dismiss="modal"><?php echo "Yes"; ?></a>
                <button type="button" class="btn btn-info btn-cancel" data-dismiss="modal"><?php echo "No"; ?></button>
            </div>
        </div>
    </div>
</div>