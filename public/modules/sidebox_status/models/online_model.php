<div class="realm">
    <div class="realm_online">
        <?php
        $online_prec = $app->get_online()[0] / $app->count_chars();
        ?>
    </div>
    <div class="realm_bar" data-tip="Online: <?php echo $app->get_online()[0]; ?> players">
        <div  class="realm_bar_fill" style="width:<?php echo round($online_prec,2)*100;?>%"></div>
    </div>
</div>

<div class="side_divider"></div>
<div id="realmlist">Server status : <?php echo $app->server_status();?></div>
