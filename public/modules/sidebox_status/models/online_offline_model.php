<div id="update_status">
    <div class="realm">
        <div class="realm-bar-wrapper">
            <?php
            $online = $app->get_online()[0] / $app->count_chars();
            $offline = 1 - $online;
            ?>
            <div class="horde-icon"
                 data-tip="Offline: <?php echo $app->count_chars() - $app->get_online()[0]; ?> players"></div>
            <div class="realm_bar">
                <div data-tip="Offline: <?php echo $app->count_chars() - $app->get_online()[0]; ?> players"
                     class="realm_bar_fill horde" style="width:<?php echo round($offline,2) * 100; ?>%">
                </div>
                <div data-tip="Online: <?php echo $app->get_online()[0]; ?> players"
                     class="realm_bar_fill alliance" style="width:<?php echo  round($online,2) * 100; ?>%">
                </div>

            </div>
            <div class="alliance-icon"
                 data-tip="Online: <?php echo $app->get_online()[0]; ?> players"></div>
        </div>
    </div>
    <div id="realmlist"> <center>
            Server Status : <?php echo $app->server_status(); ?>
        </center>
    </div>
</div>