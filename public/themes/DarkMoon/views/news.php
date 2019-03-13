<script>
    $('.expandable > .head').on('click', function () {
        var parent = $(this).parent();
        parent.toggleClass('collapsed').find('> .body').slideToggle();
        setCookie(parent.prop('id'), parent.hasClass('collapsed') ? 1 : 0, 7);
    });

    $('.closeable > .close-btn').on('click', function () {
        var parent = $(this).parent();
        parent.toggleClass('closed').fadeToggle(0);
        setCookie(parent.prop('id'), parent.hasClass('closed') ? 1 : 0, 7);
    });

    $(function () {
        $('.expandable').each(function () {
            var element = $(this),
                collapsed = element.hasClass('collapsed'),
                cookie = getCookie(element.prop('id')) == 1;
            if ((cookie && !collapsed) || (!cookie && collapsed))
                element.find('> .head').trigger('click');
        });

        $('.closeable').each(function () {
            var element = $(this),
                closed = element.hasClass('closed'),
                cookie = getCookie(element.prop('id')) == 1;
            if (!element.find('> .close-btn').length)
                element.prepend('<a href="javascript:void(0)" class="close-btn"></a>');
            if ((cookie && !closed) || (!cookie && closed))
                element.find('> .close-btn').trigger('click');
        });
    });


</script>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$posts = $app->postsPagination($page);
foreach ($posts as $post) {
    $character = $app->get_char_by_owner($post['user']);
    $character['Name'] = isset($character['Name']) ? $character['Name'] : $app->server_name;
    ?>
    <article id="post_<?php echo $post['id']; ?>"
             class="news article box expandable post_<?php echo $post['id']; ?>"
             data-post-id="<?php echo $post['id']; ?>">
        <h2 class="head">
            <a href="<?php echo $app->BASE_URL('news/view/' . $post['id']); ?>"><?php echo $post['title']; ?></a>
        </h2>
        <div class="body">
            <?php echo $post['post']; ?>
            <div class="foot">
                <a href="javascript:void(0)" onclick="Ajax.showComments('<?php echo $post['id']; ?>')"
                   data-tip="Click to show & add comments" class="comments_button"
                   id="comments_button_<?php echo $post['id']; ?>">
                    Comments (<?php echo $app->get_post_comments($post['id'])[0]; ?>)
                </a>
                Posted by <a href="<?php echo $app->BASE_URL('news/view/' . $post['id']); ?>"
                             data-tip="View profile"><?php echo $character['Name']; ?></a>
                on <?php echo $post['date']; ?>
            </div>
        </div>

        <div class="comments" id='comments_<?php echo $post['id']; ?>'>
            <div class="divider"></div>
            <div class="comments_area" id="comments_area_<?php echo $post['id']; ?>">
                <?php foreach ($app->get_post_comments($post['id'])[1] as $comment) {
                    $user = $app->get_user_by_name($comment['user']);
                    $char = $app->get_char_by_owner($comment['user']);
                    if ($user['State'] == $app->gm_state) {
                        $author = 'staff_comment';
                        $img = '<img src="' . $app->BASE_URL('public/img/icons/icon_blizzard.gif') . ' " align="absmiddle">';
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
                            <img src="<?php echo $app->BASE_URL('public/img/faces/1'); ?>.jpg"
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
        </div>
        </div>
    </article>
<?php } ?>
<div id="news_pagination"><?php
    $prevpage = $page - 1;
    $nextpage = $page + 1;
    if ($prevpage != 0) {
        ?>
        &nbsp;<a href="<? echo $app->BASE_URL('news/' . $prevpage); ?>" data-hasevent="1">← Newer posts</a>&nbsp;<?php }
    if (!empty($posts)) { ?><a href="<?php echo $app->BASE_URL('news/' . $nextpage); ?>" data-hasevent="1">Older posts
        →</a><?php } ?></div>
