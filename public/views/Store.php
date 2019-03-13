<?php if (!isset($user_logged)) {
    $base = $app->BASE_URL('Account/LogIn');
    header("Location: $base");
} else {
  $character = $app->get_char_by_owner($user_logged);
    ?>
    <link type="text/css" rel="stylesheet"
          href="<?php echo $app->BASE_URL('public/modules/character_tools/css/character_tools.css'); ?>"/>
    <?php page_header('Store Page'); ?>
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
            <div class="select_tools">

              <?php
        foreach ($app->get_store_items() as $item) {

            if (!empty($item)) {
            ?>
                <!-- Password -->
                <div class="select_tool">
                    <div class="tool store_item">

                        <section class="tool_buttons">
                            <button type="submit" name="submit" class="nice_button request_payment"  data-item="<?php echo $item['id']; ?>">
                                Buy <?php echo $app->currency; ?><?php echo $item['price']; ?>
                            </button>
                        </section>

                        <img class="item_icon" data-tip="<?php echo $item['description']; ?>"
                             src="<?php echo $app->BASE_URL('public/img/store/' . $item['image'] . ''); ?>"
                             width="36" height="36" align="absmiddle">

                        <a class="tool_name"
                           data-tip="<?php echo $item['description']; ?>"><?php echo $item['Name']; ?></a>
                        <br>
                        <?php echo $item['description']; ?>

                        <div class="clear"></div>
                    </div>
                </div>

            <?php
          }
        }
        ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

            <div class="ucp_divider"></div>
    <p><font color="#f7f7f7">You can now buy Credit Point from the store and exchange it with ( 5 - Star garments , Mounts , CPS , VIP and more coming ) in game&nbsp;</font></p><img src="http://warforgeco.com/public/img/posts/store2.jpg"><br><br><p><font color="#ffffff">After you Complete your payment successfully your account will be charged with the amount of points you bought and all you have to do is to Spend these point from "</font><font color="#ffff00">Store</font><font color="#ffffff">" NPC in </font><font color="#ffff00">TwinCity</font> <font color="#ffff00">(428,380)</font></p>
        </section>
        <div class="clear"></div>
    </section>
    <?php page_footer(); ?>
<?php } ?>
