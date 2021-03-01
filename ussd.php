<?php

    header("content-type: text/plain");
    include 'functions.php';
    include 'connection.php';
    include 'config.php';

    $data = explode('*', $text);

    $level = 1;
    $level = count($data);

    echo $level, ' ';

    if ($level == 1) {
        main_menu();
    }

    if ($level > 1) {
        switch ($data[1]) {
            case 1:
                check_if_phone_is_registered($phone_number);
                register_account($data, $phone_number);
                break;

            case 2:
                check_password($data, $phone_number);
                add_product($data, $phone_number);
                break;

            case 3:
//                purchase_product();
                $text = "Welcome to menu option $data[1]";
                ussd_stop($text);
                break;

            case 4:
//                generate_report();
                $text = "Welcome to menu option $data[1]";
                ussd_stop($text);
                break;

            case 5:
//                tips_and_updates();
                $text = "Welcome to menu option $data[1]";
                ussd_stop($text);
                break;

            case 6:
//                update_personal_info();
                $text = "Welcome to menu option $data[1]";
                ussd_stop($text);
                break;

            default:
                $text = "Invalid menu option, Please insert a valid menu option";
                ussd_stop($text);
        }
    }
