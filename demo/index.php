<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="../src/style.css"/>
</head>
<body>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set("display_errors", 1);

//demo
include '../src/PHPtoOrgChart.php';

/* partir de la liste des n+1 */


$liste=file_get_contents('data');

$relations=[];
$liste=explode("\n",$liste);
foreach($liste as $key => &$value){
    $r=explode(' -- ',$value);
    $relations[$r[1]][].=$r[0]; 
    }
    
function find_place(&$item,$key,&$element){
    if(($item)==$element[0])
        $item=[$item => $element[1]];
}

foreach($relations as $sub => $man)
    array_walk_recursive($relations,'find_place',[$sub,$man]); // place the table in depth
$relations=['CEO' => $relations['CEO']];

$data=$relations;

echo '<div class="orgchart ">';
PHPtoOrgChart($data);
echo '</div>';
?>
</body>
</html>
