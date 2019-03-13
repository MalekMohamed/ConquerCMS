<div class="row">
    <div class="col-sm-12">
        <div class="styles_borderHolder">
            <div class="styles_leftBorder"></div>
            <div class="styles_rightBorder"></div>
            <lobby-launcher>
                <div class="styles_play">
                    <play-button data-toggle="tooltip" data-placement="top" title=""
                                 data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200"
                                 data-overlaycolor="#36404a" href=".add-post"
                                 data-original-title="Add POST">Add new Post
                    </play-button>
                </div>
            </lobby-launcher>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">

        <div class="styles_userStats">
            <games-card>
                <div class="card-box">
                    <h3 class="m-t-20 m-b-20">Posts</h3>

                    <style>
                        .styles_post-info:after {
                            content: "";
                            position: absolute;
                            top: 81px;
                            height: 1px;
                            width: 100%;
                            background: -webkit-gradient(linear, left top, right top, color-stop(5%, transparent), color-stop(50%, #FFC107), color-stop(95%, transparent));
                            background: -webkit-linear-gradient(left, transparent 5%, #d7c282 50%, transparent 95%);
                            background: linear-gradient(90deg, transparent 5%, #ffc107 50%, transparent 95%);
                        }

                        .styles_post-body:after {
                            content: "";
                            position: absolute;
                            margin-top: 10px;
                            height: 1px;
                            width: 100%;
                            background: -webkit-gradient(linear, left top, right top, color-stop(5%, transparent), color-stop(50%, #FFC107), color-stop(95%, transparent));
                            background: -webkit-linear-gradient(left, transparent 5%, #d7c282 50%, transparent 95%);
                            background: linear-gradient(90deg, transparent 5%, #ffc107 50%, transparent 95%);
                        }

                        .styles_post-body {
                            border: 1px solid #2c2d39;
                            padding: 10px;
                            margin-top: 10px;
                            background-color: #0f0f13;
                            box-shadow: 1px 1px 3px #000;
                        }

                        .post-actions {
                            display: none;
                            margin-right: 10px;
                        }

                        post:hover .post-actions {
                            display: block;
                        }

                        @media (max-width: 991px) {
                            post:hover .styles_post-info:after {
                                top: 97px;
                            }
                            .post-actions {
                                margin-right: 0px;
                            }
                        }
                    </style>
                    <?php
                    foreach ($controller->get_posts()[1] as $post) {
                        $comments = $controller->get_post_comments($post['id']);
                        ?>

                        <post class="">
                            <div class="styles_post-info">
                                <a href="<?php echo $controller->BASE_URL('Profile/' . $post['user']); ?>">
                                    <img role="presentation" class="styles_avatar"
                                         src="<?php echo $controller->BASE_URL('public/themes/'.$app->theme.'/images/avatars/0_normal.jpg'); ?>"
                                         width="52" height="52" data-tip="true" data-for=""></a>
                                <div class="styles_next-to-avatar">
                                    <div><a class="styles_author"
                                            href="<?php echo $controller->BASE_URL('Profile/' . $post['user']); ?>"><?php echo $post['user']; ?>
                                        </a></div>
                                    <div class="styles_posted-at"><?php echo $post['date']; ?></div>
                                </div>
                                <div class="post-actions">
                                    <a data-toggle="tooltip" data-placement="left" title=""
                                       data-animation="fadein"
                                       data-id="<?php echo $post['id']; ?>"
                                       data-title="<?php echo $post['title']; ?>"
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".remove-post-row"
                                       data-original-title="Remove Post"
                                       class="btn btn-danger remove-post-button"><i
                                                class=" fa fa-times"></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title=""
                                       data-animation="fadein"
                                       data-id="<?php echo $post['id']; ?>"
                                       data-title="<?php echo $post['title']; ?>"
                                       data-post='<?php echo $post['post']; ?>'
                                       data-plugin="custommodal" data-overlayspeed="200"
                                       data-overlaycolor="#36404a" href=".edit-post-row"
                                       data-original-title="Edit Post"
                                       class="btn btn-primary edit-post-button"><i
                                                class=" fa fa-edit"></i></a>
                                </div>
                            </div>
                            <div class="styles_post-body"><?php echo $post['post']; ?></div>
                            <div class="styles_post-actions button-list">
                                <div class="m-t-10 blog-widget-action">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-comment text-info"></i>
                                        <span><?php echo number_format($comments[0]); ?></span>
                                    </a>
                                </div>
                            </div>
                        </post>

                    <?php } ?>
                </div>
            </games-card>

        </div>

    </div>

</div>
<div class="modal-demo text-left remove-post-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Remove Post Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="remove-post-form">
                    <input id="remove-post" name="id" type="hidden" value="">
                    Are you sure you want Remove this Post ( <a class="remove-post"></a>
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
<div class="modal-demo  modal-full text-left add-post">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Add post Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="add-post-form" novalidate>
                    <div class="form-group">
                        <label for="userName">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" parsley-trigger="change" required="" placeholder="Title"
                               class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="userName">Description<span class="text-danger">*</span></label>
                        <div class="styles_textareaContainer"><textarea class="summernote" name="desc">
                            <h3>What`s on your mind?</h3>
                        </textarea>
                            <span class="styles_publisher">You're posting as <span
                                        class="text-danger"><?php echo $user_logged; ?></span></span></div>
                    </div>
                    <div class="form-group">
                        <label for="userName">Image [Banner]</label>
                        <input type="file" name="image" class="form-control fileupload">
                    </div>
            </div>

            <div class="panel-footer">

                <button type="submit"
                        class="btn btn-primary waves-effect waves-light"><i
                            class="fa fa-plus"></i> Add
                </button>
                </form>
                <button type="button" class="btn btn-danger waves-effect pull-right "
                        onclick="Custombox.close();"><i class="fa fa-times"></i> Close
                </button>

            </div>

        </div>
    </div>
</div>
<div class="modal-demo text-left edit-post-row">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <div class="custom-modal-header">

                <button type="button" class="close" onclick="Custombox.close();"
                        aria-hidden="true">×
                </button>
                <h4 class="custom-modal-title">Edit Post Modal
                </h4>
            </div>

            <div class="custom-modal-text">
                <form action="" method="POST" class="edit-post-form">
                    <input type="hidden" name="id" value="" id="post-id">
                    <div class="form-group">
                        <label for="userName">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" required placeholder="Title" class="form-control" value=""
                               id="title">
                    </div>
                    <div class="form-group">
                        <label for="desc">Description<span class="text-danger">*</span></label>
                        <div class="styles_textareaContainer"><textarea class="summernote" id="post" name="desc">

                        </textarea>
                            <span class="styles_publisher">You're Editing as <span
                                        class="text-danger"><?php echo $user_logged; ?></span></span></div>
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
