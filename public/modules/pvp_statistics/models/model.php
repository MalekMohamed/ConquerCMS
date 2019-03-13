<div id="toppvp">
    <div class="toppvp_realm" id="toppvp_realm_0">
        <?php if ($app->side_box_ranking == 'voters') { ?>
        <div class="toppvp_select">Top 5 Voters</div>
        <?php
        $i = 1;
        $get = $app->get_votes(5);
        foreach ($get as $row) {
            $char = $app->get_char_by_owner($row['Username']);
                if (!empty($char)) {
                    ?>
                    <div class="toppvp_character">
                        <div style="float:right"><?php echo number_format($row['points']); ?></div>
                        <b><?php echo $i; ?></b>
                        <img align="absbottom"
                             src="<?php echo $app->BASE_URL('public/img/faces/' . $char['Face'] . '.jpg'); ?>"
                             height="20"
                             width="20">
                        <a data-tip="View character profile"
                           href="<?php echo $app->BASE_URL('Profile/' . $char['Name']); ?>"
                           data-hasevent="1"><?php echo $char['Name']; ?>
                        </a>
                    </div>
                    <?php
                }
                $i++;
        } ?>
        <?php } else { ?>
        <div class="toppvp_select">Top 5 PvP</div>
        <?php
        $i = 1;
        $get = $app->get_arena(5);
        foreach ($get as $row) {
            $char = $app->get_chars_by_name($row['EntityName']);
            if (!empty($char)) {
                ?>
                <div class="toppvp_character">
                    <div style="float:right"><?php echo number_format($row['TodayWin']); ?></div>
                    <b><?php echo $i; ?></b>
                    <img align="absbottom"
                         src="<?php echo $app->BASE_URL('public/img/faces/' . $char['Face'] . '.jpg'); ?>"
                         height="20"
                         width="20">
                    <a data-tip="View character profile"
                       href="<?php echo $app->BASE_URL('Profile/' . $char['Name']); ?>"
                       data-hasevent="1"><?php echo $char['Name']; ?>
                    </a>
                </div>
                <?php
            }
            $i++;
        } ?>
        <?php } ?>
    </div>
</div>
