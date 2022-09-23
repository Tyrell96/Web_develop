<?php

    header('Content_Type:text/html; charset=UTF-8');


    $db = new mysqli("127.0.0.1", "root", "aa15411541", "yongdata");
    $db->set_charset("utf8");

    function mq($sql)
    {
        global $db;
        return $db ->query($sql);
        // sql 예시 "INSERT INTO test(id, label) VALUES (?, ?)"
    //     $id = 1;
    // $label = 'PHP';
    // $stmt->bind_param("is", $id, $label); // "is" means that $id is bound as an integer and $label as a string
    // $stmt->execute();
    }

?>  


