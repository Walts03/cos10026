<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>KAAT Shoe Website</title>
    <link rel="icon" href="styles/images/logo/logoteam1.png" type="image/png">
</head>

<body>
<?php
		//Prevent accessing directly from URL
		if(!isset($_SERVER['HTTP_REFERER'])){
		    header('location:payment.php');		//redirect to payment.php if attempted to access directly
		    exit;
		}
        else{
			$page = "processPage";
			include_once("includes/header.inc");
			//Print out error message
			session_start();
	    }
    ?>
<div class="errdisplay"><p><?php echo join("</p><p>", $_SESSION['errMsg']) ?></p></div>
    <div class="whole">
        <div class="formcontainer">
            <form id="formenquire" action="process_order.php" method="post" novalidate>
                <div class="contact-box-photo">
                    <div class="left1"></div>
                    <div class="right1">
                        <h2 class="formhead">Contact Us</h2>
                        <input type="text" class="field" placeholder="First Name" name="firstname" maxlength="25" pattern="^[A-Za-z]+$" required="required" value="<?php echo $_SESSION["firstname"] ?>">
                        <input type ="text" class="field" name="lastname" maxlength="25" placeholder="Last Name" pattern="^[A-Za-z]+$" required="required" value="<?php echo $_SESSION["lastname"] ?>">
                         <input type="text" name="email" class="field" placeholder="Your Email" required=required value="<?php echo $_SESSION["email"] ?>">
                        <input type="text" name="phonenumber" class="field" placeholder="Phone" pattern="\d{1-10}" required="required" value="<?php echo $_SESSION["phonenumber"] ?>">
                        <input type="text" class="field" name="street" maxlength="40" placeholder="Street" value="" required="required" value="<?php echo $_SESSION["street"] ?>">
                        <input type="text" class="field" name="suburb" maxlength="20" placeholder="Suburb" value="" required="required" value="<?php echo $_SESSION["suburb"] ?>"> <br> <br>
                        <textarea id="commentarea" name="comment" placeholder="Message" class="field"<?php echo $_SESSION["comment"] ?>></textarea>
                        <select name="state" class="field">
                              <!-- Initial select -->
			                    <option value="VIC" <?php echo ($_SESSION["state"] == "VIC") ? "selected" : "" ?>>VIC</option>
			                    <option value="NSW" <?php echo ($_SESSION["state"] == "NSW") ? "selected" : "" ?>>NSW</option>
			                    <option value="QLD"<?php echo ($_SESSION["state"] == "QLD") ? "selected" : "" ?>>QLD</option>
			                    <option value="NT"<?php echo ($_SESSION["state"] == "NT") ? "selected" : "" ?>>NT</option>
			                    <option value="WA"<?php echo ($_SESSION["state"] == "WA") ? "selected" : "" ?>>WA</option>
			                    <option value="SA"<?php echo ($_SESSION["state"] == "SA") ? "selected" : "" ?>>SA</option>
			                    <option value="TAS"<?php echo ($_SESSION["state"] == "TAS") ? "selected" : "" ?>>TAS</option>
			                    <option value="ACT"<?php echo ($_SESSION["state"] == "ACT") ? "selected" : "" ?>>ACT</option>
    
                        </select>
                        <input type="text" class="field" name="postcode" minlength="4" maxlength="4" placeholder="Post Code" pattern="[0-9]{4}" value="<?php echo $_SESSION["postcode"] ?>">
                        <label for="Received" id="News" name="preferredcontact"><b>Preferred contact:</b><br /></label>
                        <input type="radio" id="Received" name="preferredcontact" value="Gmail"<?php echo ($_SESSION["preferredcontact"] == "Gmail") ? "checked" : "" ?>> Gmail
                        <input type="radio" id="Received" name="preferredcontact" value="SocialMedia"<?php echo ($_SESSION["preferredcontact"] == "SocialMedia") ? "checked" : "" ?>>Social Media
                        <input type="radio" id="Received" name="preferredcontact" value="SMS"<?php echo ($_SESSION["preferredcontact"] == "SMS") ? "checked" : "" ?>> SMS <br><br>
                    </div>
                </div>
        </div>
    </div>
    <div class="formcontainer">
        <div class="contact-box">
            <div class="paymentarea">
                <div class="col-50">
                    <h3>Choose your product</h3>
                    <select name="product" class="field">
                        <option value="" disabled selected hidden>Select your Product</option>
                        <option value="Basketball" <?php echo ($_SESSION["product"] == "Basketball") ? "selected" : "" ?>>Basketball - 100.00$</option>
                        <option value="Soccer"<?php echo ($_SESSION["product"] == "Soccer") ? "selected" : "" ?>>Soccer - 100.00$</option>
                        <option value="Running"<?php echo ($_SESSION["product"] == "Running") ? "selected" : "" ?>>Running - 100.00$</option>
                        <option value="Tennis"<?php echo ($_SESSION["product"] == "Tennis") ? "selected" : "" ?>>Tennis - 100.00$</option>
                        <option value="Lifestyle"<?php echo ($_SESSION["product"] == "Lifestyle") ? "selected" : "" ?>>Lifestyle - 100.00$</option><br><br>
                    </select>
                    <select name="size" class="field">
                        <option value="" disabled selected hidden>Select Size</option>
                        <option value="47"<?php echo ($_SESSION["size"] == "47") ? "selected" : "" ?>>47</option>
                        <option value="47.5"<?php echo ($_SESSION["size"] == "47.5") ? "selected" : "" ?>>47.5</option>
                        <option value="48"<?php echo ($_SESSION["size"] == "48") ? "selected" : "" ?>>48</option>
                        <option value="48.5"<?php echo ($_SESSION["size"] == "48.5") ? "selected" : "" ?>>48.5</option>
                        <option value="49"<?php echo ($_SESSION["size"] == "49") ? "selected" : "" ?>> 49</option>
                    </select>
                    <br>
                    <label for="quantity" id="paylay">Quantities: </label>
                    <input type="number" min="1" class="field" name="quantity" value="<?php echo $_SESSION['quantity'] ?>"><br>
                    <?php
                        		//Split the value stored in $_SESSION["features"] into an array of strings
                        		function splitFeatures($string){
                        			return explode(",", $string);
                        		}
                        		$features = splitFeatures($_SESSION["feature"]);
                        		$isFeature1 = false;
                        		$isFeature2 = false;
                        		$isFeature3 = false;
                        		for ($i = 0; $i < count($features); $i++){
                        			if ($features[$i] == "feature 1")
                        				$isFeature1 = true;
                        			if ($features[$i] == "feature 2")
                        				$isFeature2 = true;
                        			if ($features[$i] == "feature 3")
                        				$isFeature3 = true;
                        		}
                        	?>
                    <div>
                        <label class="select-title" name="feature[] "><b>Product Feature</b></label><br>
                        <input type="checkbox" id="feature1" name="feature[] " value="Red"<?php echo ($isFeature1) ? "checked" : "" ?>>
                        <label for="feature1"> Red</label><br>
                        <input type="checkbox" id="feature2" name="feature[] " value="Blue"<?php echo ($isFeature2) ? "checked" : "" ?>>
                        <label for="feature2"> Blue</label><br>
                        <input type="checkbox" id="feature3" name="feature[] " value="Green"<?php echo ($isFeature3) ? "checked" : "" ?>>
                        <label for="feature3"> Green</label><br>
                    </div><br>
                </div>

                <div class="col-50">
                    <h3>Payment</h3>
                    <label for="creditcardtype" id="paylay">Accepted Cards</label>
                    <div class="icon-container">
                        <input type="radio" name="creditcardtype" value="Visa">
                        <label for="visa">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                        </label>
                        <input type="radio" name="creditcardtype" value="Amex">
                        <label for="americanexpress">
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                        </label>
                        <input type="radio" name="creditcardtype" value="Master">
                        <label for="mastercard">
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        </label>
                    </div>
                    <label for="creditcardname" id="paylay">Name on Card</label>
                    <input type="text" id="cname" class="payarea" name="creditcardname" placeholder="Enter name on card">
                    <label for="creditcardnumber" id="paylay">Credit card number</label>
                    <input type="text" id="ccnum" class="payarea" name="creditcardnumber" placeholder="ex:1111-2222-3333-4444">
                    <label for="creditcardexpirydate" id="paylay">Exp Date</label>
                    <input type="text" class="payarea" id="expyear" name="creditcardexpirydate" placeholder="mm/yyyy">
                    <div class="rowpay">
                        <div class="col-50">
                            <label for="cvv" id="paylay">CVV</label>
                            <input type="text" class="payarea" id="cvv" name="creditcardverification" placeholder="Enter CVV">
                        </div>
                        <div class="col-50">
                            <div class="centerbtn">
                                <button class="btn-submit">Send
                                    <input type="submit" value="">
                                </button>
                            </div>
                        </div>
                        <div class="col-50">
                            <div class="tacbox">
                                <input id="checkbox1" type="checkbox" required />
                                <label for="checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </form>
    <?php include_once 'includes/footer.inc'; 
    session_unset(); session_destroy();?>
</body>


</html>