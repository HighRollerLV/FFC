<?php
function insert($sql, $conn){
    if($conn->query($sql)===TRUE){
        return true;
    }else{
        return false;
    }
}

function select($sql, $conn){
    $results = $conn->query($sql);
    if($results->num_rows > 0){
        return $results;
    }else{
        return false;
    }
}

?>