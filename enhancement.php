<!DOCTYPE html>
<html lang="en" manifest="manifest_filename.appcache">

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
    <div class="enhancewhole">
        
        <div class="enhancecontainer">
            <p>
                Information about enhancement Assignment 1
            </p>
        </div>
            <details id="eninfo">
                <summary id="ensum">Summary</summary>
                <ul>
                    <li>1.Using font from library</li>
                    <li>2.CSS configuration from the main page</li>
                    <li>3.Menu bar include small CSS hover</li>
                </ul>
            </details>
            <details id="eninfo">
                <summary id="ensum">Wrapper</summary>
                <ul>
                    <li>1.Using wrapper to create a computer design that will fit with the video</li>
                    <li>2.Using video tag </li>
                    <li>3.Our team video will be attach in the middle screen of the computers</li>
                </ul>
            </details>
            <details id="eninfo">
                <summary id="ensum">Custom button animation</summary>
                <ul>
                    <li>1.futher configuration in transition hover (before and after)</li>
                    <li>2.Button onclick will transport you to this page</li>
                </ul>
            </details>

            <div class="enhancecontainer">
            <p>
                Information about enhancement Assignment 2
            </p>
        </div>

        <details id="eninfo">
            <summary id="ensum">Log In/Log Out</summary>
            <ul>
                <li>Get login form information using POST variables</li>
                <li>Search the database for a user with the specified password.</li>
                <li>Instead, reload the page and display an error message (passed in via query parameters)</li>
                <li>If the account exist in database, go to the manager page and change the session's authenticated flag to true.</li>
                <li>The logout button sets this flag to false and clears the session</li>
                <li><b>P/S:</b> Due to the security problem, the database for user will not be created automatically, the "users" table will be created by hand in phpmyadmin</li>
                <li>username and password for the login page is: admin </li>
            </ul>
        </details>

        <details id="eninfo">
            <summary id="ensum">Manager Sort</summary>
            <ul>
                <li>1. Showing best selling product: </li>
                <li>Finding each individual product in order purchases by using the 'strpos' function</li>
                <li>Adjusting the relevant product counter variable.</li>
                <li>Two temporary variables to hold the values for name of the best selling product.</li>
            </ul>
            <ul>
                <li>2. Showing the number of orders corresponding to status: </li>
                <li>Bring up each record into an array of associations </li>
                <li>Updating the relevant order status and displaying it.</li>
            </ul>
        </details>   

    </div>

    <?php include_once 'includes/footer.inc'; ?>
</body>

</html>