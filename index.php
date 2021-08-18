<?php
session_start();
if(!isset($_SESSION['login_id']))
header('location:login.php');
?>

<?php 
include('includes/header.php');
include('includes/navbar.php');
?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['login_name'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">


                            <style>
                            .modal-dialog.large {
                                width: 80% !important;
                                max-width: unset;
                            }
                            .modal-dialog.mid-large {
                                width: 50% !important;
                                max-width: unset;
                            }
                            </style>
                            <body>

                            <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-body text-white">
                                </div>
                            </div>
                                <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
                                <?php include $page.'.php' ?>
                                
                            <div id="preloader"></div>

                            <div class="modal fade" id="confirm_modal" role='dialog'>
                                <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Confirmation</h5>
                                </div>
                                <div class="modal-body">
                                    <div id="delete_content"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="modal fade" id="uni_modal" role='dialog'>
                             <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title"></h5>
                                        </div>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                             </div>
                            </div>
                            </body>
                            <script>
                                window.start_load = function(){
                                $('body').prepend('<di id="preloader2"></di>')
                            }
                            window.end_load = function(){
                                $('#preloader2').fadeOut('fast', function() {
                                    $(this).remove();
                                })
                            }

                            window.uni_modal = function($title = '' , $url='',$size=""){
                                start_load()
                                $.ajax({
                                    url:$url,
                                    error:err=>{
                                        console.log()
                                        alert("An error occured")
                                    },
                                    success:function(resp){
                                        if(resp){
                                            $('#uni_modal .modal-title').html($title)
                                            $('#uni_modal .modal-body').html(resp)
                                            if($size != ''){
                                                $('#uni_modal .modal-dialog').addClass($size)
                                            }else{
                                                $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                                            }
                                            $('#uni_modal').modal('show')
                                            end_load()
                                        }
                                    }
                                })
                            }
                            window._conf = function($msg='',$func='',$params = []){
                                $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
                                $('#confirm_modal .modal-body').html($msg)
                                $('#confirm_modal').modal('show')
                            }
                            window.alert_toast= function($msg = 'TEST',$bg = 'success'){
                                $('#alert_toast').removeClass('bg-success')
                                $('#alert_toast').removeClass('bg-danger')
                                $('#alert_toast').removeClass('bg-info')
                                $('#alert_toast').removeClass('bg-warning')

                                if($bg == 'success')
                                $('#alert_toast').addClass('bg-success')
                                if($bg == 'danger')
                                $('#alert_toast').addClass('bg-danger')
                                if($bg == 'info')
                                $('#alert_toast').addClass('bg-info')
                                if($bg == 'warning')
                                $('#alert_toast').addClass('bg-warning')
                                $('#alert_toast .toast-body').html($msg)
                                $('#alert_toast').toast({delay:3000}).toast('show');
                            }
                            $(document).ready(function(){
                                $('#preloader').fadeOut('fast', function() {
                                    $(this).remove();
                                })
                            })
                            $('.datetimepicker').datetimepicker({
                                format:'Y/m/d H:i',
                                startDate: '+3d'
                            })
                            $('.select2').select2({
                                placeholder:"Please select here",
                                width: "100%"
                            })
                            </script>	
                        </div>

                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->




    <?php 
include('includes/scripts.php');
include('includes/footer.php');
?>


