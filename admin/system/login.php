<?php

/**
 * Created by PhpStorm.
 * User: Veigar
 * Date: 1/30/2017
 * Time: 8:10 PM
 */
require '../../models/controllers/class.controller.php';
ob_start();

class login extends controller
{
    private $filtered_POST = array();
    private $response = array();

    public function __construct()
    {
        parent::__construct();
        $this->admin_login();

    }

    private function admin_login()
    {
        $name = filter_var($_POST['Username'],FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['Password'],FILTER_SANITIZE_STRING);
        $code = filter_var($_POST['code'],FILTER_SANITIZE_STRING);
        $count_user = $this->select($this->account, $this->account_table, $this->account_columns, array('Username = ?'), $name)->rowCount();
        $check_password = $this->account->prepare("SELECT Username,Password FROM $this->account_table WHERE Username = ? AND Password = ?");
        $check_password->execute(array($name, $password));
        $count_pass = $this->select($this->account, $this->account_table, $this->account_columns, array('Username = ?','Password = ?'), array($name,$password))->rowCount();
        $user = $this->get_user_by_name($name);
        $check_gm = $user['State'];
        if ($count_user == 0) {
            $this->response['msg'] = 'User not found ';
            $this->response['status'] = 'error';
        } elseif ($count_pass == 0) {
            $this->response['msg'] = 'Wrong password';
            $this->response['status'] = 'error';
        } elseif ($code != $this->Security_code) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'Wrong Security Code';
        } elseif ($check_gm != $this->gm_state) {
            $this->response['msg'] = 'you don\'t have the permission to enter this page'.$name.'/'.$code;
            $this->response['status'] = 'error';
        } else {
            $count = $this->select($this->account, $this->account_table, $this->account_columns, array('Username = ?','Password = ?','State = ?'), array($name,$password,$this->gm_state))->rowCount();
            if ($count == 1) {
                $_SESSION['account'] = $name;
                $_SESSION['admin'] = $name;
                $this->response['status'] = 'success';
                $this->response['msg'] = 'Login Success ....';
                $this->file_log('../../admin/logs/admin-log.txt',$_POST);
            }
        }

        echo json_encode($this->response);
    }

}

$login = new login();
