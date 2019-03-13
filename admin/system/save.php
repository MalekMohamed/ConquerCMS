<?php
/**
 * Created by PhpStorm.
 * User: Veigar
 * Date: 1/30/2017
 * Time: 5:20 PM
 */

require('../../models/controllers/class.controller.php');

class Save extends controller
{
    const MYSQL_DEFAULT_PORT = 3306;

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['admin'])) {
            if (!isset($_GET['save'])) {
                die();
            } else {
                switch ($_GET['save']) {
                    case "add_item":
                        $this->add_store_item();
                        break;
                    case "settings":
                        $this->save_site();
                        break;
                    case "rewriteConfig":
                        $this->rewriteConfig();
                        break;
                    case "theme":
                        $this->change_theme();
                        break;
                    case "add-post":
                        $this->add_post();
                        break;
                    case "post":
                        $this->save_post();
                        break;
                    case "comment":
                        $this->save_comment();
                        break;
                    case "check-database":
                        $this->check_database();
                        break;
                    case "rebuild-database":
                        $this->rebuild_db();
                        break;
                }
            }
        }
    }

    private function rewriteConfig()
    {
        $original = file_get_contents('https://raw.githubusercontent.com/MalekMohamed/ConquerCMS/master/models/controllers/class.Config.php');
        $exists = '../../models/controllers/class.Config.php';
        if (file_put_contents($exists, $original)) {
            $response['msg'] = 'Config rebuilt successfully';
            $response['status'] = 'success';
        } else {
            $response['msg'] = 'Something went wrong';
            $response['status'] = 'error';
        }
        echo json_encode($response);
    }

    private function change_theme()
    {
        $file = '../../models/controllers/class.Config.php';
        $find = array('public $theme = "' . $this->theme . '"');
        $replace = array('public $theme = "' . $_POST['theme'] . '"');
        $contents = file_get_contents($file);
        $content = str_replace($find, $replace, $contents);
        if (file_put_contents($file, $content)) {
            $response['msg'] = 'Saved';
            $response['status'] = 'success';

        } else {
            $response['msg'] = 'Something went wrong';
            $response['status'] = 'error';
        }
        echo json_encode($response);
    }

    private function save_site()
    {

        $file = '../../models/controllers/class.Config.php';
        if ($this->reCaptcha['enable'] == false) {
            $old = addslashes('false');
        } else {
            $old = addslashes('true');
        }
        if ($this->enableVote == false) {
            $enable_old = addslashes('false');
        } else {
            $enable_old = addslashes('true');
        }
        $find = array(
            'public $voteRule = "' . $this->voteRule . '"',
            'public $enableVote = ' . $enable_old . '',
            'public $TimeZone = "' . $this->TimeZone . '"',
            'public $kings = ' . $this->kings . '',
            'public $prince = ' . $this->prince . '',
            'public $server_name = "' . $this->server_name . '"',
            'public $vote_link = "' . $this->vote_link . '"',
            'public $vote_reward = ' . $this->vote_reward . '',
            'public $game_port = ' . $this->game_port . '',
            'public $rows = ' . $this->rows . '',
            'public $Security_code = "' . $this->Security_code . '"',
            'public $gm_state = ' . $this->gm_state . '',
            'public $Facebook = "' . $this->Facebook . '"',
            'public $patch = "' . $this->patch . '"',
            'public $client = "' . $this->client . '"',
            'public $email = "' . $this->email . '"',
            'public $status = "' . $this->status . '"',
            '"enable" => ' . $old . '',
            '"public_key" => "' . $this->reCaptcha['public_key'] . '"',
            '"secret_key" => "' . $this->reCaptcha['secret_key'] . '"',
            '"theme" => "' . $this->reCaptcha['theme'] . '"',
        );
        $replace = array(
            'public $voteRule = "' . $_POST['site']['voteRule'] . '"',
            'public $enableVote = ' . addslashes($_POST['site']['enableVote']) . '',
            'public $TimeZone = "' . $_POST['site']['timezone'] . '"',
            'public $kings = ' . $_POST['site']['kings'] . '',
            'public $prince = ' . $_POST['site']['prince'] . '',
            'public $server_name = "' . $_POST['site']['Servername'] . '"',
            'public $vote_link = "' . $_POST['site']['Vote_link'] . '"',
            'public $vote_reward = ' . $_POST['site']['vote_reward'] . '',
            'public $game_port = ' . $_POST['site']['game_port'] . '',
            'public $rows = ' . $_POST['site']['rows'] . '',
            'public $Security_code = "' . $_POST['site']['Security_code'] . '"',
            'public $gm_state = ' . $_POST['site']['gm_state'] . '',
            'public $Facebook = "' . $_POST['Social']['Facebook'] . '"',
            'public $patch = "' . $_POST['downloads']['Patch'] . '"',
            'public $client = "' . $_POST['downloads']['Client'] . '"',
            'public $email = "' . $_POST['site']['Support_mail'] . '"',
            'public $status = "' . $_POST['site']['status'] . '"',
            '"enable" => ' . addslashes($_POST['recaptcha']['enable']) . '',
            '"public_key" => "' . $_POST['recaptcha']['public'] . '"',
            '"secret_key" => "' . $_POST['recaptcha']['secret'] . '"',
            '"theme" => "' . $_POST['recaptcha']['theme'] . '"',
        );
        $contents = file_get_contents($file);
        $content = str_replace($find, $replace, $contents);
        if (file_put_contents($file, $content)) {
            $response['msg'] = 'Saved';
            $response['status'] = 'success';

        } else {
            $response['msg'] = 'Something went wrong';
            $response['status'] = 'error';
        }
        echo json_encode($response);
    }

    private function add_post()
    {
        session_start();
        $title = $_POST['title'];
        $arr = array('
                        ', '                            ');
        $desc = str_replace($arr, '', $_POST['desc']);
        $date = date("d-M-Y h:i a");
        $query = $this->account->prepare("INSERT INTO posts (title,post,user,date) VALUES (
                                                                    :title,
                                                                    :post,
                                                                    :user,
                                                                    :date
                                                                    ) ");
        if ($query->execute(array('title' => $title, 'post' => $desc, 'user' => $_SESSION['admin'], 'date' => $date))) {
            echo '1';
        } else {
            echo '0' . var_dump($_POST);
        }
    }

    private function add_store_item()
    {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $image = $_FILES['image'];
        if (!empty($image['name'])) {
            $image_name = $image['name'];
        } else {
            $image_name = 'default.png';
        }
        $query = $this->account->prepare("INSERT INTO store (Name, price, image,description) VALUES (
                                                                                              :name,
                                                                                              :price,
                                                                                              :image,
                                                                                              :desc
                                                                                          ) ");
        if ($query->execute(array('name' => $name, 'price' => $price, 'image' => $image_name, 'desc' => $desc))) {
            if ($image_name != 'default.png') {
                move_uploaded_file($image['tmp_name'], __DIR__ . '/../../public/img/store/' . $image_name);
            }
            echo '1';
        } else {
            echo '0';
        }
    }

    private function save_post()
    {
        $post_id = $_POST['id'];
        $title = $_POST['title'];
        $arr = array('
                        ', '                            ');
        $post = str_replace($arr, '', $_POST['desc']);
        $date = date("d-M-Y h:i a");
        $check_post = $this->get_post_by_id($post_id);
        if ($check_post[0] != 0) {
            $update = $this->account->prepare("UPDATE posts SET title = ? , post = ? , date = ? WHERE id = ?");
            if ($update->execute(array($title, $post, $date, $post_id))) {
                die('1');
            } else {
                die('0');
            }
        }
    }

    private function save_comment()
    {
        $comment_id = $_POST['id'];
        $comment = $_POST['comment'];
        $date = date("d-M-Y h:i a");

        $update = $this->account->prepare("UPDATE comments SET comment = ? , date = ?  WHERE id = ?");
        if ($update->execute(array($comment, $date, $comment_id))) {
            die('1');
        } else {
            die('0');
        }
    }

    private function check_database()
    {

        $tables = array('posts', 'comments', 'tickets', 'tickets_replys', 'store','votes');
        foreach ($tables as $table) {
            $resp[$table] = array();
            $result = $this->account->query("SHOW TABLES LIKE '" . $table . "'");
            if ($result->rowCount() != 0) {
                $resp[$table]['msg'] = '<span class="text-success">-> <i class="fa fa-check"></i> Table [ <a>' . $table . ' </a> ] Found.</span><br>';
                $resp[$table]['status'] = 'success';
            } else {
                $resp[$table]['msg'] = '<span class="text-danger">-> <i class="fa fa-times"></i> Table [ <a>' . $table . ' </a> ] Not Found.</span> <br>';
                $resp[$table]['status'] = 'error';
            }

        }
        echo json_encode($resp);
    }

    private function rebuild_db()
    {
        echo '<span class="text-success">-> <i class="fa fa-check"></i> Old Tables Removed</span><br>';
        if ($this->rebuild_database() == true) {
            echo '<span class="text-success">-> <i class="fa fa-check"></i> Database rebuilded successfully</span>';
        }
    }
}

$save = new Save();
