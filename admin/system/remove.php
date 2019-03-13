<?php
/**
 * Created by PhpStorm.
 * User: Veigar
 * Date: 1/30/2017
 * Time: 7:41 PM
 */
require('../../models/controllers/class.controller.php');

class remove extends controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['admin'])) {
            if (!isset($_GET['remove'])) {
                die();
            } else {
                switch ($_GET['remove']) {
                    case "user":
                        $this->remove_user();
                        break;
                    case "post":
                        $this->remove_post();
                        break;
                    case "item":
                        $this->remove_item();
                        break;
                    case "char":
                        $this->remove_character();
                        break;
                    case "ticket":
                        $this->remove_ticket();
                        break;
                    case "comment":
                        $this->remove_comment();
                        break;
                    case "log":
                        $this->removeLog();
                        break;
                }
            }
        }
    }

    private function removeLog()
    {
        $file = $_POST['file'];
        $files = array(
          'Votes' => 'votes',
          'Admin' => 'admin',
        );
        if(file_put_contents('../logs/'.$files[$file].'-log.txt',' ') == 1) {
            $response['msg'] = 'Log Cleared';
            $response['status'] = 'success';
        } else {
            $response['msg'] = 'Something went wrong';
            $response['status'] = 'error';
        }
        echo json_encode($response);
    }

    private function remove_item()
    {
        $query = $this->game->prepare("DELETE FROM store WHERE id = ? ");
        if ($query->execute(array($_POST['id']))) {
            die ('1');
        }
    }

    private function remove_post()
    {
        $query = $this->game->prepare("DELETE FROM posts WHERE id = ? ");
        if ($query->execute(array($_POST['id']))) {
            die ('1');
        }
    }

    private function remove_comment()
    {
        $query = $this->game->prepare("DELETE FROM comments WHERE id = ? ");
        if ($query->execute(array($_POST['id']))) {
            die ('1');
        }
    }

    private function remove_ticket()
    {
        $this->update_status($_POST['id'], 3);
        die ('1');
    }

    private function remove_user()
    {
        $query = $this->account->prepare("DELETE FROM accounts WHERE Username = ? ");
        if ($query->execute(array($_POST['user']))) {
            die ('1');
        }
    }

    private function remove_character()
    {
        $query = $this->game->prepare("DELETE FROM entities WHERE Owner = ? AND Name = ?");
        $query2 = $this->account->prepare("UPDATE $this->account_table SET EntityID = 0 WHERE Username = ? ");
        if ($query->execute(array($_POST['user'], $_POST['char'])) && $query2->execute(array($_POST['user']))) {
            die ('1');
        } else {
            die('Error');
        }

    }
}

$remove = new remove();
