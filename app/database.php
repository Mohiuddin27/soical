<?php

function connect(){
    return new mysqli(HOST,USER,PASS,DB);
}
/*
create
*/
function create($sql){
    connect()->query($sql);
}
function update($sql){
    return connect()->query($sql);
}
?>