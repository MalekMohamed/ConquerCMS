<?php
foreach ($app->get_posts()[1] as $post) {
    $character = $app->get_char_by_owner($post['user']);
    $post['user'] = isset($character['Name']) ? $character['Name'] : $app->server_name;
    ?>
    <article id="post_<?php echo $post['id']; ?>" class="post_<?php echo $post['id']; ?> news_row"
             data-post-id="<?php echo $post['id']; ?>">
        <div class="news_head">
            <a href="<?php echo $app->BASE_URL('news/view/'.$post['id']);?>" class="top"><?php echo $post['title']; ?></a>
        </div>
        <section class="body">
            <div class="avatar">
                <img src="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/images/avatars/0_normal.jpg'); ?>"
                     alt="avatar" height="120" width="120">
            </div>
            <p><?php echo $post['post']; ?></p>
            <div class="clear"></div>

            <div class="news_bottom">
                <a href="javascript:void(0)" onclick="Ajax.showComments('<?php echo $post['id']; ?>')"
                   data-tip="Click to show & add comments" class="comments_button"
                   id="comments_button_<?php echo $post['id']; ?>">
                    Comments (<?php echo $app->get_post_comments($post['id'])[0]; ?>)
                </a>
                Posted by <a
                        href="<?php echo $app->BASE_URL('Profile/' . $post['user']); ?>"
                        data-tip="View profile"><?php echo $post['user']; ?></a> on <?php echo $post['date']; ?>

                <div class="comments" id='comments_<?php echo $post['id']; ?>'>
                    <div class="divider"></div>
                    <div class="comments_area" id="comments_area_<?php echo $post['id']; ?>">
                        <?php foreach ($app->get_post_comments($post['id'])[1] as $comment) {
                            $user = $app->get_user_by_name($comment['user']);
                            $char = $app->get_char_by_owner($comment['user']);
                            if ($user['State'] == $app->gm_state) {
                                $author = 'staff_comment';
                                $img = '<img src="'.$app->BASE_URL('public/img/icons/icon_blizzard.gif') .' " align="absmiddle">';
                            } else {
                                $author = '';
                                $img = '';
                            }
                            ?>
                            <div class="comment <?php echo $author; ?>">
                                <div class="comment_date">
                                    <?php echo $comment['date']; ?>
                                </div>
                                <a data-tip="View Profile" href="<?php echo $app->BASE_URL('Profile/' . $char['Name']); ?>">
                                    <img src="<?php echo $app->BASE_URL('public/img/faces/' . $char['Face']); ?>.jpg"
                                         width="40" height="40"
                                         alt="<?php echo $char['Name']; ?>'s Avatar"></a>
                                <a class="comment_author"
                                   data-tip="View Profile"
                                   href="<?php echo $app->BASE_URL('Profile/' . $char['Name']); ?>"
                                   title="<?php echo $char['Name']; ?>"><?php echo $img; ?><?php echo $char['Name']; ?>
                                </a>
                                <?php echo $comment['comment']; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if (isset($user_logged)) { ?>

                        <form action="#" onsubmit="addComment('<?php echo $post['id']; ?>'); return false"
                              method="post" class="comment-form">
                            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                            <textarea name="comment_area" id="comment_field_<?php echo $post['id']; ?>"
                                      onkeyup="UI.limitCharacters(this, 'characters_remaining_<?php echo $post['id']; ?>')"
                                      maxlength="255" class="comment_form border_box"
                                      placeholder="Enter your comment"></textarea>
                            <div class="characters_remaining"><span
                                        id="characters_remaining_<?php echo $post['id']; ?>">0 / 255</span>
                                characters
                            </div>
                            <input type="submit" value="Submit comment">
                        </form>
                    <?php } else { ?>
                        <form onsubmit="UI.alert(&quot;Please log in to comment!&quot;);return false">
                                <textarea class="comment_form border_box" placeholder="Please log in to comment"
                                          disabled=""></textarea>
                            <input type="submit" value="Submit comment">
                        </form>
                    <?php } ?>
                </div>
                <div class="clear"></div>
            </div>
        </section>
    </article>
<?php } ?>