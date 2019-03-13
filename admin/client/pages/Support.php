<?php

?>
    <div class="row">
        <div class="col-sm-12">

            <div class="styles_userStats">
                <games-card>
                    <div class="card-box">
                        <h3 class="m-t-20 m-b-20">All tickets</h3>
                        <table class="table table-bordered">
                            <!-- table head -->
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Last reply Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($controller->view_all()[1] as $ticket) {

                            ?>
                            <tr id="ticket-<?php echo $ticket['id'];?>" class="text-center">
                                <td><?php echo $ticket['id']; ?></td>
                                <td><?php echo $ticket['User']; ?></td>
                                <td><?php echo $ticket['title']; ?></td>
                                <td><?php echo $ticket['category']; ?></td>
                                <td class="ticket-status">
                                    <?php echo $controller->status($ticket['Status']); ?></td>
                                <td><?php echo $ticket['time']; ?></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title=""
                                       data-animation="fadein"
                                       data-id="<?php echo $ticket['id']; ?>"
                                       data-title="<?php echo $ticket['title']; ?>"
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".close-ticket"
                                       data-original-title="Close Ticket"
                                       class="btn-danger btn on-default close-ticket-button"><i
                                                class="fa fa-close"></i></a>
                                    <a  href="<?php echo $base_url; ?>/Tickets/<?php echo $ticket['id']; ?>"
                                        class="btn-primary btn on-default add-reply"><i
                                                class="fa fa-reply"></i></a>

                                </td>
                            </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </games-card>

            </div>

        </div>

    </div>
<div class="modal-demo text-left close-ticket">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Remove Item Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="close-ticket-form" novalidate>
                    <input id="close-id" name="id" type="hidden" value="">
                    Are you sure you want Close this Ticket ( <a class="close-title"></a>
                    ) ? <br>

            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn btn-danger waves-effect waves-light"><i
                            class="fa fa-remove"></i> Close Ticket
                </button>
                </form>
                <button type="button" class="btn btn-primary waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
