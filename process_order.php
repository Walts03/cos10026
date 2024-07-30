<?php
//Prevent accessing directly from URL
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:payment.php');        //redirect to payment.php if attempted to access directly
    exit;
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//store the error and data as an empty array
$firstnameErr = $lastnameErr = $streetErr = $suburbErr = $stateErr = $postcodeErr = $phonenumberErr = $emailErr = $quantityErr = $creditcardtypeErr = $creditcardnameErr = $creditcardnumberErr = $creditcardexpirydateErr = $creditcardverificationErr = $sizeErr = $featureErr = $productErr = $preferredcontactErr = "";
$firstname  = $lastname = $street = $suburb = $state = $postcode = $phonenumber = $email  = $comment = $quantity = $creditcardtype = $creditcardname = $creditcardnumber = $creditcardexpirydate = $creditcardverification = $preferredcontact = $size = $feature = $product =  "";

//firstname
if (empty($_POST["firstname"])) {
    $firstnameErr = "First Name is required";
} else {
    $firstname = test_input($_POST["firstname"]);
    // check if first name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
        $firstnameErr = "Only letters and white space allowed";
    }
}
//lastname
if (empty($_POST["lastname"])) {
    $lastnameErr = "Last Name is required";
} else {
    $lastname = test_input($_POST["lastname"]);
    // check if last name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
        $lastnameErr = "Only letters and white space allowed";
    }
}
//street
if (empty($_POST["street"])) {
    $streetErr = "Street is required";
} else {
    $street = test_input($_POST["street"]);
    // check if name only contains letters and whitespace
}
//suburb
if (empty($_POST["suburb"])) {
    $suburbErr = "Suburb is required";
} else {
    $suburb = test_input($_POST["suburb"]);
}
//state 
if (empty($_POST["state"])) {
    $stateErr = "State is required";
} else {
    $state = test_input($_POST["state"]);
}
//post code
if (empty($_POST["postcode"])) {
    $postcodeErr = "Postcode is required";
} else {
    $postcode = test_input($_POST["postcode"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]{4}$/", $postcode)) {
        $postcodeErr = "Invalid postal code";
    } else {
        switch ($state) {
            case "VIC":
                if ($postcode[0] != "3" && $postcode[0] != "8") {                    //VIC post code must start with 3 or 8
                    $postcodeErr  .= "<p>VIC post code must start with 3 or 8.</p>\n";
                }
                break;
            case "NSW":
                if ($postcode[0] != "1" && $postcode[0] != "2") {                    //NSW post code must start with 1 or 2
                    $postcodeErr  .= "<p>NSW post code must start with 1 or 2.</p>\n";
                }
                break;
            case "QLD":
                if ($postcode[0] != "4" && $postcode[0] != "9") {                    //QLD post code must start with 4 or 9
                    $postcodeErr  .= "<p>QLD post code must start with 4 or 9.</p>\n";
                }
                break;
            case "WA":
                if ($postcode[0] != "6") {                                        //NA post code must start with 6
                    $postcodeErr  .= "<p>WA post code must start with 6.</p>\n";
                }
                break;
            case "SA":
                if ($postcode[0] != "5") {                                        //SA post code must start with 5
                    $postcodeErr  += "<p>SA post code must start with 5.</p>\n";
                }
                break;
            case "TAS":
                if ($postcode[0] != "7") {                                        //TAS post code must start with 7
                    $postcodeErr  += "<p>TAS post code must start with 7.</p>\n";
                }
                break;
            case "NT":
            case "ACT":
                if ($postcode[0] != "0") {                                        //NT and ACT post code must start with 0
                    $postcodeErr  .= "<p>Post code must start with 0.</p>\n";
                }
                break;
        }
    }
}

