<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="src/style.css"/>
</head>
<body>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set("display_errors", 1);

//demo
include 'src/PHPtoOrgChart.php';

/* partir de la liste des n+1 */


function get_data($file){
    $liste=file_get_contents($file);

    $relations=[];
    $liste=explode("\n",$liste);
    $top=explode(' -- ',$liste[0])[1];

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
    $relations=[$top => $relations["$top"]];

    return $relations;
}

echo '<div class="orgchart ">';
PHPtoOrgChart(get_data('data'));
echo '</div>';
?>
</body>
</html>
