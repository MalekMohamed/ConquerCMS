<?php

/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 10/21/2017
 * Time: 12:47 PM
 */
class accounts extends Config
{
    protected $account_columns = 'Username,Password,Email,State,Question,Answer';
    protected $account_table = 'accounts';

    public function user_state($state)
    {
        if ($state == 1) return '<i style="color: #515F6D;">Banned</i>';
        if ($state == null) return '<i style="color: #0085FF;">Player</i>';
        if ($state == 80) return 'Lock-Cheat';
        if ($state == 0) return '<i style="color: #0085FF;">Player</i>';
        if ($state == $this->gm_state) return '<i style="color: #FF0000;">Project Manager</i>';
        return (Empty($state) ? '' : '<i style="color: #0085FF;">Player</i>');
    }


    public function get_user_by_name($name)
    {
        $query = $this->account->prepare("SELECT $this->account_columns FROM $this->account_table WHERE Username = ? ");
        $query->execute(array($name));
        return $query->fetch();
    }

    public function check_username($name)
    {
        $query = $this->account->prepare("SELECT $this->account_columns FROM $this->account_table WHERE Username = ? ");
        $query->execute(array($name));
        return $query->rowCount();
    }

    public function get_users()
    {
        $query = $this->account->prepare("SELECT COUNT(*) AS Counter FROM $this->account_table");
        $query->execute();
        return $query->fetch()[0];
    }

    public function check_user_data($username, $password = null, $email = null)
    {
        $response = array();
        $response['user_check'] = $this->check_username($username);
        $password_check = $this->account->prepare("SELECT Username,Password FROM $this->account_table WHERE Username = ? AND Password=? ");
        $password_check->execute(array($username, $password));
        $email_check = $this->account->prepare("SELECT Username,Email FROM $this->account_table WHERE Username = ? AND Email=?");
        $email_check->execute(array($username, $email));
        if ($password != null) {
            $response['password_check'] = $password_check->rowCount();
        }
        if ($email != null) {
            $response['email_check'] = $email_check->rowCount();
        }
        return $response;
    }

    public function changepassword($username, $newpassword)
    {
        $query = $this->account->prepare("UPDATE $this->account_table SET Password = ? WHERE Username = ?");
        $query->execute(array($newpassword, $username));
        return true;
    }

    public function changeemail($username, $newemail)
    {
        $query = $this->account->prepare("UPDATE $this->account_table SET Email = ? WHERE Username = ?");
        $query->execute(array($newemail, $username));
        return true;
    }

    public function create_user($data)
    {
        $query = $this->account->prepare("INSERT INTO $this->account_table (Username,Password,Email,Question,Answer) VALUES (:user,:pass,:email,:Question,:Answer)");
        if ($query->execute(array('user' => $data['Username'], 'pass' => $data['Password'], 'email' => $data['Email'], 'Question' => $data['ques'], 'Answer' => $data['ans']))) {
            return true;
        }

    }

}