//Phone number
if (empty($_POST["phonenumber"])) {
    $phonenumberErr = "Phone Number is required";
} else {
    $phonenumber = test_input($_POST["phonenumber"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]{10}+$/", $phonenumber)) {
        $phonenumberErr = "Invalid phone number";
    }
}
//email
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
} else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
}
//product
if (empty($_POST["product"])) {
    $productErr = "Product not chosen";
} else {
    $product = test_input($_POST["product"]);
}
//shoesize
if (empty($_POST["size"])) {
    $sizeErr = "Shoe size not chosen";
} else {
    $size = test_input($_POST["size"]);
}
//quantity
if (empty($_POST["quantity"])) {
    $quantityErr = "";
} else {
    $quantity = test_input($_POST["quantity"]);
}
//feature
if (empty($_POST["feature"])) {
    $featureErr .= "Please choose a feature";
} else {
    $feature = implode(',', $_POST['feature']);
}
// comment is optional
if (!empty($_POST["comment"])) {
    $comment = test_input($_POST["comment"]);
}
//preferred contact receive 
if (empty($_POST["preferredcontact"])) {
    $preferredcontactErr = "";
} else {
    $preferredcontact = test_input($_POST["preferredcontact"]);
}
//credit card type
if (empty($_POST["creditcardtype"])) {
    $creditcardtypeErr = "Credit Card type is required";
} else {
    $creditcardtype = test_input($_POST["creditcardtype"]);
}

//credit card name
if (empty($_POST["creditcardname"])) {
    $creditcardnameErr = "Credit Card name is required";
} else {
    $creditcardname = test_input($_POST["creditcardname"]);
    if (!preg_match("/^[a-zA-Z ]{1,40}$/", $creditcardname)) {
        $creditcardnameErr = "Invalid name";
    }
}
//credit card number
$creditcardnumber = test_input($_POST["creditcardnumber"]);
if ($creditcardnumber == "") {
    $creditcardnumberErr = "Credit Card number is required";
} else {
    switch ($creditcardtype) {
        case "Visa":                                                                                             //check for visa type
            if ($creditcardnumber[0] != "4") {                                                                            //check if first number is 4
                $creditcardnumberErr .= "<p class='align-center'>Visa card number must start with 4.</p>\n";
            } else if (!preg_match("/^\d{16}$/", $creditcardnumber)) {                                                    //check if length is 16 and only contains numbers
                $creditcardnumberErr .= "<p class='align-center'>Visa card number must be 16 digits and contains numbers only.</p>\n";
            }
            break;
        case "Master":                                                                                             //check for mastercard type
            if (!($creditcardnumber[0] == "5" && ($creditcardnumber[1] >= 1 && $creditcardnumber[1] <= 5))) {                        //check if first 2 numbers are 51->55
                $creditcardnumberErr .= "<p class='align-center'>MasterCard must start with digits \"51\" through to \"55\".</p>\n";
            } else if (!preg_match("/^\d{16}$/", $creditcardnumber)) {                                                    //check if length is 16 and only contains numbers
                $creditcardnumberErr .= "<p class='align-center'>MasterCard number must be 16 digits and contains numbers only.</p>\n";
            }
            break;
        case "Amex":                                                                                             //check for amex type
            if (!($creditcardnumber[0] == "3" && ($creditcardnumber[1] == "4" || $creditcardnumber[1] == "7"))) {                    //check if first 2 numbers are 34 or 37
                $creditcardnumberErr .= "<p class='align-center'>American Express must start with \"34\" or \"37\".</p>\n";
            } else if (!preg_match("/^\d{15}$/", $creditcardnumber)) {                                                            //check if length is 15 and only contains numbers
                $creditcardnumberErr .= "<p class='align-center'>MasterCard number must be 15 digits and contains numbers only.</p>\n";
            }
            break;
    }
}
//credit card expiry date
if (empty($_POST["creditcardexpirydate"])) {
    $creditcardexpirydateErr = "Credit Card Date information is required";
} else {
    $creditcardexpirydate = test_input($_POST["creditcardexpirydate"]);
    if (!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/", $creditcardexpirydate)) {
        $creditcardexpirydateErr = "Invalid EXP date";
    }
}
//CVV
if (empty($_POST["creditcardverification"])) {
    $creditcardverificationErr = "Credit Card information is required";
} else {
    $creditcardverification = test_input($_POST["creditcardverification"]);
    if (!preg_match("/^\d{3}$/", $creditcardverification)) {
        $creditcardverificationErr = "Invalid CVV";
    }
}

