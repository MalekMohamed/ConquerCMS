<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 2/15/2018
 * Time: 3:33 AM
 */
?>
<aside id="left">

    <article class="sidebox">
        <h1 class="top"><p>Account Area</p></h1>
        <section class="body">
            <?php require 'public/modules/ucp/models/login_model.php'; ?>
        </section>
    </article>
    <article class="sidebox">
        <h1 class="top"><p>Server Status</p></h1>
        <section class="body">
            <?php
            if ($app->status == 'online_offline') {
                require 'public/modules/sidebox_status/models/online_offline_model.php';
            } else {
                require 'public/modules/sidebox_status/models/online_model.php';
            }
            ?>
        </section>
    </article>
    <article class="sidebox">
        <h1 class="top"><p>Top PVP</p></h1>
        <section class="body">
            <?php require 'public/modules/pvp_statistics/models/model.php'; ?>
        </section>
    </article>
    <article class="sidebox">
        <h1 class="top"><p>Follow Us</p></h1>
        <section class="body">
            <?php require 'public/modules/sidebox_follow_us/models/model.php'; ?>
        </section>
    </article>
</aside>
