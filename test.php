
<?php
require_once('modules.php');
$ope = new DB_Operations();
?>

<html lang="ja">
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <style type="text/css">
        body {
            font-family: "Hiragino Kaku Gothic ProN", "メイリオ", sans-serif;
        }
    </style>
</head>

<body>
    <h1 class="page-header">test for insert</h1>
        <form action="insert_test.php" method="post">
            名前<br>
            <input type="text" name="name"><br>
            内容<br>
            <textarea name="content" rows="6" cols="50"></textarea><br>
            時刻<br>
            <input type="datetime-local" name="time"><br>
            パスワード<br>
            <input type="password" name="password"><br>
            <input type="submit" value="投稿">
        </form>

    <h1 class="page-header">test for delete</h1>
    <?php
        $stmt = $ope->db->prepare("SELECT * from post");
        $stmt->execute();
        $result = $stmt->get_result()
    ?>

    <table border=\"1\">
        <tr><th>名前</th><th>コンテンツ</th><th>時刻</th><th>パスワード入力</th></tr>
                <?php while ($row = $result->fetch_assoc()):?>
                    <?php
                    $name = htmlspecialchars($row['name']);
                    $content = htmlspecialchars($row['content']);
                    //$content = $row['content'];
                    $time = htmlspecialchars($row['time']);
                    $password = htmlspecialchars($row['password']);
                    ?>
                        <tr>
                            <td><?php echo $name?></td>
                            <td><?php echo $content?></td>
                            <td><?php echo $time?></td>
                            <form action = "delete_test.php" method = "get">
                                <input type="hidden" name="name" value="<?php echo $name; ?>">
                                <td><input type="text" name="password"></td>
                                <td><input type="submit" value="削除"></td>
                            </form>

                        </tr>
                <?php endwhile; ?>
    </table>

    <h1 class="page-header">test for search</h1>
    <form action="search_test.php" method="get">
        名前<br>
        <input type="text" name="name"><br>
        内容<br>
        <textarea name="content" rows="6" cols="50"></textarea><br>
        <!--
        時刻<br>
        <input type="datetime-local" name="time_from"> ~  <input type="datetime-local" name="time_to"><br>
        -->
        <input type="submit" value ="検索">
    </form>

    <script type="text/javascript">
        <!--
        function myEnter(){
            myPassWord=prompt("パスワードを入力してください","");
            if ( myPassWord == "pass1" ){
                location.href="secret.html";
            }else{
                alert( "パスワードが違います!" );
            }
        }
        // -->
    </script>
</body>
</html>
