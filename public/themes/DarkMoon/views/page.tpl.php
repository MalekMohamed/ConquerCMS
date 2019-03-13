<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 6/10/2018
 * Time: 2:02 AM
 */
/**
 * @title article Title
 * @class Any Addition Class
 */
function page_header($title, $class = null)
{
    $html = '
    <article class="article box expandable' . $class . '">
	<h2 class="head"><a>' . $title . '</a></h2>
	<div class="body">';
    if ($class == 'page_news') {
        $html = '<div id="content_ajax">';
    }

    echo $html;
}

function page_footer()
{
    $html = '</div></article>';
    echo $html;
}