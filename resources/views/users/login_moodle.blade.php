<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
    /*window.onload=function(){
                // Una vez cargada la página, el formulario se enviara automáticamente.
		document.forms["login_moodle"].submit();
    }*/
    </script>
</head>
<body>
    <form action="http://aprendiendo.jademlearning.com/login/index.php" id='login_moodle' name="login_moodle" class="mt-2" method="post">
                <input type="hidden" name="username" value="{{Auth::user()->dni}}">
                <input type="hidden" name="password" value="{{$contrasena}}">
                <button type="submit">Ingresa con...</button>
            </form>
</body>
</html>