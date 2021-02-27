<?php

    function main_menu() {
        $text = "Welcome to Fresh City, Please reply with\n1. Register an account\n2. Add a product\n3. Purchase a product\n4. Generate Report\n5. Tips and Updates\n6. Update your personal information";
        ussd_proceed($text);
    }

    // check if phone number is registered
    function check_if_phone_is_registered($phone_number) {
        global $connection;

        $sql = $connection->query("SELECT * FROM users WHERE phone_number='$phone_number'") or die($connection->error);

        $check = mysqli_num_rows($sql);

        if ($check > 0) {
            $text = "Your phone number, $phone_number, is already registered";
            ussd_stop($text);
        }
    }

    // register an account
    function register_account($data) {
        global $connection;
        if (count($data) == 2) {
            $text = "Enter your first name";
            ussd_proceed($text);
        }

        if (count($data) == 3) {
            $text = "Enter your last name";
            ussd_proceed($text);
        }

        if (count($data) == 4) {
            $text = "Enter your sur name";
            ussd_proceed($text);
        }

        if (count($data) == 5) {
            $text = "Enter your id number";
            ussd_proceed($text);
        }

        if (count($data) == 6) {
            $text = "Enter your gender(Male or Female)";
            ussd_proceed($text);
        }

        if (count($data) == 7) {
            $text = "Enter your email";
            ussd_proceed($text);
        }

        if (count($data) == 8) {
            $text = "Enter your 4 digit password";
            ussd_proceed($text);
        }

        if (count($data) == 9) {
            $phone_number = $_GET['phoneNumber'];
            $first_name = ucfirst($data[2]);
            $last_name = ucfirst($data[3]);
            $sur_name = ucfirst($data[4]);
            $id_number = $data[5];
            $gender = $data[6];
            $email = $data[7];
            $password = md5($data[8]);

            $sql = $connection->query("INSERT INTO users (first_name, last_name, sur_name, phone_number, id_number, gender, email, password, register_date) 
                                                VALUES ('$first_name', '$last_name', '$sur_name', '$phone_number', '$id_number', '$gender', '$email', '$password', now())") or die($connection->error);

            if ($sql) {
                $text = "Thank you for registering";
                ussd_stop($text);
            }
        }
    }

    function ussd_proceed($text) {
        echo "CON ".$text;
    }

    function ussd_stop($text) {
        echo "END ".$text;
        exit();
    }
