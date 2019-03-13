<?php if (!isset($user_logged)) {
    header("Location: ../Account/LogIn");
} else { ?>

                    <link type="text/css" rel="stylesheet"
                          href="<?php echo $app->BASE_URL('public/modules/character_tools/css/character_tools.css'); ?>"/>
    <?php page_header('Account Settings'); ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    function initializeCharacterTools() {
                                        if (typeof CharacterTools != "undefined") {
                                            CharacterTools.User.initialize(0);
                                        }
                                        else {
                                            setTimeout(initializeCharacterTools, 50);
                                        }
                                    }
                                    initializeCharacterTools();
                                });
                            </script>
                            <section id="character_tools">

                                <section id="select_tool">
                                    <div class="online_realm_button">Select service</div>

                                    <div class="select_tools">
                                        <script type="text/javascript">
                                            function form_load(name) {
                                                if (name == 'changepassword') {
                                                    $('.forms-panel .change-email').hide();
                                                    $('.forms-panel .change-pw').show();
                                                } else if (name == 'changeemail') {
                                                    $('.forms-panel .change-pw').hide();
                                                    $('.forms-panel .change-email').show();

                                                }
                                            }
                                        </script>
                                        <!-- Password -->
                                        <div class="select_tool">
                                            <div class="tool store_item">
                                                <section class="tool_buttons">
                                                    <a href="javascript:void(0)" class="nice_button"
                                                       onclick="form_load('changepassword')">
                                                        Open
                                                    </a>
                                                </section>

                                                <img class="item_icon" data-tip="Change your account Password"
                                                     src="<?php echo $app->BASE_URL('public/modules/character_tools/images/3303973.png'); ?>"
                                                     width="36" height="36" align="absmiddle">

                                                <a class="tool_name" data-tip="Change your account Password">Change
                                                    Password</a>
                                                <br>
                                                Change account Password
                                                <div class="clear"></div>
                                            </div>
                                        </div>

                                        <!-- Email Change -->
                                        <div class="select_tool">
                                            <div class="tool store_item">
                                                <section class="tool_buttons">
                                                    <a href="javascript:void(0)" class="nice_button"
                                                       onclick="form_load('changeemail')">
                                                        Open
                                                    </a>
                                                </section>
                                                <img class="item_icon"
                                                     data-tip="Change account Email"
                                                     src="<?php echo $app->BASE_URL('public/modules/character_tools/images/3300587.png'); ?>"
                                                     width="36" height="36" align="absmiddle">

                                                <a class="tool_name"
                                                   data-tip="Change account Email">Change Email</a>
                                                <br>
                                                Change account Email
                                                <div class="clear"></div>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>

                                    <div class="ucp_divider"></div>

                                </section>
                                <section id="select_form">

                                    <div class="select_tools forms-panel">
                                        <div class="change-email" style="display: none;"><?php  require 'ChangeEmail.php';?></div>
                                        <div class="change-pw" style="display: none;"><?php  require 'ChangePassword.php';?></div>
                                    </div>

                                </section>
                                <div class="clear"></div>
                            </section>
             <?php page_footer();?>
<?php } ?>
