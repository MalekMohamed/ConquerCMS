<?php
/**
 * Copyright (c) 2017.  All right reserved to ConquerHub
 */

/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 11/6/2017
 * Time: 4:30 AM
 */
class posts extends tickets
{
    /*
    * Table Used -> posts , comments , likes , entities
    */

    /*
    * Get Posts
     * Return [0] => Number of Posts
     * Return [1] => Fetch Data
    */
    public function get_posts()
    {
        $query = $this->account->prepare("SELECT * FROM posts ORDER BY id DESC");
        $query->execute();
        return array($query->rowCount(), $query->fetchAll());
    }
    public function postsPagination($page)
    {
        $per_page = 5;
        $row_start = (($per_page * $page) - $per_page);
        $num_rows = $this->get_posts()[0];
        $row_end = $per_page * $page;
        if ($row_end > $num_rows) {
            $row_end = $num_rows;
        }
        $query = $this->account->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $row_start, $row_end");
        $query->execute();
        return $query->fetchAll();
    }
    /*
     * Return Post Data by Specific Post ID
     */
    public function get_post_by_id($post_id)
    {
        $query = $this->select($this->account, 'posts', '*', array('id = ?'), $post_id);
        return array($query->rowCount(), $query->fetch());
    }

    /*
   * Return Post Comment by Specific Post ID
   */
    public function get_post_comments($post_id)
    {
        $query = $this->select($this->account, 'comments', '*', array('post_id = ?'), $post_id);
        return array($query->rowCount(), $query->fetchAll());
    }

    public function get_all_comments()
    {
        $query = $this->select($this->account, 'comments', '*', 'ORDER BY date', '');
        return array($query->rowCount(),$query->fetchAll());
    }

    /*
     * Add Comment on Post by user
     */
    public function add_comment($post_id, $username, $comment)
    {
        $time = date('d-M-Y h:i a');
        $query = $this->account->prepare("INSERT INTO comments Values (:postid,:comment,:user,:date)");
        if ($query->execute(array(':postid' => $post_id,':comment' => $comment, ':user' => $username,':date' => $time))) {
            return true;
        } else {
            return false;
        }
    }
}
