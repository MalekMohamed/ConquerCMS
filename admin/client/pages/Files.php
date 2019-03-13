<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 1/27/2018
 * Time: 9:43 PM
 */
$file = $_GET['log'];
if ($file == 'Admin') {
    $file_content = file_get_contents('logs/admin-log.txt');
} elseif ($file == 'Votes') {
    $file_content = file_get_contents('logs/votes-log.txt');
} else {
    header("Location: ../404");
}
$file_content = array_reverse(explode('---------------------------------------------', $file_content));
?>
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15 m-b-15">
            <a data-toggle="tooltip" data-placement="left" data-file="<?php echo $file;?>" data-original-title="Clear <?php echo $file;?> Logs"
               class="btn btn-danger clearLog dropdown-toggle waves-effect waves-light"><i class="fa fa-trash"></i> Clear log</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="nicescroll p-20" style="height: 500px; overflow: hidden; outline: none;">
                <?php
                echo '<pre>';
                foreach ($file_content as $log) {
                    echo $log;
                    echo '---------------------------------------------';
                }
                echo '</pre>';
                ?>
            </div>
        </div>
    </div>
</div>
