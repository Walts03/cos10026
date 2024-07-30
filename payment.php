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
    <?php include_once 'includes/header.inc'; ?>
    <div class="whole">
        <div class="formcontainer">
            <form id="formenquire" action="process_order.php" method="post" novalidate>
                <div class="contact-box-photo">
                    <div class="left1"></div>
                    <div class="right1">
                        <h2 class="formhead">Contact Us</h2>
                        <input type="text" class="field" placeholder="First Name" name="firstname" maxlength="25" pattern="^[A-Za-z]+$" required>
                        <input type="text" class="field" name="lastname" maxlength="25" placeholder="Last Name" pattern="^[A-Za-z]+$" required>
                        <input type="text" name="email" class="field" placeholder="Your Email" required>
                        <input type="text" name="phonenumber" class="field" placeholder="Phone" pattern="\d{1-10}" required>
                        <input type="text" class="field" name="street" maxlength="40" placeholder="Street" value="" required>
                        <input type="text" class="field" name="suburb" maxlength="20" placeholder="Suburb" value="" required> <br> <br>
                        <textarea id="commentarea" name="comment" placeholder="Message" class="field"></textarea>
                        <select name="state" class="field">
                                <option value=""disabled selected hidden>State</option>              <!-- Initial select -->
			                    <option value="VIC">VIC</option>
			                    <option value="NSW">NSW</option>
			                    <option value="QLD">QLD</option>
			                    <option value="NT">NT</option>
			                    <option value="WA">WA</option>
			                    <option value="SA">SA</option>
			                    <option value="TAS">TAS</option>
			                    <option value="ACT">ACT</option>
                        </select>
                        <input type="text" class="field" name="postcode" minlength="4" maxlength="4" placeholder="Post Code" pattern="[0-9]{4}" value="">
                        <label for="Received" id="News"name="preferredcontact"><b>Preferred contact:</b><br /></label>
                            <input type="radio" id="Received" name="preferredcontact" value="Gmail"> Gmail
                            <input type="radio" id="Received" name="preferredcontact" value="SocialMedia">Social Media
                            <input type="radio" id="Received" name="preferredcontact" value="SMS" > SMS <br><br>
                        
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
                        <option value="Basketball">Basketball - 100.00$</option>
                        <option value="Soccer">Soccer - 100.00$</option>
                        <option value="Running">Running - 100.00$</option>
                        <option value="Tennis">Tennis - 100.00$</option>
                        <option value="Lifestyle">Lifestyle - 100.00$</option><br><br>
                    </select>
                    <select name="size" class="field">
                        <option value="" disabled selected hidden>Select Size</option>
                        <option value="47">47</option>
                        <option value="47.5">47.5</option>
                        <option value="48">48</option>
                        <option value="48.5">48.5</option>
                        <option value="49"> 49</option>
                    </select>
                    <br>
                    <label for="quantity" id="paylay">Quantities: </label>
                    <input type="number" value="1" min="1" class="field" name="quantity"><br>
                    <div>
                        <label class="select-title" name="feature[] "><b>Product Feature</b></label><br>
                        <input type="checkbox" id="feature1" name="feature[] " value="Red">
                        <label for="feature1"> Red</label><br>
                        <input type="checkbox" id="feature2" name="feature[] " value="Blue">
                        <label for="feature2"> Blue</label><br>
                        <input type="checkbox" id="feature3" name="feature[] " value="Green">
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
                    <input type="text" class="payarea" id="expyear" name="creditcardexpirydate" placeholder="mm/yyyy" >
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
                            <input id="checkbox1" type="checkbox" required = required />
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