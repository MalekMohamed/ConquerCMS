<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 6/11/2018
 * Time: 1:39 AM
 */
$slider = array(
    1 => array('image' => '1.jpg', 'text' => '<span>Welcome to</span><i>World of the Gods</i><a href=\'https://worldofthegods.com/\'>The best WoW server!</a>'),
    2 => array('image' => '2.jpg', 'text' => '<span>Slider 2</span><i>Sub text</i><a href=\'https://link.com/\'>With link!</a>'),
    3 => array('image' => '3.jpg', 'text' => '<span>Slider 3 </span><i>Sub text</i><a href=\'https://link.com/\'>With link!</a>'),
    4 => array('image' => '4.jpg', 'text' => '<span>Slider 4</span><i>Sub text</i><a href=\'https://link.com/\'>With link!</a>'),
    5 => array('image' => '5.jpg', 'text' => '<span>Slider 5 </span><i>Sub text</i><a href=\'https://link.com/\'>With link!</a>'),
);
$menu = array(
    1 => array('href' => $app->BASE_URL('index.php'), 'text' => 'Home'),
    2 => array('href' => $app->BASE_URL('Account/Register'), 'text' => 'Register'),
    3 => array('href' => $app->BASE_URL('Download'), 'text' => 'Download'),
    4 => array('href' => $app->BASE_URL('Ranks/CPs'), 'text' => 'Ranks'),
    5 => array('href' => $app->BASE_URL('Store') , 'text' => 'Store'),
    6 => array('href' => $app->BASE_URL('Help') , 'text' => 'Need Help?'),
);
function ranks () {
    $app = new Config();
    $ranks = array(
        1 => array('href' => $app->BASE_URL('Ranks/CPs'), 'text' => 'CPS' , 'status' => true),
        2 => array('href' => $app->BASE_URL('Ranks/Money'), 'text' => 'Money', 'status' => true),
        3 => array('href' => $app->BASE_URL('Ranks/Arena'), 'text' => 'Arena', 'status' => true),
        4 => array('href' => $app->BASE_URL('Ranks/Donation'), 'text' => 'Donation', 'status' => true),
        5 => array('href' => $app->BASE_URL('Ranks/Level'), 'text' => 'Level', 'status' => true),
    );
    foreach ($ranks as $rank) {
        if ($rank['status'] != false) {
            echo '<a href="' . $rank['href'] . '" style="margin-right: 10px;" class="search_link nice_button">' . $rank['text'] . '</a>';
        }
    }
}
?>
