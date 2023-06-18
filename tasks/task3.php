<?
    if(isset($_POST['name']) && isset($_POST["comment"])){ //Проверяем есть ли в массиве POST name и comment
        // Кодируем html теги в спец. символы и создаём массив параметров для подготовленного запоса
        $name = htmlspecialchars(trim($_POST['name']));
        $comment = htmlspecialchars(trim($_POST['comment']));
        $params = ["name"=> $name, "comment" => $comment];
     
        // Подключаемся к бд и устанавливаем кодировку
        $db = new PDO("mysql:host=localhost; dbname=intervolga_task3", "root", "");
        $db->exec("SET NAMES UTF8");
        try {
            //Подготавливаем запрос и вставляем в него массив с параметрами 
            $query = $db->prepare("INSERT INTO `comments` (`id`,`name`,`comment`) VALUES(null, :name, :comment)");        
            $query->execute($params);
        } catch (PDOException $th) {
            echo "Ошибка в запросе к базе данных";
        }

    }
    header("Location: task3Main.php");