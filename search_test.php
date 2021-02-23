<?php
include_once('modules.php');

$ope = new DB_Operations();
$result = $ope->search();
?>

<html lang="ja">
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>

<body>
<h1>検索結果</h1>
<table border=\"1\">
    <tr><th>名前</th><th>コンテンツ</th><th>時刻</th></tr>
            <?php while ($row = $result->fetch_assoc()):?>
                <?php
                $name = htmlspecialchars($row['name']);
                $content = htmlspecialchars($row['content']);
                $time = htmlspecialchars($row['time']);
                ?>
                    <tr>
                        <td><?php echo $name?></td>
                        <td><?php echo $content?></td>
                        <td><?php echo $time?></td>
                    </tr>
            <?php endwhile; ?>
</table>
</body>

</html>
