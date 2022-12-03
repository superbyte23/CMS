<?php 

include '../../bootstrapper.php';

$R = array();

$R[0] = 1 + (float)(1-1) / (float) 2;
$R[1] = 2 + (float)(2-1) / (float) 2;
$R[2] = 3 + (float)(3-1) / (float) 2;
$R[3] = 4 + (float)(4-1) / (float) 2;
$R[4] = 5 + (float)(5-1) / (float) 2;
$R[5] = 6 + (float)(6-1) / (float) 2;
$R[6] = 7 + (float)(7-1) / (float) 2;
$R[7] = 8 + (float)(8-1) / (float) 2;

dd($R);

?>

<h1>PHP</h1>
<?php
// PHP Code to find rank of elements
 
// Function to find rank
// function rankify($A , $n)
// { 
//     // Rank Vector
//     $R = array(0); 
//     // Sweep through all elements in A for each
//     // element count the number of less than and
//     // equal elements separately in r and s.
//     for ($i = 0; $i < $n; $i++)
//     {
//         $r = 1;
//         $s = 1; 
//         for ($j = 0; $j < $n; $j++)
//         {
//             if ($j != $i && $A[$j] < $A[$i])
//                 $r += 1;
                 
//             if ($j != $i && $A[$j] == $A[$i])
//                 $s += 1;    
//         } 
//         // Use formula to obtain rank
//         $R[$i] = $r + (float)($s - 1) / (float) 2; 
//     } 
//     for ($i = 0; $i < $n; $i++){
//         print number_format($R[$i], 1) . ' ';
//     }
        
// }
 
// Driver Code
$A = array(1, 2, 5, 5, 3, 25, 2);
sort($A, SORT_NATURAL | SORT_FLAG_CASE);
$n = count($A);
// asort($n);
for ($i = 0; $i < $n; $i++){

    echo $A[$i] . '<br>';
} 
 
rankify($A, $n);
 
// This code is contributed by Rajput-Ji
?>

<br><br><br>    
<h1>Javascript</h1>
<script>
 
// JavaScript code to find
// rank of elements
function rankify_improved(A)
{
     
    // create rank vector
    let R = new Array(A.length).fill(0)
 
    // Create an auxiliary array of tuples
    // Each tuple stores the data as well
    // as its index in A
    let T = new Array(A.length);
    for(let i = 0; i < A.length; i++)
    {
        T[i] = [A[i], i]
    }
 
    // T[][0] is the data and T[][1] is
    // the index of data in A
 
    // Sort T according to first element
    T.sort((a,b) => a[0]-b[0])
 
    let rank = 1, n = 1,i = 0
 
    while(i < A.length){
        let j = i
 
        // Get no of elements with equal rank
        while(j < A.length - 1 && T[j][0] == T[j + 1][0])
            j += 1
 
        n = j - i + 1
 
        for(let j=0;j<n;j++){
 
            // For each equal element use formula
            // obtain index of T[i+j][0] in A
            let idx = T[i+j][1]
            R[idx] = rank + (n - 1) * 0.5
        }
 
        // Increment rank and i
        rank += n
        i += n
    }
    return R
}
 
// Driver code
let A = [1, 2, 5, 2, 1, 25, 2];
A.sort();
document.write(A,"</br>")
document.write(rankify_improved(A),"</br>")
 
// This code is contributed by shinjanpatra
 
</script>