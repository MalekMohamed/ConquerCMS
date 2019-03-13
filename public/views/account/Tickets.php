<?php if (!isset($user_logged)) {
    header("Location: ../../../Account/LogIn");
} else {
    ?>
    <link type="text/css" rel="stylesheet"
          href="<?php echo $app->BASE_URL('public/css/selectbox.css'); ?>"/>
    <?php page_header('Tickets Support'); ?>
    <section id="statistics_wrapper">
        <link type="text/css" rel="stylesheet"
              href="<?php echo $app->BASE_URL('public/modules/pvp_statistics/css/style.css'); ?>"/>
        <section id="checkout"></section>
        <div id="search_sections">
            <a href="<?php echo $app->BASE_URL('Support/Tickets/All/'); ?>"
               class="search_link  <?php if ($_GET['mode'] == 'All') { ?>nice_active <?php } ?>nice_button">All
                Tickets</a>
            <a href="<?php echo $app->BASE_URL('Support/Tickets/Create/'); ?>"
               class="search_link <?php if ($_GET['mode'] == 'Create') { ?>nice_active <?php } ?> nice_button">Create</a>
            <a href="javascript:void(0)"
               class="search_link  <?php if ($_GET['mode'] == 'View') { ?>nice_active <?php } ?>  nice_button">View</a>
        </div>
        <div class="divider"></div>
        <section id="statistics">


            <?php
            if ($_GET['mode'] == 'Create') {
                ?>
                <!-- Create -->
                <div class="post"><h4>New
                        Support
                        Ticket</h4>
                    <p>Please fill in the following fields. Make sure to include
                        as
                        much information as
                        possible!</p>
                </div>
                <form action="#" class="page_form ticket-form" method="post">
                  <table style="width:80%">
                      <tbody>

                      <tr>
                          <td><label for="register_Title">Title</label></td>
                          <td>
                              <input type="text" name="Title" id="register_Title" value="">
                              <span id="Title_error"></span>
                          </td>
                      </tr>
                      <tr>
                          <td><label for="register_Category">Category</label></td>
                          <td>
                            <select id="register_Category" name="Category">
                                                    <option selected="selected" value="">- Select
                                                        Category
                                                        -
                                                    </option>
                                                    <option value="Purchase Issue">Purchase Issue
                                                    </option>
                                                    <option value="Account Issue">Account Issue</option>
                                                    <option value="Character Issue">Character Issue
                                                    </option>
                                                    <option value="Item Issue">Item Issue</option>
                                                    <option value="VIP Transfer">VIP Transfer</option>
                                                    <option value="Botjailed / Banned">Botjailed /
                                                        Banned
                                                    </option>
                                                    <option value="Miscellaneous">Miscellaneous</option>
                                                </select>
                              <span id="Category_error"></span>
                          </td>
                      </tr>
                      <tr>
                          <td><label for="register_Message">Problem</label></td>
                          <td>
                            <textarea style="min-width:350px;min-height:50px;max-width:500px;width: 100%; height:50px;" id="register_Message"
                                      name="Message"></textarea>
                  <span id="Message_error"></span>
                          </td>
                      </tr>
                      <?php
                      if ($app->reCaptcha['enable'] == true) { ?>
                          <tr>
                              <td><label for="register_captcha">Captcha</label></td>
                              <script src='https://www.google.com/recaptcha/api.js'></script>
                              <td>
                                  <div class="g-recaptcha" style="margin-left: 5px;"
                                       id="register_captcha" data-recaptcha="google" data-theme="<?php echo $app->reCaptcha['theme'];?>"
                                       data-sitekey="<?php echo $app->reCaptcha['public_key'];?> "></div>
                              </td>
                              <span id="captcha_error"></span>
                          </tr>
                      <?php } else { ?>
                          <script type="application/javascript">
                              function ChangeCaptcha() {
                                  $('#captcha_img').attr('src', $('#captcha_img')
                                      .attr('src') + '?' + Math.random() );
                              }
                          </script>
                          <tr>
                              <td><label class="captcha-text" for="register_captcha">
                                      <img id='captcha_img' src="<?php echo $app->BASE_URL('public/modules/register/models/captcha.php');?>"></label>
                                  <a style="color:#fcb70f;" href="javascript:void(0)" onclick="ChangeCaptcha();">Get a new code</a>

                              </td>
                              <td>
                                  <input type="text" data-recaptcha="cms" name="register_captcha" id="register_captcha">
                                  <span id="captcha_error"></span>

                              </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                    </table>

                    <center style="margin-bottom:10px;">
                        <input type="submit" value="Create Ticket!">
                        <span class="response-msg pull-left"
                              style="display: none;">fuck you</span>
                    </center>

                    <div class="clearfix"></div>
                </form>

            <?php } elseif ($_GET['mode'] == 'View') {
                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                $order_ticket = $app->view_ticket($id);
                if ($order_ticket[0] != 1 || $order_ticket[1]['User'] != $user_logged) {
                    ?>
                    <div class="post">
                        <h1>404</h1>
                        <h3>Oops.! The Page you were looking for, couldn't be
                            found.</h3>
                        <br>
                        <a href="<?php echo $app->BASE_URL('index.php'); ?>"
                           class="nice_button"><i
                                    class="fa fa-arrow-left"></i> Back to Home</a>
                    </div>
                    <?php
                } else {
                    $replyes = $app->get_replys($id);
                    ?>
                    <div class="post">
                        <h4 class="text-center">
                            Title : <?php echo $order_ticket[1]['title']; ?>
                            | Status : <?php echo $app->status($order_ticket[1]['Status']); ?>
                            <br> <?php echo $order_ticket[1]['problem']; ?></h4>
                    </div>
                    <div class="comments" id="comments_1" style="display: block;">
                        <div class="divider"></div>
                        <div class="comments_area" style="float: inherit;width: auto"
                             id="comments_area_<?php echo $order_ticket[1]['id']; ?>">
                            <?php
                            foreach ($replyes[1] as $reply) {
                                $char = $app->get_char_by_owner($reply['user']);
                                $author = '';
                                $img = '';
                                if ($reply['user'] != $user_logged) {
                                    $author = 'staff_comment';
                                    $img = '<img src="' . $app->BASE_URL('public/img/icons/icon_blizzard.gif') . ' " align="absmiddle">';
                                }
                                $reply['user'] = $char['Name'];
                                ?>
                                <div class="comment <?php echo $author; ?>" style="width: 100%">
                                    <div class="comment_date">
                                        <?php echo $reply['date']; ?>
                                    </div>
                                    <a data-tip="View Profile"
                                       href="<?php echo $app->BASE_URL('Profile/' . $reply['user']); ?>"><img
                                                src="<?php echo $app->BASE_URL('public/img/faces/' . $char['Face']); ?>.jpg"
                                                width="40" height="40"
                                                alt="<?php echo $reply['user']; ?>'s Avatar"></a>
                                    <a class="comment_author" data-tip="View Profile"
                                       href="<?php echo $app->BASE_URL('Profile/' . $reply['user']); ?>"
                                       title="<?php echo $reply['user']; ?>"><?php echo $img; ?><?php echo $reply['user']; ?></a>
                                    <?php echo $reply['reply']; ?>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                    <?php
                    if ($order_ticket[1]['Status'] != 3) {
                        ?>
                        <style>
                            .reply-form .warfg_btn:last-child {
                                display: none;
                            }
                        </style>

                        <form action="#" method="post" class="page_form reply-form">
                            <table style="width:80%">
                                <tbody>

                                <tr>
                                    <td><label class="captcha-text" for="Reply">Meesage</label></td>
                                    <td>
                                               <textarea class="comment_form border_box" name="Reply" style="min-width:350px;min-height:50px;max-width:500px;width: 100%; height:50px;"
                                                         placeholder="Enter your Reply"></textarea>
                                    </td>
                                </tr>
                                <?php
                                if ($app->reCaptcha['enable'] == true) { ?>
                                    <tr>

                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                        <td>
                                            <div class="g-recaptcha" style="margin-left: 5px;"
                                                 id="register_captcha" data-recaptcha="google" data-theme="<?php echo $app->reCaptcha['theme'];?>"
                                                 data-sitekey="<?php echo $app->reCaptcha['public_key'];?> "></div>
                                        </td>
                                        <span id="captcha_error"></span>
                                    </tr>
                                <?php } else { ?>
                                    <script type="application/javascript">
                                        function ChangeCaptcha() {
                                            $('#captcha_img').attr('src', $('#captcha_img')
                                                .attr('src') + '?' + Math.random() );
                                        }
                                    </script>
                                    <tr>
                                        <td><label class="captcha-text" for="register_captcha">
                                                <img id='captcha_img' src="<?php echo $app->BASE_URL('public/modules/register/models/captcha.php');?>"></label>
                                            <br>
                                            <a style="color:#fcb70f;" href="javascript:void(0)" onclick="ChangeCaptcha();">Get a new code</a>

                                        </td>
                                        <td>
                                            <input type="text" data-recaptcha="cms" name="register_captcha" id="register_captcha">
                                            <span id="captcha_error"></span>

                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>
                                        <input type="submit" value="Submit comment"></td>
                                    <td style="text-align: right">  <a href="<?php echo $app->BASE_URL('Support/Tickets/CloseTicket/' . $id); ?>"
                                           class="nice_button">Close Ticket</a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <span style="display: none;font-size: 15px;border-radius: 3px;padding: 5px;background-color: #0a0a0a;" id="reply-form-error"></span><br>
                            <input type="hidden" name="id" id="Id"
                                   value="<?php echo $order_ticket[1]['id']; ?>">

                        </form>
                    <?php } ?>
                <?php } ?>

                <?php
            } elseif ($_GET['mode'] == 'All') {
                ?>
                <section id="statistics_title" style="margin-top: 40px; margin-bottom: 10px;">
                    <div><h3>You have (<?php echo $app->get_tickets_by_user($user_logged)[0]; ?>)
                            Tickets</h3></div>
                </section>
                <section class="statistics_top_hk" style="display:block;">

                    <table class="nice_table" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="25%" align="center">Last Updated</td>
                            <td width="20%" align="center">Title</td>
                            <td width="15%" align="center">Category</td>
                            <td width="20%" align="center">Status</td>
                            <td width="10%" align="center">Action</td>
                        </tr>
                        <?php
                        $tickets = $app->get_tickets_by_user($user_logged)[1];
                        foreach ($tickets as $ticket) {
                            ?>
                            <tr>
                                <td width="25%" align="center">
                                    <?php echo $ticket['time']; ?>
                                </td>
                                <td width="20%" align="center"><?php echo $ticket['title']; ?>
                                </td>
                                <td width="15%" align="center"><?php echo $ticket['category']; ?>
                                </td>
                                <td width="20%" align="center">
                                    <?php echo $app->status($ticket['Status']); ?>
                                </td>
                                <td width="10%" align="center"><a class="nice_button"
                                                                  href="<?php echo $app->BASE_URL('Support/Tickets/View/' . $ticket['id']); ?>">
                                        View</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </section>


            <?php } elseif ($_GET['mode'] == 'CloseTicket') {
                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                $order_ticket = $app->view_ticket($id);
                if ($order_ticket[0] == 1 && $order_ticket[1]['User'] == $user_logged) {
                    $close = $app->update_status($id, 3);
                    header("Location: ../All/");
                } else {
                    ?>
                    <div class="post">
                        <h1>404</h1>
                        <h3>Oops.! The Page you were looking for, couldn't be
                            found.</h3>
                        <br>
                        <a href="<?php echo $app->BASE_URL('index.php'); ?>"
                           class="nice_button"><i
                                    class="fa fa-arrow-left"></i> Back to Home</a>
                    </div>
                    <?php
                }
            } ?>
        </section>
    </section>



    <?php page_footer(); ?>
<?php } ?>
