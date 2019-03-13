<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 1/27/2018
 * Time: 11:03 PM
 */
$id = $_GET['id'];
$order_ticket = $controller->view_ticket($id);
$replyes = $controller->get_replys($id);
?>
<div class="row">
<div class="col-sm-12">
    <div class="card-box">
        <h4 class="m-t-0 m-b-20 header-title"><b>Ticket / <?php echo $order_ticket[1]['title']; ?></b></h4>
        <div class="row form-group">
            <div class="col-md-9">
                <?php if ($replyes[0] == 0) { ?>
                    <h3>No Messages</h3>
                <?php } else { ?>
                    <h3><?php echo $replyes[0]; ?> Messages</h3>
                <?php } ?>
            </div>
            <div class="col-md-3">
                <a href="<?php echo $app->BASE_URL('admin/Support'); ?>" class="btn btn-primary btn-block"><i
                            class="fa fa-arrow-left"></i>
                    Back to all Tickets</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="results-box">
                    <div class="well">
                        <div class="form-group">
                            <h5 class="message">
                                <?php echo $order_ticket[1]['User']; ?> | @ <?php echo $order_ticket[1]['time']; ?>
                            </h5>
                        </div>
                        <div class="markdown"><p class="font-20"><?php echo $order_ticket[1]['problem']; ?></p></div>
                    </div>
                </div>
                <?php
                foreach ($replyes[1] as $reply) {
                    ?>
                    <div class="results-box">
                        <div class="well">
                            <div class="form-group">
                                <?php if ($reply['user'] == $user_logged) { ?>
                                <h5 class="staff-message">
                                    <?php } else { ?>
                                    <h5 class="message">
                                        <?php } ?>
                                        <?php echo $reply['user']; ?> | @<?php echo $reply['date']; ?>
                                    </h5>
                            </div>
                            <div class="markdown"><p class="font-20"><?php echo $reply['reply']; ?></p></div>
                        </div>
                    </div>
                <?php } ?>
                <hr>
            </div>
        </div>
    </div>
</div>
            <div class="row">
                <form action="#" method="POST" class="add-reply-form">
                <div class="col-sm-12">

                        <input type="hidden" id="ticket_id" name="id" value="<?php echo $id;?>">
                        <div class="form-group">
                        <textarea name="Reply" id="reply_area" class="form-control" style="min-height: 200px;"></textarea>
                        </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block btn-custom waves-effect waves-light"><i class="fa fa-send"></i> Send</button>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>

</div>
