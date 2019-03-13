</div> <!-- container -->
<div class="modal-demo text-left remove-user-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Remove User Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="remove-user-form">
                    <input id="remove-user" name="user" type="hidden" value="">
                    <input id="remove-character" name="char" type="hidden" value="">
                    Are you sure you want Remove this User ( <a class="remove-user"></a>
                    ) ? <br>
                    <h3 class="text-danger">Remember this cannot be Undone</h3>

            </div>
            <div class="panel-footer">
                <button type="submit"
                        class="btn btn-danger waves-effect waves-light"><i
                            class="fa fa-trash"></i> Remove
                </button>
                </form>
                <button type="button" class="btn btn-default waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
<div class="modal-demo text-left edit-user-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Edit User Modal
                </h4>
            </div>
            <div class="custom-modal-text">
                <form action="#" method="POST" class="edit-user-form">
                    <input type="hidden" name="request" value="Update">
                    <input type="hidden" name="Username" id="user">
                    <input type="hidden" name="EntityID" id="uid">
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" disabled class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="text" name="Password" class="form-control" value="" id="Password">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="Email" class="form-control" value="" id="Email">
                    </div>
                    <div class="form-group">
                        <label for="Question">Question</label>
                        <input type="text" name="Question" class="form-control" value="" id="Question">
                    </div>
                    <div class="form-group">
                        <label for="Answer">Answer</label>
                        <input type="text" name="Answer" class="form-control" value="" id="Answer">
                    </div>
                    <div class="form-group">
                        <label for="State">State</label>
                        <input type="number" name="State" class="form-control" step="1" value="" id="State">
                    </div>
                    <section id="character" style="display: none">
                        <h3 class="m-t-20 m-b-20">Character</h3>
                        <hr>
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="Name" disabled class="form-control" value="" id="Name">
                        </div>
                        <div class="form-group">
                            <label for="CPS">CPS</label>
                            <input type="number" name="ConquerPoints" step="1" class="form-control" value="" id="CPS">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <input type="number" max="140" min="1" name="Level" step="1" class="form-control" value=""
                                   id="level">
                        </div>
                        <div class="form-group">
                            <label for="VIPLevel">VIPLevel</label>
                            <input type="number" max="6" min="0" name="VIPLevel"step="1" class="form-control" value=""
                                   id="VIPLevel">
                        </div>
                    </section>
            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn btn-primary waves-effect waves-light"><i
                            class="fa fa-save"></i> Save
                </button>
                </form>
                <button type="button" class="btn btn-danger waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
</div> <!-- content -->
<?php if (isset($user_logged)) { ?>
    <footer class="footer">
        <div class="pull-left m-t-20">
            © 2018. All rights reserved To Conquer Hub.
        </div>
        <div class="pull-right">
            <img src="<?php echo $base_url.'/assets/images/sidebar-logo.png'; ?>" width="60"
                 height="60">
        </div>
    </footer>
<?php } ?>
</div>


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


<!-- Right Sidebar -->

<!-- /Right-bar -->

</div>
<!-- END wrapper -->
<system-message style="display: none;"></system-message>


<script>
    var base_url = '<?php echo $base_url.'/system';?>';
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?php echo $base_url.'/assets/js/jquery.min.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/detect.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/fastclick.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/jquery.slimscroll.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/jquery.blockUI.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/waves.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/wow.min.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/jquery.nicescroll.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/jquery.scrollTo.min.js'; ?>"></script>

<!-- Bootstrap plugin js -->
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<!-- Bootstrap plugin js -->
<script src="<?php echo $base_url; ?>/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/pages/jquery.bs-table.js"></script>

<script src="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/pages/datatables.init.js"></script>
<!-- Modal-Effect -->
<script src="<?php echo $base_url; ?>/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/custombox/js/legacy.min.js"></script>
<!-- Notify -->
<script src="<?php echo $base_url; ?>/assets/plugins/notifyjs/js/notify.js"></script>
<script src="<?php echo $base_url; ?>/assets/plugins/notifications/notify-metro.js"></script>

<script src="<?php echo $base_url; ?>/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/assets/plugins/parsleyjs/parsley.min.js"></script>
<script src="<?php echo $base_url.'/assets/js/jquery.core.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/jquery.app.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/plugins/summernote/summernote.min.js'; ?>"></script>
<script src="<?php echo $base_url.'/assets/js/server/web.js'; ?>"></script>

<script>
    jQuery(document).ready(function () {
        $('.summernote').summernote({
            height: 350,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
        $('.table').DataTable();
        function change_logo_color() {
            var classes = ['green-neon','red-neon','blue-neon','gold-neon','orange-neon','magenta-neon'];
            var rando = classes[Math.floor(Math.random()*classes.length)];
            //remove old class
            $('.glowing-logo').removeClass($('.glowing-logo').attr('class').split(' ').pop());
            $('.glowing-logo').addClass(rando);
        }
        setInterval(change_logo_color, 2200);
        function change_button_color() {
            var classes = ['green-pulse','red-pulse','blue-pulse','gold-pulse','orange-pulse','magenta-pulse'];
            var rando = classes[Math.floor(Math.random()*classes.length)];
            //remove old class
            $('.btn-pulse').removeClass($('.btn-pulse').attr('class').split(' ').pop());
            $('.btn-pulse').addClass(rando);
        }
        if ('<?php echo $route; ?>' == 'Settings') {
            setInterval(change_button_color, 2100);
        }
    });
</script>
</body>
</html>
