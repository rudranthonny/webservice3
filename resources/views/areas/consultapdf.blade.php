<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<!-- CSS only -->
<style>
    .head {
        background: black;
        color: white;
    }
    th {
        padding: 10px;
    }
    td {
    border: solid 1px;
    padding: 5px;
}
 
</style>
</head>
<body>
    <!--Titulo-->
    <center><h1>Boleta de Notas</h1>
    <!--Titulo-->
    @foreach (json_decode($consulta)->tables as $table2)
    @foreach ($table2->tabledata as $table)
    @isset($table->leader)
    <h2>{!!($table->itemname->content)!!} - {{$table2->userfullname}}</h2>
    @endisset   
    @endforeach
    @endforeach
    </center><hr>
    <center>
    <table width='100%'>
            <tr class="head">
                <th>Calificcación</th>
                <th>Notas</th>
            </tr>
    @foreach (json_decode($consulta)->tables as $table2)
    @foreach ($table2->tabledata as $table)
    @isset($table->grade)
    <tr>
        <td>{!!($table->itemname->content)!!}</td>
        <td>{{$table->grade->content}}</td>
    @endisset   
    </tr>
    @endforeach
    @endforeach
    </table>
</center>
</body>
</html>