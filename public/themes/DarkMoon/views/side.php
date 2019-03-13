<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 2/15/2018
 * Time: 3:33 AM
 */
?>
<aside id="left">
    <section class="box">
        <h3 class="head"><p>Account area</p></h3>
        <div class="body">
            <?php require 'public/modules/ucp/models/login_model.php'; ?>
        </div>
    </section>
    <section class="box">
        <h3 class="head"><p>Server Status</p></h3>
        <div class="body">
            <?php
            if ($app->status == 'online_offline') {
                require 'public/modules/sidebox_status/models/online_offline_model.php';
            } else {
                require 'public/modules/sidebox_status/models/online_model.php';
            }
            ?>
        </div>
    </section>
    <section class="box">
        <h3 class="head"><p>Top PVP</p></h3>
        <div class="body">
             <?php require 'public/modules/pvp_statistics/models/model.php'; ?>
        </div>
    </section>
    <section class="box">
        <h3 class="head"><p>Follow Us</p></h3>
        <div class="body">
            <style>
                iframe {
                    width: 255px !important;
                }
            </style>
             <?php require 'public/modules/sidebox_follow_us/models/model.php'; ?>
        </div>
    </section>
</aside>
