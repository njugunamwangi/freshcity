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

    if ($level == 0 || $level == 1) {
        main_menu();
    }

    if ($level > 1) {
        switch ($data[1]) {
            case 1:
                check_if_phone_is_registered($phone_number);
                register_account($data, $phone_number);
                break;

            case 2:
                add_product();
                break;

            case 3:
                purchase_product();
                break;

            case 4:
                generate_report();
                break;

            case 5:
                tips_and_updates();
                break;

            case 6:
                update_personal_info();
                break;

            default:
                $text = "Invalid menu option, Please insert a valid menu option";
                ussd_stop($text);
        }
    }
