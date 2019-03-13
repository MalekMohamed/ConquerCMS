<?php

/**
 * Created by PhpStorm.
 * User: Veigar
 * Date: 1/31/2017
 * Time: 3:42 PM
 */
require '../../models/controllers/class.controller.php';
class Conquer extends controller
{
    private $resp = array();
    public function __construct()
    {
        if (isset($_SESSION['admin'])) {
            parent::__construct();
            if (isset($_GET['ticket'])) {
                switch ($_GET['ticket']) {
                    case 'reply-ticket':
                        $this->reply_ticket();
                        break;
                }
            } else {
                die();
            }
        }
    }
    private function reply_ticket()
    {
        session_start();
        if (isset($_SESSION['admin'])) {
            $ticketid = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $reply = filter_var($_POST['Reply'], FILTER_SANITIZE_STRING);
            $ticket = $this->view_ticket($ticketid);
            $error = '';
            if ($ticket[0] != 1) {
                $this->resp['msg'] = 'Ticket not found';
                $this->resp['status'] = 'error';
                $error .= '1';
            } elseif (empty($reply)) {
                $this->resp['msg'] = 'Please enter your reply';
                $this->resp['status'] = 'error';
                $error .= '1';
            }
            else  {
                $this->resp['msg'] = 'Reply Sent';
                $this->resp['status'] = 'success';
                $this->reply($ticketid, $_SESSION['admin'], $reply);
                $this->update_status($ticketid, 0);

            }
        } else {
            $this->resp['msg'] = 'You must be logged in to Do this function';
            $this->resp['status'] = 'error';
        }
        echo json_encode($this->resp);
    }
}
$tickets = new Conquer();