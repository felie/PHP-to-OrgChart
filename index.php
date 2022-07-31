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

include 'src/PHPtoOrgChart.php';

echo '<div class="orgchart ">';
PHPtoOrgChart(get_data('data'));
echo '</div>';

?>
</body>
</html>
