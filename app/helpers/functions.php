<?php 

function redirect($url){
	return header('location: '.$url);
}

function csrf(){ 
	$_SESSION['token'] = bin2hex(random_bytes(32)); 
  	$token = $_SESSION['token']; 
	echo "<input type='hidden' name='token' value='".$token."' />";
}


//calculate rank for key value pair array
function calculate_rank($rank_values): array {
    asort($rank_values);
    $rank_array = [];
    $rank = 0;
    $r_last = null;
    foreach ($rank_values as $key => $value) {
        if ($value != $r_last) {
            if($value > 0){ //if you want to set zero rank for values zero
              $rank++;
            }
            $r_last = $value;
        }
        $rank_array[$key] = $value > 0 ? $rank: 0; //if you want to set zero rank for values zero
    }    
    return $rank_array;
} 

function dd($arr){
    echo "<pre>".var_export($arr, true)."</pre>"; 
}



?>