//combine errors in an array 
$errMsg = [$firstnameErr, $lastnameErr, $streetErr, $suburbErr, $stateErr, $postcodeErr, $phonenumberErr, $emailErr, $quantityErr, $creditcardtypeErr, $creditcardnameErr, $creditcardnumberErr, $creditcardexpirydateErr, $creditcardverificationErr, $sizeErr, $featureErr, $productErr, $preferredcontactErr];
function checked($errMsg)  //function to turn error from array to string
{
    global $errMsg;
    foreach ($errMsg as $value) {
        if ($value != "") {
            return true;
        }
    }
    return false;
}
if (checked($errMsg) != false) {
    header("location:fix_order.php");
} else {

    require_once("settings.php");

    $conn = @mysqli_connect(    //database connect
        $host,
        $user,
        $pwd,
        $sql_db
    );

    if (!$conn) {
        echo "<p>Database connection failure</p>";
    } else {

        $sql_table = "orders";

        $name = $firstname . ' ' . $lastname;

        $address = $street . ' ' . $suburb;

        $order_product = $product;

        $order_cost = 100.00 * $quantity;

        $order_status = "Pending";

        //auto create table if not exists
        $query = "CREATE TABLE IF NOT EXISTS $sql_table (
                ID int(11) AUTO_INCREMENT,
                CUST_NAME varchar(255) NOT NULL,
                EMAIL varchar(255) NOT NULL,
                PHONE_NUM varchar(255) NOT NULL,
                CUST_ADDRESS varchar(255) NOT NULL,
                POSTAL varchar(255) NOT NULL,
                CARD_TYPE varchar(255) NOT NULL,
                CARD_HOLDER varchar(255) NOT NULL,
                CARD_NUMBER varchar(255) NOT NULL,
                CARD_EXP varchar(255) NOT NULL,
                CVV varchar(255) NOT NULL,
                FEATURE varchar(255) NOT NULL,
                ORDER_PRODUCT varchar(255) NOT NULL,
                ORDER_QUANTITY varchar(255) NOT NULL,
                ORDER_COST int,
                ORDER_TIME datetime,
                ORDER_STATUS varchar(255) NOT NULL,
                PRIMARY KEY  (ID)
                )";


        $result = mysqli_query($conn, $query);

        //auto insert data into database
        $add_query = "insert into $sql_table (CUST_NAME, EMAIL, PHONE_NUM, CUST_ADDRESS, POSTAL, CARD_TYPE, CARD_HOLDER,  CARD_NUMBER, CARD_EXP, CVV, FEATURE, ORDER_PRODUCT, ORDER_QUANTITY, ORDER_COST, ORDER_TIME,  ORDER_STATUS) values ('$name','$email','$phonenumber','$address','$postcode','$creditcardtype','$creditcardname','$creditcardnumber','$creditcardexpirydate','$creditcardverification','$feature','$order_product','$quantity', '$order_cost', now(), '$order_status')";


        $add_result = @mysqli_query($conn, $add_query);



        if (!$add_result) {
            echo "<p class=\"wrong\">something is wrong with ", $add_query, "</p>";
        } else {
            $last_id = mysqli_insert_id($conn);
            echo "<p class\"ok\">Successfully added new order record</p>";
        }

        mysqli_close($conn);
    }
    header("location:receipt.php");
}
//storing variables in session so we can get data for the others
session_start();
$_SESSION["errMsg"] = $errMsg;
$_SESSION["firstname"] = $firstname;
$_SESSION["lastname"] = $lastname;
$_SESSION["email"] = $email;
$_SESSION["street"] = $street;
$_SESSION["suburb"] = $suburb;
$_SESSION["state"] = $state;
$_SESSION["postcode"] = $postcode;
$_SESSION["phonenumber"] = $phonenumber;
$_SESSION["preferredcontact"] = $preferredcontact;
$_SESSION["comment"] = $comment;
$_SESSION["product"] = $product;
$_SESSION["size"] = $size;
$_SESSION["cvv"] = $creditcardverification;
$_SESSION["quantity"] = $quantity;
$_SESSION["feature"] = $feature;
$_SESSION["name"] = $name;
$_SESSION["address"] = $address;
$_SESSION["creditcardtype"] = $creditcardtype;
$_SESSION["creditcardnumber"] = $creditcardnumber;
$_SESSION["creditcardname"] = $creditcardname;
$_SESSION["ordercost"] = $order_cost;
$_SESSION["id"] = $last_id;
$_SESSION["orderstatus"] = $order_status;
$_SESSION["exp"] = $creditcardexpirydate;
