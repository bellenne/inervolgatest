<?
// Подключение к БД

$db = new PDO("mysql:host=localhost; dbname=intervolga_task2","root","");
$db->exec("SET NAMES UTF8");

removeFromTable($db, ["categories","products","category_id"]);
removeFromTable($db, ["products","availabilities","product_id"]);
removeFromTable($db, ["stocks","availabilities","stock_id"]);
// Функция для удаления не использующихся записей
function removeFromTable($db, $params=[]){
    // Выбираю те значения которых нет в таблице
    try {
        $query = $db->prepare("SELECT `id` FROM $params[0] WHERE `id` NOT IN (SELECT $params[2] FROM $params[1])");
        $query->execute();
    
        $removeId = $query->fetchAll();
        // Перебераю массив который получил после запроса и удаляю эти данные
        foreach ($removeId as $key) {
            $query = $db->prepare("DELETE FROM ".$params[0]." WHERE `id` = ".$key["id"]);
        }

        echo "Таблица $params[0] базы данных очищена!<br>";
    } catch (PDOException $th) {
        echo "Ошибка в запросе базы данных";
    }
}