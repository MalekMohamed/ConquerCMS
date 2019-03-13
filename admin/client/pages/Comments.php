
<div class="row">
    <div class="col-sm-12">

        <div class="styles_userStats">
            <games-card>
                <div class="card-box">
                    <h3 class="m-t-20 m-b-20">Comments</h3>
                    <table  id="datatable" class="table table-bordered">
                        <!-- table head -->
                        <thead>
                        <tr>
                            <th>Comments</th>
                            <th>User</th>
                            <th>Post </th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($controller->get_all_comments()[1] as $comment) {
                            $post = $controller->get_post_by_id($comment['post_id'])[1];
                            ?>
                            <tr id="comment-<?php echo $comment['id'];?>" class="text-center">
                                <td><?php echo $comment['comment']; ?></td>
                                <td><?php echo $comment['user']; ?></td>
                                <td><?php echo $post['title']; ?></td>
                                <td><?php echo $comment['date']; ?></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title=""
                                       data-animation="fadein"
                                       data-id="<?php echo $comment['id']; ?>"
                                       data-comment='<?php echo $comment['comment']; ?>'
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".remove-comment-row"
                                       data-original-title="Remove Comment"
                                       class="btn-danger btn on-default remove-comment-button"><i
                                            class="fa fa-trash-o"></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title=""
                                       data-animation="fadein"
                                       data-id="<?php echo $comment['id']; ?>"
                                       data-user="<?php echo $comment['user']; ?>"
                                       data-comment='<?php echo $comment['comment']; ?>'
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".edit-comment-row"
                                       data-original-title="Edit Comment"
                                       class="btn-primary btn on-default edit-comment-button"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </games-card>

        </div>

    </div>

</div>
<div class="modal-demo text-left remove-comment-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Remove Comment Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="remove-comment-form">
                    <input id="remove-comment" name="id" type="hidden" value="">
                    Are you sure you want Remove this item ( <a class="remove-comment"></a>
                    ) ? <br>
                    <h3 class="text-danger">Remember this cannot be Undone</h3>

            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn btn-danger waves-effect waves-light"><i
                            class="fa fa-trash"></i> Remove
                </button>
                </form>
                <button type="button" class="btn btn-default waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
<div class="modal-demo text-left edit-comment-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Edit Comment Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="edit-comment-form">
                    <input type="hidden" name="id" value="" id="comment-id">
                    <div class="form-group">
                        <label for="userName">User</label>
                        <input type="text" name="user" disabled class="form-control" value="" id="user">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input type="text" name="comment" class="form-control" value="" id="comment">
                    </div>
            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn btn-primary waves-effect waves-light"><i
                            class="fa fa-save"></i> Save
                </button>
                </form>
                <button type="button" class="btn btn-danger waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>