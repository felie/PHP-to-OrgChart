<?php
/* Licenced GPLv2
   Awesome see https://github.com/Awezome/PHP-to-OrgChart
   felie francois@elie.org 2022 
*/
    function get_data($file){
        $liste=file_get_contents($file);

        $relations=[];
        $liste=explode("\n",$liste);
        $top=explode(' -- ',$liste[0])[1];

        foreach($liste as $key => &$value){
            $r=explode(' -- ',$value);
            $relations[$r[1]][].=$r[0]; 
            }
            
        function find_place(&$item,$key,$element){
            if(($item)==$element[0])
                $item=[$item => $element[1]];
        }

        foreach($relations as $sub => $man)
            array_walk_recursive($relations,'find_place',[$sub,$man]); // place the table in depth
        // keep first node only
        $relations=[$top => $relations["$top"]];

        return $relations;
    }
    
    function PHPtoOrgChart(array $arr,$title='') {
        // replace terminal tree by blocs of cells (felie)
        $bloc=true;
        $bl=[];
        foreach($arr as $e){
            if (!is_string($e))
                $bloc=false;
            else
                $bl[].=$e;
            }
        if ($bloc){
            echo '<table><tr><td><div class="charttext">'.$title.'</div></td></tr>';
            echo '<tr><td class="solo">&nbsp;</td></tr>';
            foreach ($bl as $e)
                echo '<tr><td><div class="charttext">'.$e.'</div></td></tr>';
            echo '</table>';
            return;
            }
        // normal behavior
        echo '<table>';
        $size=count($arr);
        if($title!='' and !is_integer($title)) { // tricks
            //head
            echo '<tr>';
            echo '<td colspan="'.($size*2).'">';
            echo '<div class="charttext">'.$title.'</div>';
            echo '</td>';
            echo '</tr>';
            //head line
            echo '<tr>';
            echo '<td colspan="'.($size*2).'">';
            echo '<table><tr><th class="right width-50"></th><th class="width-50"></th></tr></table>';
            echo '</td>';
            echo '</tr>';
            //line
            if($size>=2){
                $tdWidth=((100)/($size*2));
            echo '<tr>';
            echo '<th class="right" width="'.$tdWidth.'%"></th>';
                echo '<th class="top" width="'.$tdWidth.'%"></th>';
                for($j=1; $j<$size-1; $j++) {
                    echo '<th class="right top" width="'.$tdWidth.'%"></th>';
                    echo '<th class=" top" width="'.$tdWidth.'%"></th>';
                }
                echo '<th class="right top" width="'.$tdWidth.'%"></th>';
            echo '<th width="'.$tdWidth.'%"></th>';
            echo '</tr>';
            }
        }
        foreach($arr as $key=>$value) {
            echo '<td colspan="2">';
            if(is_array($value)) {
                PHPtoOrgChart($value,$key);
            } else {
                echo '<div class="charttext">'.$value.'</div>';
            }
            echo '</td>';
        }
    echo '</tr>';
    echo '</table>';
    }
