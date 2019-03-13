
    <?php page_header('Vote Panel'); ?>
    <style>
        #inneriframe {
            top: 0px;
            left: -170px;
            width: 850px;
            height: 500px;
        }
        #outerdiv {
            width: 670px;
            height: 505px;
            overflow: hidden;
            position: relative;
            text-align: center;
        }
    </style>
    <div id="outerdiv">
    <iframe scrolling="no" id="inneriframe"
            src="<?php echo $vote;?>"></iframe>

    </div>
  <?php page_footer(); ?>