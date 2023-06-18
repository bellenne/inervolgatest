<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="comments-list">
            <?
            // Подключение к БД и вывод данных
                $db = new PDO("mysql:host=localhost; dbname=intervolga_task3", "root", "");
                $db->exec("SET NAMES UTF8");
                $query = $db->prepare("SELECT * FROM `comments`");
                $query->execute();

                $comments = $query->fetchAll();

                foreach ($comments as $value) {
                    ?>
                        <div class="comment-item">
                            <h1 class="name"><?=$value["name"]?></h1>
                            <p class="comment"><?=$value["comment"]?></p>
                        </div>
                    <?
                }
            ?>
        </div>
        <form action="task3.php" method="POST">
            <div class="form-control">
                <label for="name">Имя</label><input name="name" type="text" placeholder="Напишите своё имя">
            </div>
            <div class="form-control">
                <label for="name">Коментарий</label><textarea name="comment" placeholder="Напишите свой коментарий"></textarea>
            </div>
            <div class="form-control"><input type="submit" value="Добавить коментарий"></div>
        </form>
    </div>
</body>
</html>