<?php
/**
 * Created by PhpStorm.
 * User: Oblivion
 * Date: 9/6/2018
 * Time: 4:12 AM
 */

class Store extends posts
{

    public function get_store_items()
    {
        $query = $this->account->prepare("SELECT * FROM store ORDER BY id ASC ");
        $query->execute();
        return $query->fetchAll();
    }

    public function get_item($id)
    {
        $query = $this->account->prepare("SELECT * FROM store WHERE Name = ?");
        $query->execute(array($id));
        return $query->fetch();
    }

}