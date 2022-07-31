<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="src/style.css"/>
</head>
<body>
<form method='POST'>
Put here you "n -- n+1" relations list<br/>
<textarea name='relations' rows=10>
Donald -- Picsou
Riri -- Donald
Fifi -- Donald
Loulou -- Donald
Zorro -- Picsou
</textarea>
<input type="submit" value="Draw me a beautiful orgchart">
</form>
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set("display_errors", 1);

include 'src/PHPtoOrgChart.php';

echo '<div class="orgchart ">';
if (isset($_POST['relations']))
    $data=$_POST['relations'];
else 
    $data=file_get_contents('data');
PHPtoOrgChart(get_data($data));
echo '</div>';

?>
</body>
</html>
