<?php 
function get_gold_reward($difficult){
    $reward = 0;
    if($difficult == 'HARD') {
        $reward = 50;
    } else if ($difficult == 'MEDIUM'){
        $reward = 35;
    } else {
        $reward = 25;
    }
    return $reward;
}

function get_exp_reward($difficult, $level){
    $exp = 0;
    if($difficult == 'HARD') {
        $exp = 50 - $level;
    } else if ($difficult == 'MEDIUM'){
        $exp = 35 - $level;
    } else {
        $exp = 25 - $level;
    }
    if($exp <= 0){
        $exp = 1;
    }
    return $exp;
}

?>