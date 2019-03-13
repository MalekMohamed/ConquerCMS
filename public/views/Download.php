<?php page_header('Download Page'); ?>
    <div class="post">
        <h3>
            Read this Before Download</h3>
        <h5>By using the <?php echo $app->server_name; ?> Patch & Client you get
            access to all of our network games, as well as guarantee your games are up-to-date. <br>
            - You Must Have Conquer Online Last Patch you can download the patch and install on it .
            <br>
            - Start the game from Play.exe
        </h5>

    </div>
    <div class="divider"></div>
    <table style="width:100%">
        <tbody>
        <tr>
            <td width="50%" align="center">
                <a href="<?php echo $app->client; ?>" target="_blank" class="nice_button">
                    Download Client</a>
            </td>
            <td width="50%" align="center">
                <a href="<?php echo $app->patch;?>" target="_blank" class="nice_button">
                    Download Patch</a>
            </td>
        </tr>
        </tbody>
    </table>
<?php page_footer(); ?>