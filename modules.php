<?php

/* データベースのコンフィギュレーション */
class Configuration{
    public static function configure(){
        define("DB_HOST", "localhost"); //DBサーバー立てる場合はip変更
        define("DB_USER", "root");
        define("DB_PASSWORD", "root");
        define("DB_DATABASE", "board");
    }
}

/* データベースに対するコネクター */
class DB_Connector{
    private $conn;

    public function connect()
    {
        Configuration::configure();
        $this->conn = new mysqli(DB_HOST,  DB_USER, DB_PASSWORD, DB_DATABASE);
        if($this->conn->connect_error) {
            error_log($this->conn->connect_error);
            echo "error";
            exit;
        }
        return $this->conn;
    }
}

/* データベースに対するオペレーション */
class DB_Operations
{
    public $db;

    function __construct()
    {

        $conn = new DB_Connector();
        $this->db = $conn->connect();

    }

    function __destruct()
    {
        //TODO ; Implement __destruct() method.
    }

    /* 挿入(書き込み機能) */
    public function insert()
    {
        $name = $_POST['name'];
        $content = $_POST['content'];
        $time = $_POST['time'];
        $password = $_POST['password'];

        $stmt = $this->db->prepare("INSERT INTO post(name, content, time, password) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $name, $content, $time, $password);

        $result = $stmt->execute();
        $stmt->close();
    }

    /* 削除 */
    public function delete()
    {
        $name = $_GET["name"];
        $password = $_GET["password"];
        echo $name;
        echo $password;
        $stmt = $this->db->prepare("DELETE FROM post WHERE name=? and password=?");
        $stmt->bind_param("ss", $name, $password);
        $stmt->execute();
    }

    /* 検索 */
    public function search()
    {
        $cond_list = [];
        if (!empty($_GET['name'])) {
            $cond_list[] = "name like '%{$_GET['name']}%'";
        }
        if (!empty($_GET['content'])) {
            $cond_list[] = "content like '%{$_GET['content']}%'";
        }
        if (!empty($_GET['time_from']) && !empty($_GET['time_to']) && $_GET['time_from'] < $_GET['time_to']) {
            $cond_list[] = 'time BETWEEN ' . ($_GET['time_from']) . ' AND ' . $_GET['time_to'];
        }
        if ($cond_list) {
            $condition = implode(' AND ', $cond_list);
            echo $condition;
            $sql = 'SELECT * FROM post WHERE ' . $condition;
        } else {
            $sql = 'SELECT * FROM post';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;

    }
}
