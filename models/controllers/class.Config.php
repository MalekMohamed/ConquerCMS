<?php

/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 100050/11/2017
 * Time: 3:32 PM
 */
class Config extends PDO
{
    public $account_db = array("host" => "localhost", "user" => "root", "password" => "68426842", "db_name" => "acc",);
    public $files_url = '../../../../../Users/Strix/Desktop/gamedb/';
    public $reCaptcha = array(
        "enable" => false,
        "public_key" => "6Lc4rG4UAAAAAN8FHWn3LOIJTPUsmNl25e-Koq1r", // Site Key
        "secret_key" => "6Lc4rG4UAAAAADKuk6oL6lSPNkUiBC3ZnchCjN6F", // Secret Key
        "theme" => "dark" // Light or Dark
    );
    public $server_name = "WarForge";
    public $vote_link = "http://xtremetop100.com/in.php?site=1132357069";
    public $vote_reward = 10;
    public $voteRule = "ip";
    public $enableVote = true;
    public $game_port = 3306;
    public $rows = 25;
    public $kings = 5;
    public $prince = 15;
    public $Security_code = "admin";
    public $TimeZone = "Africa/Cairo";
    public $gm_state = 4;
    public $side_box_ranking = 'arena';
    public $Facebook = "https://www.facebook.com/Conquer.Hubs/";
    public $email = "mr.magic974@gmail.com";
    public $patch = "Patch";
    public $client = "Client";
    public $theme = "Darkmoon";
    public $status = "online_only";
    public $currency = "$";
    protected $account;

    public function server_status()
    {
        $fp = @fsockopen($this->game_db['host'], $this->game_port, $errno, $errstr, 1);
        if (!$fp) {
            $status = '<span style="color: red">Offline</span>';
        } else {

            $status = '<span style="color: lime">Online</span>';
            fclose($fp);
        }
        return $status;
    }

    public function BASE_URL($link)
    {
        /* if you Put the WebSite Files in a Folder inside your WWW Folder or Htdoc Folder Put the folder name Here
                                                ?             */
        return 'http://' . $_SERVER['HTTP_HOST'] . '/ConquerCMS/' . $link;

    }

    public function Close_connection()
    {
        $this->account = NULL;
        $this->game = NULL;
        echo '<script type="application/javascript">';
        echo 'console.log(\'connection Ended\')';
        echo '</script>';
    }

    public function __construct($connection = true)
    {
        if ($connection != null) {
            $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
            $account_dsn = 'mysql:host=' . $this->account_db['host'] . ';dbname=' . $this->account_db['db_name'] . '';
            try {
                $this->account = new PDO($account_dsn, $this->account_db['user'], $this->account_db['password'], $option);
                $this->account->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->account->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                die('<pre>Failed To Connect To Account Database Error -> ' . $e->getMessage() . ' ' . print_r(PDO::getAvailableDrivers()) . ' ' . phpversion() . '</pre>');
            }
        }
        //$this->account = null;
        date_default_timezone_set($this->TimeZone);
    }

    public function select($conn, $table, $fields, $where, $data)
    {
        if ($where == '' || empty($where)) {
            $cond = '';
            $data = '';
        } elseif (!is_array($where)) {
            $cond = '';
        } else {
            $cond = 'WHERE';
            $where = $this->where($where);
        }
        $query = $conn->prepare("SELECT $fields FROM $table $cond $where", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        if (!is_array($data)) {
            $query->execute(array($data));
        } else {
            $query->execute($data);
        }
        return $query;
    }

    private function where($where)
    {
        if (is_array($where)) {
            if (count($where) > 1) {
                $where = implode(" AND ", $where);
            } else {
                $where = implode('', $where);
            }
        }
        return $where;
    }

    public function rebuild_database()
    {
        //  Remove Old tables
        $tables = array('posts', 'comments', 'tickets', 'tickets_replys', 'store', 'votes');
        foreach ($tables as $table) {
            $result = $this->account->prepare("DROP TABLE IF EXISTS $table");
            $result->execute();
        }
        $news_table = $this->account->exec("CREATE TABLE IF NOT EXISTS posts (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        title VARCHAR(30) NOT NULL,
        post TEXT NOT NULL,
        user VARCHAR(30) NOT NULL,
        date VARCHAR(30) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
        $comments_table = $this->account->exec("CREATE TABLE IF NOT EXISTS comments (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        post_id INT(30) NOT NULL,
        comment text(0) NOT NULL,
        user VARCHAR(30) NOT NULL,
        date VARCHAR(30) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");

        $tickets_table = $this->account->exec("CREATE TABLE IF NOT EXISTS tickets (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        title VARCHAR(50) NOT NULL ,
        category VARCHAR (50) NOT NULL,
        problem text(0) NOT NULL,
        User VARCHAR(30) NOT NULL,
        time VARCHAR(30) NOT NULL,
        Status INT (1) NOT NULL ,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
        $reply_table = $this->account->exec("CREATE TABLE IF NOT EXISTS tickets_replys (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        ticketid INT (5) NOT NULL ,
        reply text(0) NOT NULL,
        user VARCHAR(30) NOT NULL,
        date VARCHAR(30) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
        $store_table = $this->account->exec("CREATE TABLE IF NOT EXISTS store (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        Name VARCHAR(30) NOT NULL,
        price float(10,2) NOT NULL,
        paypal_key varchar(50) NOT NULL,
        image VARCHAR(30) NOT NULL DEFAULT 'default.png',
        description text(0) NOT NULL,
        PRIMARY KEY(id,Name)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
        $vote = $this->account->exec("CREATE TABLE IF NOT EXISTS votes (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        user VARCHAR(30) NOT NULL,
        ip_address varchar(150) NOT NULL,
        time varchar(50) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
        return true;
    }
}
