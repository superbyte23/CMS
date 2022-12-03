<?php 

function redirect($url){
	return header('location: '.$url);
}

function csrf(){ 
	$_SESSION['token'] = bin2hex(random_bytes(32)); 
  	$token = $_SESSION['token']; 
	echo "<input type='hidden' name='token' value='".$token."' />";
}

// Function to find rank
// function rankify($A , $n)
// {    
//   // Rank Vector
//   $R = array(0); 
//   // Sweep through all elements in A for each
//   // element count the number of less than and
//   // equal elements separately in r and s.
//   for ($i = 0; $i < $n; $i++)
//   {
//       $r = 1;
//       $s = 1; 
//       for ($j = 0; $j < $n; $j++)
//       {
//           if ($j != $i && $A[$j] < $A[$i])
//               $r += 1;
               
//           if ($j != $i && $A[$j] == $A[$i])
//               $s += 1;    
//       } 
//       // Use formula to obtain rank
//       $R[$i] = $r + (float)($s - 1) / (float) 2; 
//   } 
//   for ($i = 0; $i < $n; $i++){
//     print number_format($R[$i], 1) . ' ';
//   }
      
// }

function rankify($A , $n)
  { 
    // Rank Vector
    $R = array(0); 
    // Sweep through all elements in A for each
    // element count the number of less than and
    // equal elements separately in r and s.
    for ($i = 0; $i < $n; $i++)
    {
        $r = 1;
        $s = 1; 
        for ($j = 0; $j < $n; $j++)
        {
            if ($j != $i && $A[$j] < $A[$i])
                $r += 1;
                 
            if ($j != $i && $A[$j] == $A[$i])
                $s += 1;    
        } 
        // Use formula to obtain rank
        $R[$i] = $r + (float)($s - 1) / (float) 2; 
    } 
    // for ($i = 0; $i < $n; $i++){
    //     print number_format($R[$i], 1) . ' ';
    // }
    return $R;        
} 

function rankify_asc($A , $n)
  { 
    // Rank Vector
    $R = array(0); 
    // Sweep through all elements in A for each
    // element count the number of less than and
    // equal elements separately in r and s.
    for ($i = 0; $i < $n; $i++)
    {
        $r = 1;
        $s = 1; 
        for ($j = 0; $j < $n; $j++)
        {
            if ($j != $i && $A[$j] > $A[$i])
                $r += 1;
                 
            if ($j != $i && $A[$j] == $A[$i])
                $s += 1;    
        } 
        // Use formula to obtain rank
        $R[$i] = $r + (float)($s - 1) / (float) 2; 
    } 
    // for ($i = 0; $i < $n; $i++){
    //     print number_format($R[$i], 1) . ' ';
    // } 
    return $R; 
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

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}

function dd($arr){
    echo "<pre>".var_export($arr, true)."</pre>"; 
}



?>