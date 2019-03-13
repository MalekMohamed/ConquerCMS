<pre>
<?php
require 'models/controllers/class.controller.php';
//var_dump(parse_ini_file($app->files_url.'Users/88888037.ini'));
echo print_r($app->get_char_guild_name('1003'));
$app->rebuild_database();