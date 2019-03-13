<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 2/12/2018
 * Time: 11:58 PM
 */
?>

<div class="row m-b-20">
    <div class="col-sm-12">
        <games-card>
            <div class="card-box">
                <a data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200"
                   data-overlaycolor="#36404a" href=".rebuild-database"
                   data-original-title="Rebuild" class="btn btn-block btn-danger btn-lg waves-effect waves-light"><i
                            class="fa fa-recycle"></i> Rebuild web database</a>
            </div>
        </games-card>
    </div>
</div>
<div class="modal-demo text-left rebuild-database">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Rebuild Database
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="rebuild-form">
                    <h3>Are you sure you want rebuild the site database ? </h3>
                    <div class="rebuilding">
                        <h4 class="text-danger">Remember this Will empty these tables </h4>
                        <ul class="list-group">
                            <li class="list-group-item"> Posts</li>
                            <li class="list-group-item"> Likes</li>
                            <li class="list-group-item"> Comments</li>
                            <li class="list-group-item"> Store</li>
                            <li class="list-group-item"> Tickets</li>
                            <li class="list-group-item"> Tickets Reply</li>
                        </ul>
                    </div>

            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn rebuild-button btn-pulse orange-pulse waves-effect waves-light" style="color: #fff;"><i
                            class="fa fa-recycle"></i> Rebuild
                </button>
                </form>
                <button type="button" class="btn btn-default waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <games-card>
            <div class="card-box">
                <style>
                    .check-result {
                        background-color: #403f41;
                        min-height: 100px;
                        display: none;
                    }
                </style>
                <button class="btn btn-block check-database-button btn-primary btn-lg waves-effect waves-light"><i
                            class="fa fa-check"></i> Check Tables
                </button>
                <div class="check-result nicescroll p-20">

                </div>
            </div>
        </games-card>
    </div>
</div>