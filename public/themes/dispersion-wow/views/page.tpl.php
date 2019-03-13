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
    <article class="' . $class . '">
	<h1 class="top">' . $title . '</h1>
	<section class="body">';
    if ($class == 'page_news') {
        $html = '<article>
	<section>';
    }

    echo $html;
}

function page_footer()
{
    $html = '</section></article>';
    echo $html;
}