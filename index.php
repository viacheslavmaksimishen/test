<html>
<head>
    <title>Отчет</title>
    <meta content="text/html; charset=utf8" http-equiv="Content-Type">
</head>
<body>
<table>
    <tr>
        <th>Марка автомобиля</th>
        <th>Государственный номер</th>
        <th>Тип (легковой / грузовой)</th>
        <th>ФИО водителя</th>
        <th>Марка топлива</th>
        <th>Средний расход топлива</th>
        <th>Показання одометра на конец предыдущего месяца</th>
        <th>Показання одометра на конец текущего месяца</th>

    </tr>
    <tbody>
    <?php
    $connect = mysqli_connect('localhost', 'root');
    if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $select_db = mysqli_select_db($connect, "carsdb");
    mysqli_query($connect, "SET NAMES utf8");
    $select = mysqli_query($connect, "
      SELECT c.Mark,c.Number,c.Type, f.Mark as Fuelid,CONCAT(d.Surname, ' ', d.Name, ' ', d.Patronymic) as Name,
	  c.AverageConsumption,c.OdometerPreviousMonth, c.OdometerCurrentMonth  
	  FROM  Car c LEFT JOIN Fuel f ON c.FuelId = f.Id LEFT JOIN Driver d ON c.DriverId = d.Id
"

    ) or trigger_error(mysqli_error($connect));
    while ($row = mysqli_fetch_array($select)) {

        echo "<tr>
<td>" . $row['Mark'] . "</td>
<td>" . $row['Number'] . "</td>
<td>" . $row['Type'] . "</td>
<td>" . $row['Name'] . "</td>
<td>" . $row['Fuelid'] . "</td>
<td>" . $row['AverageConsumption'] . "</td>
<td>" . $row['OdometerPreviousMonth'] . "</td>
<td>" . $row['OdometerCurrentMonth'] . "</td>

</tr>";
    }

    mysqli_close($connect);
    ?>
    </tbody>
</table>
</body>
</html>
 
 


