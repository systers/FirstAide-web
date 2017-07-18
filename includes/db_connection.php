<?php
    // Note: Always use mysqli object oriented interface
    $mysqli_db = new mysqli(
        $_settings['db']['hostname'],
        $_settings['db']['username'],
        $_settings['db']['password'],
        $_settings['db']['database']
    );

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $DB = new FirstAide\MysqlDatabase($mysqli_db);
