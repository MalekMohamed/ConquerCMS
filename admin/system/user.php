<?php

/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 1/27/2018
 * Time: 4:11 AM
 */
require '../../models/controllers/class.controller.php';

class user extends controller
{
    public function __construct()
    {
        if (isset($_SESSION['admin'])) {
            parent::__construct();
            if ($_POST['request'] == 'GET') {
                $get_user = $this->get_user_by_name($_POST['Username']);
                $get_char = $this->get_char_by_owner($_POST['Username']);
                $get_char['found'] = '1';
                if (empty($get_char)) {
                    $get_char['found'] = 'none';
                }
                echo json_encode(array('User' => $get_user, 'Character' => $get_char));
            }
            if ($_POST['request'] == 'Update') {
                $this->save_user();
            }
        }
    }

    private function save_user()
    {
        $Update_account = $this->account->prepare("UPDATE $this->account_table SET Password = ? , Email = ? , Question = ? ,Answer = ? , State = ? WHERE Username = ?");
        $Update_account->execute(array($_POST['Password'], $_POST['Email'], $_POST['Question'], $_POST['Answer'], $_POST['State'],  $_POST['Username']));

        if (!empty($_POST['Username'])) {
            $Update_entities = $this->game->prepare("UPDATE entities SET ConquerPoints = ? , Name = ? , Level = ?,VipLevel = ? WHERE Owner = ?");
            $Update_entities->execute(array(
                $_POST['ConquerPoints'],
                $_POST['Name'],
                $_POST['Level'],
                $_POST['VIPLevel'],
                $_POST['Username']
            ));

        }
        die('1');
    }

}

$user = new user();
