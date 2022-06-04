<?php

    header('Content_Type:text/html; charset=UTF-8');


    $db = new mysqli("localhost", "root", "aa15411541", "yongdata");
    $db->set_charset("utf8");

    function mq($sql)
    {
        global $db;
        return $db ->query($sql);
    }

?>  


