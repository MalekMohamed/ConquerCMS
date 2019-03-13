<?php

/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 10/11/2017
 * Time: 4:02 PM
 */
spl_autoload_register(function ($name) {
    require 'class.' . $name . '.php';
});
function get_client_ip_server()
{
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if ($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if ($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

class controller extends Store
{
    private $request;
    private $response = array();

    public function file_log($txt, $data)
    {
        $date = date("d-M-Y h:i a");
        $report = file_get_contents($txt);
        $report .= 'Date [' . $date . "]\n";
        foreach ($data as $k => $v) {
            if ($k != 'public/views') {
                $report .= "-[$k] = [$v]\n";
            }
        }
        $report .= "--------------------------------------------- \n";
        file_put_contents($txt, $report);
    }

    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->request = filter_var($_GET['request'], FILTER_SANITIZE_STRING);
        if (isset($this->request)) {
            switch ($this->request) {
                case 'createuser':
                    $this->create_account();
                    break;
                case 'resetpass':
                    $this->resetpassword();
                    break;
                case 'login':
                    $this->login();
                    break;
                case 'change-password':
                    $this->change_password();
                    break;
                case 'post-comment':
                    $this->post_comment();
                    break;
                case 'change-email':
                    $this->change_email();
                    break;
                case 'send-ticket':
                    $this->send_ticket();
                    break;
                case 'reply-ticket':
                    $this->reply_ticket();
                    break;
            }
        } else {
            die();
        }
    }

    private function post_comment()
    {

        $post_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $comment = strip_tags(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
        if ($this->get_post_by_id($post_id)[0] != 1) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'Post not found';
            $this->response['field'] = 'All';
        } elseif (empty($comment)) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'Please enter your comment first';
            $this->response['field'] = 'All';
        } else {

            $comm = $this->add_comment($post_id, $_SESSION['account'], $comment);
            if ($comm) {
                $this->response['status'] = 'success';
                $this->response['user'] = $_SESSION['account'];
                $this->response['date'] = date('d-M-Y h:i a');
                $this->response['comment'] = $comment;
            } else {
                $this->response['status'] = 'error';
                $this->response['msg'] = 'Something went wrong';
                $this->response['field'] = 'All';
            }

        }
        echo json_encode($this->response);
    }

    private function reply_ticket()
    {
        ;
        if (isset($_SESSION['account'])) {
            $ticketid = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $reply = filter_var($_POST['Reply'], FILTER_SANITIZE_STRING);
            $ticket = $this->view_ticket($ticketid);
            $error = '';
            $verify = false;
            if ($this->reCaptcha['enable'] == true) {
                //get verify response data
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->reCaptcha['secret_key'] . '&response=' . $_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                $verify = $responseData->success;
            } else {
                $captcha = filter_var($_POST['register_captcha'], FILTER_SANITIZE_STRING);
                if ($_SESSION['captcha'] != $captcha) {
                    $verify = false;
                }
            }
            if ($ticket[0] != 1) {
                $this->response['msg'] = 'Ticket not found';
                $this->response['status'] = 'error';
                $error .= '1';
            } elseif (empty($reply)) {
                $this->response['msg'] = 'Please enter your reply';
                $this->response['status'] = 'error';
                $error .= '1';
            } elseif ($verify == false) {
                $this->response['msg'] = 'invalid Captcha ';
                $this->response['status'] = 'error';
                $this->response['field'] = '#register_captcha';
                $error .= '1';
            }
            if (empty($error)) {
                $this->response['msg'] = 'Reply Sent';
                $this->response['status'] = 'success';
                $this->reply($ticketid, $_SESSION['account'], $reply);
                $this->update_status($ticketid, 0);

            }
        } else {
            $this->response['msg'] = 'You must be logged in to Do this function';
            $this->response['status'] = 'error';
        }
        echo json_encode($this->response);
    }

    private function send_ticket()
    {
        ;
        if (isset($_SESSION['account'])) {
            $title = filter_var($_POST['Title'], FILTER_SANITIZE_STRING);
            $cate = filter_var($_POST['Category'], FILTER_SANITIZE_STRING);
            $problem = filter_var($_POST['Message'], FILTER_SANITIZE_STRING);
            $error = '';
            $verify = false;
            if ($this->reCaptcha['enable'] == true) {
                //get verify response data
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->reCaptcha['secret_key'] . '&response=' . $_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                $verify = $responseData->success;
            } else {
                $captcha = filter_var($_POST['register_captcha'], FILTER_SANITIZE_STRING);
                if ($_SESSION['captcha'] != $captcha) {
                    $verify = false;
                } else {
                    $verify = true;
                }
            }
            if (empty($title)) {
                $this->response['status'] = 'error';
                $this->response['msg'] = 'Enter your ticket title';
                $this->response['field'] = '#register_Title';
                $error .= '1';
            } elseif ($verify == false) {
                $this->response['msg'] = 'invalid Captcha ' . $_SESSION['captcha'] . '-' . $captcha;
                $this->response['status'] = 'error';
                $this->response['field'] = '#register_captcha';
                $error .= '1';
            } elseif (empty($cate)) {
                $this->response['status'] = 'error';
                $this->response['msg'] = 'Choose ticket category';
                $this->response['field'] = '#register_Category';
                $error .= '1';
            } elseif (empty($problem)) {
                $this->response['status'] = 'error';
                $this->response['msg'] = 'Enter your problem please';
                $this->response['field'] = '#register_Message';
                $error .= '1';
            }
            if (empty($error)) {
                $this->add_ticket($_SESSION['account'], $title, $problem, $cate);
                $this->response['status'] = 'success';
                $this->response['msg'] = 'Your ticket Successfully Created . Please wait until any of GMS reply';
            }
        } else {
            $this->response['msg'] = 'You must be logged in to Do this function';
            $this->response['status'] = 'error';
            $this->response['field'] = 'All';
        }
        echo json_encode($this->response);
    }

    private function change_password()
    {
        $current_password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
        $new = filter_var($_POST['NewPassword'], FILTER_SANITIZE_STRING);;
        $check = $this->check_user_data($_SESSION['account'], $current_password, null);
        if (empty($new) || empty($current_password)) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'All fields are required';
            $this->response['field'] = 'All';
        } elseif ($check['password_check'] != 1) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'Incorrect Password';
            $this->response['field'] = '#register_password';
        } elseif ($current_password == $new) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'New password and Current password can`t be the same';
            $this->response['field'] = '#register_new_password';
        } else {
            $this->changepassword($_SESSION['account'], $new);
            $this->response['status'] = 'success';
            $this->response['msg'] = 'Your Password has been changed Successfully';
        }
        echo json_encode($this->response);
    }

    private function change_email()
    {
        $password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
        $current_email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
        $new = filter_var($_POST['NewEmail'], FILTER_SANITIZE_EMAIL);

        $check = $this->check_user_data($_SESSION['account'], $password, $current_email);
        if (empty($new) || empty($current_email) || empty($password)) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'All fields are required';
            $this->response['field'] = 'All';
        } elseif ($check['password_check'] != 1) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'Incorrect Password';
            $this->response['field'] = '#register_email_password';
        } elseif ($check['email_check'] != 1) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'Incorrect Email';
            $this->response['field'] = '#register_email';
        } elseif ($current_email == $new) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'New Email and Current Email can`t be the same';
            $this->response['field'] = '#register_new_email';
        } else {
            $this->changeemail($_SESSION['account'], $new);
            $this->response['status'] = 'success';
            $this->response['msg'] = 'Your Email has been changed Successfully';
        }
        echo json_encode($this->response);
    }

    private function resetpassword()
    {
        $username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
        $newpassword = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
        $ans = filter_var($_POST['Answer'], FILTER_SANITIZE_STRING);
        $ques = filter_var($_POST['Question'], FILTER_SANITIZE_STRING);
        $check_user = $this->check_username($username);
        if ($check_user != 1) {
            $this->response['status'] = 'error';
            $this->response['msg'] = 'Username not found';
            $this->response['field'] = '#register_username2';
        } else {
            $question = $this->select($this->account, $this->account_table, $this->account_columns, array('Username = ?', 'Question = ?'), array($username, $ques))->rowCount();
            $answer = $this->select($this->account, $this->account_table, $this->account_columns, array('Username = ?', 'Answer = ?'), array($username, $ans))->rowCount();
            $email_check = $this->select($this->account, $this->account_table, $this->account_columns, array('Username = ?', 'Email = ?'), array($username, $email))->rowCount();
            if ($question != 1) {
                $this->response['field'] = '#register_question';
                $this->response['status'] = 'error';
                $this->response['msg'] = 'Incorrect Question';
            } elseif ($answer != 1) {
                $this->response['field'] = '#register_answer';
                $this->response['status'] = 'error';
                $this->response['msg'] = 'Incorrect Answer';
            } elseif ($email_check != 1) {
                $this->response['field'] = '#register_email';
                $this->response['status'] = 'error';
                $this->response['msg'] = 'Incorrect Email';
            } else {
                $this->changepassword($username, $newpassword);
                $this->response['status'] = 'success';
                $this->response['field'] = 'All';
                $this->response['msg'] = 'Password Changed Successfully';
            }
        }
        echo json_encode($this->response);
    }

    private function create_account()
    {

        $username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
        $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
        $ques = filter_var($_POST['Question'], FILTER_SANITIZE_STRING);
        $ans = filter_var($_POST['Answer'], FILTER_SANITIZE_STRING);
        $data = array('Username' => $username, 'Password' => $password, 'Email' => $Email, 'ques' => $ques, 'ans' => $ans);

        if ($this->reCaptcha['enable'] == true) {
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->reCaptcha['secret_key'] . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            $verify = $responseData->success;
        } else {
            $captcha = filter_var($_POST['register_captcha'], FILTER_SANITIZE_STRING);
            $verify = true;
            if ($_SESSION['captcha'] != $captcha) {
                $verify = false;
            }
        }
        if (!empty($username) && !empty($password) && !empty($Email) && !empty($ques) && !empty($ans)) {
            if (!preg_match("/^([0-9a-zA-Z]+)$/", $username)) {
                $this->response['msg'] = 'Username Only letters from A-a to Z-z and numbers, length of 3 to 32 characters';
                $this->response['status'] = 'error';
                $this->response['field'] = '#register_username';
            } else if (!preg_match("/^([0-9a-zA-Z]+)$/", $password)) {
                $this->response['msg'] = 'Password Only letters from A-a to Z-z and numbers, length of 3 to 32 characters';
                $this->response['status'] = 'error';
                $this->response['field'] = '#register_password';
            } elseif ($verify == false) {
                $this->response['msg'] = 'invalid Captcha';
                $this->response['status'] = 'error';
                $this->response['field'] = '#register_captcha';
            } else {
                $checking = $this->check_username($username);
                if ($checking != 0) {
                    $this->response['msg'] = 'Username already taken. Please choose another one';
                    $this->response['status'] = 'error';
                    $this->response['field'] = '#register_username';
                } else {
                    if ($this->create_user($data) == true) {
                        $this->response['msg'] = 'Account created successfully';
                        $this->response['status'] = 'success';
                        $_SESSION['account'] = $username;
                    } else {
                        $this->response['msg'] = 'Something went wrong';
                        $this->response['status'] = 'error';
                        $this->response['field'] = 'All';
                    }

                }
            }
        } else {
            $this->response['msg'] = 'All field is required';
            $this->response['status'] = 'error';
            $this->response['field'] = 'All';
        }
        echo json_encode($this->response);
    }

    private function login()
    {
        $username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
        $check_login_data = $this->check_user_data($username, $password, null);
        $check_user = $this->check_username($username);
        if ($check_user == 0) {
            $this->response['status'] = 'error';
            $this->response['field'] = '#login_username';
            $this->response['msg'] = 'Username not found';

        } elseif ($check_login_data['password_check'] != 1) {
            $this->response['status'] = 'error';
            $this->response['field'] = '#login_password';
            $this->response['msg'] = 'Password not matching';

        } else {
            $_SESSION['account'] = $username;
            $_SESSION['uid'] = $this->get_user_by_name['UID'];
            $this->response['msg'] = 'Login Successful . You will be redirect in 1 second';
            $this->response['status'] = 'success';
        }
        echo json_encode($this->response);
    }

    
}

$app = new controller();
