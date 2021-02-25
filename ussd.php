<?php

    header("content-type: text/plain");
    include 'functions.php';
    include 'connection.php';

//    $session_id = $_POST['sessionId'];
//    $service_code = $_POST['serviceCode'];

    $phone_number = $_GET['phone_number'];
    $text = $_GET['text'];

    $data = explode('*', $text);

    $level = 0;
    $level = count($data);

    echo $level, ' ';

    if ($level == 1) {
        main_menu();
    }

    if ($level > 1) {
        switch ($data[1]) {
            case 1:
                register_account($data, $phone_number);
                break;

            case 2:
//                add_product();
                echo "Welcome to menu option $data[1]";
                break;

            case 3:
//                purchase_product();
                echo "Welcome to menu option $data[1]";
                break;

            case 4:
//                generate_report();
                echo "Welcome to menu option $data[1]";
                break;

            case 5:
//                tips_and_updates();
                echo "Welcome to menu option $data[1]";
                break;

            case 6:
//                update_personal_info();
                echo "Welcome to menu option $data[1]";
                break;

            default:
                $text = "Invalid menu option, Please insert a valid menu option";
                ussd_stop($text);
        }
    }
