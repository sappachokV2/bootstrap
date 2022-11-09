<?php
$mysqli = new mysqli("testmysql", "student02", "student") or die("Can't connect to mysqli");
$mysqli -> select_db("student02_db") or die("Can't select db");

?>