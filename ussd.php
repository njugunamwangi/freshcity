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
                check_password($data, $phone_number);
                purchase_product($data, $phone_number);
                break;

            case 4:
                check_password($data, $phone_number);
                generate_report($data, $phone_number);
                break;

            case 5:
                check_password($data, $phone_number);
                tips_and_updates($data, $phone_number);
                break;

            case 6:
                check_password($data, $phone_number);
                update_personal_info($data, $phone_number) ;
                break;

            default:
                $text = "Invalid menu option, Please insert a valid menu option";
                ussd_stop($text);
        }
    }
