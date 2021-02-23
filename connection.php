<?php

    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'freshcity';

    $connection = new mysqli($db_host, $db_user, $db_password, $db_name) or die($connection->error());
