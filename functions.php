<?php

    function main_menu() {
        $text = "Welcome to Fresh City, Please reply with\n1. Register an account\n2. Add a product\n3. Purchase a product\n4. Generate Report\n5. Tips and Updates\n6. Update your personal information\n7. Update password";
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

            // check whether email or id number are already registered
            $records = $connection->query("SELECT * FROM users WHERE email='$email' || id_number='$id_number'") or die($connection->error);

            $records_check = mysqli_num_rows($records);

            if ($records_check > 0) {
                $text = "Your email address, $email, (and/or) ID Number, $id_number, are already registered";
                ussd_stop($text);
            } else {
                $sql = $connection->query("INSERT INTO users (first_name, last_name, sur_name, phone_number, id_number, gender, email, password, register_date) 
                                                    VALUES ('$first_name', '$last_name', '$sur_name', '$phone_number', '$id_number', '$gender', '$email', '$password', now())") or die($connection->error);

                if ($sql == 1) {
                    $text = "Thank you for registering $email";
                    ussd_stop($text);
                }
            }
        }
    }

    // check password
    function check_password($data, $password) {
        global $connection;
        if (count($data) == 2) {
            $text = "Enter your password to continue";
            ussd_proceed($text);
        }

        if (count($data) == 3) {
            $phone = $_GET['phoneNumber'];
            $password = md5($data[2]);

            $sql = $connection->query("SELECT * FROM users WHERE phone_number='$phone' && password='$password'") or die($connection->error);

            $check = mysqli_num_rows($sql);

            if ($check > 0) {
                return true;
            } else {
                $text = "Please check your password and try again";
                ussd_stop($text);
            }
        }
    }

    // check id number to update password
    function check_id_number($data, $id_number) {
        global $connection;
        if (count($data) == 2) {
            $text = "Please enter your ID Number to continue";
            ussd_proceed($text);
        }

        if (count($data) == 3) {
            $phone_number = $_GET['phoneNumber'];
            $id_number = $data[2];

            $sql = $connection->query("SELECT * FROM users WHERE phone_number='$phone_number' && id_number='$id_number'") or die($connection->error);

            $check = mysqli_num_rows($sql);

            if ($check > 0) {
                return true;
            } else {
                $text = "Please check your ID Number and try again";
                ussd_stop($text);
            }
        }
    }

    // add product
    function add_product($data, $phone_number) {
        if (count($data) == 3) {
            $text = "Add your product here";
            ussd_stop($text);
        }
    }

    // purchase product
    function purchase_product($data, $phone_number) {
        if (count($data) == 3) {
            $text = "Purchase a product here";
            ussd_stop($text);
        }
    }

    // generate report
    function generate_report($data, $phone_number) {
        if (count($data) == 3) {
            $text = "Generate a report here";
            ussd_stop($text);
        }
    }

    // tips and updates
    function tips_and_updates($data, $phone_number) {
        if (count($data) == 3) {
            $text = "Get tips and updates here";
            ussd_stop($text);
        }
    }

    // update personal info
    function update_personal_info($data, $phone_number) {
        if (count($data) == 3) {
            $text = "Update personal information here";
            ussd_stop($text);
        }
    }

    // update password
    function update_password($data, $phone_number) {
        global $connection;
        if (count($data) == 3) {
            $text = "Enter your new 4 digit password";
            ussd_proceed($text);
        }

        if (count($data) == 4) {
            $password = md5($data[3]);
            $phone_number = $_GET['phoneNumber'];

            $old_password = (array)$connection->query("SELECT * FROM users WHERE phone_number='$phone_number'")->fetch_assoc() or die($connection->error);

            if ($password == $old_password['password']) {
                $text = "Your old and new password cannot be the same";
                ussd_stop($text);
            } else {
                $sql = $connection->query("UPDATE users SET password='$password' WHERE phone_number='$phone_number'") or die($connection->error);

                if ($sql == 1) {
                    $text = "You successfully updated your password";
                    ussd_stop($text);
                }
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
