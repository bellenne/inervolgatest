<?
$data = [
	['Иванов', 'Математика', 5],
	['Иванов', 'Математика', 4],
	['Иванов', 'Математика', 5],
	['Петров', 'Математика', 5],
	['Сидоров', 'Физика', 4],
	['Иванов', 'Физика', 4],
	['Петров', 'ОБЖ', 4],
];
$result = []; // Массив для результата
$lessens_list = []; // Массив для предметов
foreach ($data as $key => $value) { //Перебераем массив дата
    if($key == 0){ // Если ключ массива 0 то добавим первую запись в массив результата и в массив урока
        $result = [$value[0] => [$value[1]=>$value[2]]];
        array_push($lessens_list, $value[1]);
    }
    else{ // Если ключ отличный от 0 то перебераем массив результата
        foreach ($result as $key_res => $value_res) {
            if(isset($result[$value[0]][$value[1]])){ //Если в массиве результата есть запись с именем и предметом массива data то прибавим баллы и выйдем из цикла 
                $result[$value[0]][$value[1]] += $value[2];
                break;
            }
            else{ //Если нет такого предмета, то проверяем есть ли в массиве такой ученик
                if(isset($result[$value[0]])){ //Если такой ученик есть, то добавим к нему предмет и оценку и выйдем из цикла
                    array_push($lessens_list, $value[1]);
                    $result[$value[0]] += [$value[1]=>$value[2]];
                    break;
                }else{ //Если такого ученика нет, то тогда добавляем новую запись с учеником предмотом и оценкой, а так же выходим из цикла
                    array_push($lessens_list, $value[1]);
                    $result += [$value[0] => [$value[1]=>$value[2]]];
                    break;
                }
            }
        }
    }
}
// Делаем массив уникальным (убираем дубли)
$lessens_list = array_unique($lessens_list);
asort($lessens_list); //Сортируем по алфавиту
foreach ($result as $key => $value) { //Перебераем массив результата и сравниваем массив предметов для каждого ученика, добавляем тот предмет которого нет 
    $lessensNull = array_flip(array_diff_key(array_flip($lessens_list),$value));
    foreach ($lessensNull as $key_lessens) {
        $result[$key] += [$key_lessens => null];
    }
    ksort($result[$key]); //Сортируем уроки по алфавиту
}
?>
<style>
    table,td{
    border: 1px black solid;
    border-collapse: collapse;
    padding: 10px;}
</style>
<table>
    <tr>
        <td></td>
        <?
            foreach ($lessens_list as $key => $value) { //Выводим предметы 
                echo "<td>$value</td>";
            }
        ?>
    </tr>
    <?
        foreach ($result as $key => $value) {
            echo "<tr><td>$key</td>"; //Выводим фамилию ученика
            foreach ($value as $keys => $values) {
                echo "<td>$values</td>"; // Выводим оценки
            }
            echo "</tr>";
        }
    ?>
</table>