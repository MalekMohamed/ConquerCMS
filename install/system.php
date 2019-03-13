<?php

class Install extends PDO
{

    const MYSQL_DEFAULT_PORT = 3306;

    public function __construct()
    {
        if (!isset($_GET['step'])) {
            die();
        } else {
            switch ($_GET['step']) {
                case "config":
                    $this->config();
                    break;
                case "database":
                    $this->database();
                    break;
                case "checkPhpExtensions":
                    $this->checkPhpExtensions();
                    break;
                case "checkApacheModules":
                    $this->checkApacheModules();
                    break;
                case "checkPhpVersion":
                    $this->checkPhpVersion();
                    break;
                case "checkDbConnection":
                    $this->checkDbConnection();
                    break;
                case "final":
                    $this->finalStep();
                    break;
                case "getEmulators":
                    $this->getEmulators();
                    break;
            }
        }
    }

    private function getEmulators()
    {

        die('System Created By Malek Mohamed');
    }


    private function checkPhpExtensions()
    {
        $req = array('mysqli', 'curl', 'json', 'pdo_mysql');
        $loaded = get_loaded_extensions();
        $errors = array();

        foreach ($req as $ext)
            if (!in_array($ext, $loaded))
                $errors[] = $ext;

        die($errors ? join(', ', $errors) : '1');
    }

    private function checkApacheModules()
    {
        $req = array('mod_rewrite');
        $loaded = function_exists('apache_get_modules') ? apache_get_modules() : array();
        $errors = array();

        foreach ($req as $ext)
            if (!in_array($ext, $loaded))
                $errors[] = $ext;

        die($errors ? join(', ', $errors) : '1');
    }

    private function checkPhpVersion()
    {
        die(version_compare(PHP_VERSION, '5.3', '>=') ? '1' : '0');
    }

    private function checkDbConnection()
    {

        $req = array('hostname', 'username', 'database');

        foreach ($req as $var) {
            if (!isset($_POST[$var]) || empty($_POST[$var]))
                die('Please fill all fields.');
        }
        $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
        $game_dsn = 'mysql:host=' . $_POST['hostname'] . ';dbname=' . $_POST['database'] . '';

        try {
            @$db = new PDO($game_dsn, $_POST['username'], $_POST['password'], $option);
            $db = new PDO($game_dsn, $_POST['username'], $_POST['password'], $option);

            //  Remove Old tables
            $tables = array('posts', 'comments', 'tickets', 'tickets_replys', 'store', 'votes');
            foreach ($tables as $table) {
                $result = $db->prepare("DROP TABLE IF EXISTS $table");
                $result->execute();
            }
            $news_table = $db->exec("CREATE TABLE IF NOT EXISTS posts (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        title VARCHAR(30) NOT NULL,
        post TEXT NOT NULL,
        user VARCHAR(30) NOT NULL,
        date VARCHAR(30) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
            $comments_table = $db->exec("CREATE TABLE IF NOT EXISTS comments (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        post_id INT(30) NOT NULL,
        comment text(0) NOT NULL,
        user VARCHAR(30) NOT NULL,
        date VARCHAR(30) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");

            $tickets_table = $db->exec("CREATE TABLE IF NOT EXISTS tickets (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        title VARCHAR(50) NOT NULL ,
        category VARCHAR (50) NOT NULL,
        problem text(0) NOT NULL,
        User VARCHAR(30) NOT NULL,
        time VARCHAR(30) NOT NULL,
        Status INT (1) NOT NULL ,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
            $reply_table = $db->exec("CREATE TABLE IF NOT EXISTS tickets_replys (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        ticketid INT (5) NOT NULL ,
        reply text(0) NOT NULL,
        user VARCHAR(30) NOT NULL,
        date VARCHAR(30) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
            $store_table = $db->exec("CREATE TABLE IF NOT EXISTS store (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        Name VARCHAR(30) NOT NULL,
        price float(10,2) NOT NULL,
        paypal_key varchar(50) NOT NULL,
        image VARCHAR(30) NOT NULL DEFAULT 'default.png',
        description text(0) NOT NULL,
        PRIMARY KEY(id,Name)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
            $vote = $db->exec("CREATE TABLE IF NOT EXISTS votes (
        id INT(11) UNSIGNED AUTO_INCREMENT,
        user VARCHAR(30) NOT NULL,
        ip_address varchar(150) NOT NULL,
        time varchar(50) NOT NULL,
        PRIMARY KEY(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ");
            die('1');
        } catch (PDOException $e) {
            var_dump($_POST);
            die($e->getMessage() ? $e->getMessage() : '1');
        }

    }

// Write Config
    private function config()
    {

        require('../models/controllers/class.config.php');
        $class_config = new Config(null);
        $file = '../models/controllers/class.config.php';
        $find = array(
            'public $rows = ' . $class_config->rows . '',
            'public $game_port = ' . $class_config->game_port . '',
            'public $Security_code = "' . $class_config->Security_code . '"',
            'public $server_name = "' . $class_config->server_name . '"',
            'public $gm_state = ' . $class_config->gm_state . '',
            'public $kings = ' . $class_config->kings . '',
            'public $prince = ' . $class_config->prince . '',
            'public $account_db = array("host" => "' . $class_config->account_db['host'] . '", "user" => "' . $class_config->account_db['user'] . '", "password" => "' . $class_config->account_db['password'] . '", "db_name" => "' . $class_config->account_db['db_name'] . '",)',
            'public $game_db = array("host" => "' . $class_config->game_db['host'] . '", "user" => "' . $class_config->game_db['user'] . '", "password" => "' . $class_config->game_db['password'] . '", "db_name" => "' . $class_config->game_db['db_name'] . '",)',
        );
        $replace = array(
            'public $rows = ' . $_POST['rows'] . '',
            'public $game_port = ' . $_POST['cms_port'] . '',
            'public $Security_code = "' . $_POST['security_code'] . '"',
            'public $server_name = "' . $_POST['server_name'] . '"',
            'public $gm_state = ' . $_POST['state'] . '',
            'public $kings = ' . $_POST['kings'] . '',
            'public $prince = ' . $_POST['prince'] . '',
            'public $account_db = array("host" => "' . $_POST['cms_hostname'] . '", "user" => "' . $_POST['cms_username'] . '", "password" => "' . $_POST['cms_password'] . '", "db_name" => "' . $_POST['cms_database'] . '",)',
            'public $game_db = array("host" => "' . $_POST['game_hostname'] . '", "user" => "' . $_POST['game_username'] . '", "password" => "' . $_POST['game_password'] . '", "db_name" => "' . $_POST['game_database'] . '",)',
        );
        $contents = file_get_contents($file);
        $content = str_replace($find, $replace, $contents);
        if (file_put_contents($file, $content)) {
            die('1');
        } else {
            die(0);
        }
    }

    private function database()
    {
        require('../models/controllers/class.config.php');
        $class_config = new Config(true);

        $db = $class_config->rebuild_database();

        if ($db == 1) {
            die('1');
        } else {
            die('Failed to Create Database');
        }

    }


    private function finalStep()
    {

        $file = fopen('.lock', 'w');
        fclose($file);

        if (file_exists(".lock")) {
            die('success');
        }

    }
}

$install = new Install();
