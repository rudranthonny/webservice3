<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCRAPPING WEB</title>
</head>
<body>
<?php
$description = 'nulo';
if(isset($_GET['btn'])):
    function file_get_contents_curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    function limpiarString($String){
        $String = str_replace(array("|","|","[","^","´","`","¨","~","]","'","#","{","}",".",""),"",$String);
        return $String;
    }
    $url 	=	$_GET['url'];
	$html 	= 	file_get_contents_curl($url);
    $doc 	= 	new DOMDocument();
    @$doc->loadHTML($html);
    $nodes 	= 	$doc->getElementsByTagName('title');
    $title 	= 	limpiarString($nodes->item(0)->nodeValue);

    $inputs 	= 	$doc->getElementsByTagName('input');
    foreach ($inputs as $key => $value) {
        if ($value->getAttribute('name') == 'logintoken') {
            var_dump($value->getAttribute('value'));
            break;
            echo "<br>";
        }
    }
else:
?>
<form>
    <h1>hackeando moodle</h1>
	<input type="url" name="url" placeholder="Ej. http://empresa.com" required style="width: 50%;">
	<button name="btn" type="submit">SCRAPEAR</button>
</form>
<?php endif; ?>
</body>
</html>
