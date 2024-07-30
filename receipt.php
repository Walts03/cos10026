<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("location: index.php");  //prevent direct redirect
    exit;
}
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="About">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Hai An">
    <link href="styles/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAAT Shoe Website</title>
    <link rel="icon" href="styles/images/logo/logoteam1.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include_once 'includes/header.inc'; ?>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="./styles/images/logo/logo3.png" style="width: 100%; max-width: 300px" />
                            </td>
                            <td>
                                Created: <?php
                                            date_default_timezone_set("Asia/Bangkok");
                                            echo date("Y-m-d h:i:sa");
                                            ?><br />
                                <?php
                                echo "ID: " . $_SESSION["id"];
                                ?><br>
                                <?php
                                echo "Status: " . $_SESSION["orderstatus"];
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <?php echo "Name: " . $_SESSION["name"]; ?>
                                <br>
                                <?php echo "Address: " . $_SESSION["address"]; ?>
                                <br>
                                <?php echo "State: " . $_SESSION["state"]; ?>
                                <br>
                                <?php echo "Postcode: " . $_SESSION["postcode"]; ?>

                            </td>

                            <td>
                                <?php echo "Email: " . $_SESSION["email"]; ?>
                                <br>
                                <?php echo "Phone Number: " . $_SESSION["phonenumber"]; ?>
                                <br>
                                <?php echo "Preferred Contact: " . $_SESSION["preferredcontact"]; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Payment Method</td>
                <td></td>
            </tr>

            <tr class="details">
                <td>Credit Card</td>
                <td><?php echo "Type: " . $_SESSION["creditcardtype"]; ?></td>
            </tr>
            <tr class="details">
                <td>Card Name</td>
                <td><?php echo $_SESSION["creditcardname"]; ?></td>
            </tr>
            <tr class="details">
                <td>Card Number</td>
                <td><?php 
                $creditcardnumber = $_SESSION["creditcardnumber"] ;
                $creditcardtype = $_SESSION["creditcardtype"];
                echo $creditcardtype == "amex" ? "***********" .$creditcardnumber[11].$creditcardnumber[12].$creditcardnumber[13].$creditcardnumber[14] : "************".$creditcardnumber[11].$creditcardnumber[12].$creditcardnumber[13].$creditcardnumber[14].$creditcardnumber[15];
                ?>
                </td>
            </tr>
            <tr class="details">
                <td>CVV</td>
                <td><?php 
                 $CVV = $_SESSION["cvv"]; 
                echo $CVV ? '**' .$CVV[2] : "*".$CVV[2];
                ?>
                </td>
            </tr>
            <tr class="details">
                <td>EXP Date</td>
                <td><?php 
		$exp = $_SESSION["exp"];
                echo $exp ? '**/**' .$exp[5].$exp[6] : "**".$exp[0].$exp[1];
                ?>
                </td>
            </tr>

            <tr class="heading">
                <td>Item</td>
                <td>Price</td>
            </tr>

            <tr class="item">
                <td><?php echo $_SESSION["product"]; ?></td>
                <td> 100.00$ </td>
            </tr>

            <tr class="heading">
                <td> Detail </td>
                <td> Shoe Size </td>
            </tr>

            <tr class="item">
                <td>Size</td>
                <td><?php echo $_SESSION["size"]; ?></td>
            </tr>

            <tr class="item">
                <td>Quantity </td>
                <td><?php echo $_SESSION["quantity"]; ?></td>
            </tr>

            <tr class="item last">
                <td>Feature </td>
                <td><?php echo $_SESSION["feature"]; ?></td>
            </tr>

            <tr class="total">
                <td></td>
                <td>Total: <?php echo $_SESSION["ordercost"]; ?>.00$ </td>
            </tr>
        </table>
    </div>

    <?php include_once 'includes/footer.inc'; ?>
</body>

</html>