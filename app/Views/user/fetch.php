<?php

$output = '';
$output .= '<option value="" disabled selected>--Choose--</option>';
// Check whether there are results or not
if(mysqli_num_rows($res)>0){
    //Fetch the models into an array belongs to a particular brand name/id
    while ($row = mysqli_fetch_array($res)) {
        //Concatenate further fetched items to the output variable
        $output .= '<option value="'.$row["id"].'">'.$row["section_name"].'</option>';
    }
}
//print the fetched phone models
echo $output;


?>