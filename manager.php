<?php
// Only allows access to page if the user has been through the authentication
// page and has the authenticated boolean set in the session.
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: ./login.php?error_msg=Unauthenticated");
}
?>
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
    <div id="tablemanage">
        <article id="managertable">
            <form method='post' action="logout.php" novalidate>
            <input type="submit" value="Log Out" class='btn-submitdetail'>
            </form>
            <h1>Order Information</h1>
            <?php
            require_once("settings.php");

            $conn = @mysqli_connect(             //database connection
                $host,
                $user,
                $pwd,
                $sql_db
            );
            if (!$conn) {
                echo "<p>Database connection failure</p>";   
            } else {
                $sql_table = "orders";              
                if (isset($_GET["action"])) {         
                    $action = $_GET["action"];
                } else {
                    $action = "";
                }
                if (isset($_GET["id"])) {
                    $action_id = $_GET["id"];
                }

                if (isset($_GET["status"])) {
                    $action_status = $_GET["status"];
                }

                if (isset($_GET["filname"])) {
                    $filter_name = $_GET["filname"];
                } else {
                    $filter_name = "";
                }

                if (isset($_GET["filter_shoe"])) {
                    $filter_shoe = $_GET["filter_shoe"];
                } else {
                    $filter_shoe = "";
                }

                if (isset($_GET["filter_status"])) {
                    $filter_status = $_GET["filter_status"];
                } else {
                    $filter_status = "";
                }
                $sort_query = "";
                if (isset($_GET["sort_cost"]) && strlen($_GET["sort_cost"]) != 0) {
                    $sort_cost = $_GET["sort_cost"];
                    if ($sort_cost === "sutd") {
                        $sort_query = "ORDER BY ORDER_COST DESC";
                    } else if ($sort_cost === "sdtu") {
                        $sort_query = "ORDER BY ORDER_COST ASC";
                    }
                } else {
                    $sort_cost = "";
                }
                if ($action != "") {
                    switch ($action) {
                        case ("drop"):
                            $drop_query = "delete FROM $sql_table WHERE ID = $action_id";
                            $drop_result = @mysqli_query($conn, $drop_query);
                            break;
                        case ("update"):
                            $update_query = "update $sql_table SET ORDER_STATUS = '$action_status' WHERE ID  = $action_id";
                            $update_result = @mysqli_query($conn, $update_query);
                            break;
                        default:
                            break;
                    }
                }
                //display details of status update
                echo '   
        <details id= "detailsearch">
        <summary id= "filtersearch">
        <p class = "hover-underline-animation">Filter Bar</p>
        </summary>
        <form method="get" action="manager.php">
            <fieldset id="searchdetail">
                <label class="filter" for="filter_name">Name:</label>   
                  <input class="filtername" id="filter_name" type="text"
                    name="filname" value="' . $filter_name . '" maxlength="40">
                    <label class="filter" for="filter_product">Product:</label>
                    <select id="filter_product" class="shoe" name="filter_shoe">

                    <option value="" disabled selected hidden>Select your Product</option>
                    <option value="Basketball" ' . ($filter_shoe == "Basketball" ? 'selected' : '') . ' >Basketball - 100.00$</option>
                    <option value="Soccer" ' . ($filter_shoe == "Socker" ? 'selected' : '') . '>Soccer - 100.00$</option>
                    <option value="Running" ' . ($filter_shoe == "Running" ? 'selected' : '') . '>Running - 100.00$</option>
                    <option value="Tennis" ' . ($filter_shoe == "Tennis" ? 'selected' : '') . '>Tennis - 100.00$</option>
                    <option value="Lifestyle" ' . ($filter_shoe == "Lifestyle" ? 'selected' : '') . '>Lifestyle - 100.00$</option>
                    <option  value=""' . ($filter_shoe == "" ? 'selected' : '') . '>All</option>

                      </select>

                      <label class="filter" for="filter_status">Status:</label>
                      <select name="filter_status" id="filter_status">
                    
                        <option value="Pending" ' . ($filter_status == "Pending" ? 'selected' : '') . '>Pending</option>
                        <option value="Fulfilled" ' . ($filter_status == "Fulfilled" ? 'selected' : '') . '>Fulfilled</option>
                        <option value="Paid" ' . ($filter_status == "Paid" ? 'selected' : '') . '>Paid</option>
                        <option value="Archived" ' . ($filter_status == "Archived" ? 'selected' : '') . '>Archived</option>
                        <option value="" ' . ($filter_status == "" ? 'selected' : '') . '>All</option>
                      </select>

                      <label class="filter" for="sort_cost">Sort by cost:</label>
                      <select name="sort_cost" id="sort_cost">
                    
                        <option value="" ' . ($sort_cost == "" ? 'selected' : '') . '>Default</option>

                        <option value="sutd" ' . ($sort_cost == "sutd" ? 'selected' : '') . '>DESC</option>
                        <option value="sdtu" ' . ($sort_cost == "sdtu" ? 'selected' : '') . '>ASC</option>
                        
                      </select>
                      
                      
                      <input type="submit" id="submit" class ="btn-submitdetail"
                        value="Search">
            </fieldset>

        </form>
        </details>
        <div class="advancefil">
        <details id="detailsearch3">
            <summary id="filtersearch3">
                <p class="hover-underline-animation">Advance Filter</p>
            </summary>
            <form method="post" action="manager.php">
                <fieldset>
                    <p>
                        <label><b>Best Selling Product: </b></label>
                        <span>
                            <input type="radio" id="showBest" name="bestSelling" value="yes">
                            <label for="showBest">Show</label>
                        </span>
                        <span>
                            <input type="radio" id="noShowBest" name="bestSelling" value="no" checked>
                            <label for="noShowBest">Hide</label>
                        </span>
                    </p>
                    <br>
                    <p>
                        <label><b>Stautus Summary: </b></label>
                        <span>
                            <input type="radio" id="showStatusNumber" name="statusNumber" value="yes">
                            <label for="showStatusNumber">Show</label>
                        </span>
                        <span>
                            <input type="radio" id="noShowStatusNumber" name="statusNumber" value="no" checked>
                            <label for="noShowStatusNumber">Hide</label>
                        </span>
                    </p>
                    <br>
                    <input class="btn-submitdetail" type="submit" value="Search" name="Check">
                </fieldset>

            </form>
        </details>
    </div>
    </div>
        
        ';
        //select the ID in table
                $query = "select ID, CUST_NAME, ORDER_PRODUCT, ORDER_QUANTITY, FEATURE, ORDER_COST, ORDER_TIME,  ORDER_STATUS from $sql_table Where CUST_NAME like '$filter_name%' && ORDER_PRODUCT like '$filter_shoe%' && ORDER_STATUS like '$filter_status%' ";
                if ($sort_cost != "") {
                    $query .= $sort_query;
                }
                $result = @mysqli_query($conn, $query);
                if (!$result) {
                    echo "<p>Something is wrong with ", $query, "</p>";
                } else {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["ID"];
                        $cust_name = $row["CUST_NAME"];
                        $order_product = $row["ORDER_PRODUCT"];
                        $order_quantity = $row["ORDER_QUANTITY"];
                        $order_feature = $row["FEATURE"];
                        $order_cost = $row["ORDER_COST"];
                        $order_time = $row["ORDER_TIME"];
                        $order_status = $row["ORDER_STATUS"];
                        echo '
              <form id="drop_' . $id . '" method="get" action="manager.php" hidden>
               <input type="text" name="action"  value="drop">
               <input type="text" name="id"  value="' . $id . '">
              </form>
            ';
                        echo '
              <form id="update_' . $id . '" method="get" action="manager.php" hidden>
               <input type="text" name="action"  value="update">
               <input type="text" name="id"  value="' . $id . '">
              </form>
            ';
                    }
                    echo '
        <div class="table-wrapper">         
        <table class="fl-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Order Date</th>
            <th>Name</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Feature</th>
            <th>Total Cost</th>
            <th>Status</th>
            <th>Drop</th>
            <th>Update</th>
        </tr>
        </thead>
        
        ';
                    //content for manager table
                    $result = @mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["ID"];
                        $cust_name = $row["CUST_NAME"];
                        $order_product = $row["ORDER_PRODUCT"];
                        $order_quantity = $row["ORDER_QUANTITY"];
                        $order_feature = $row["FEATURE"];
                        $order_cost = $row["ORDER_COST"];
                        $order_time = $row["ORDER_TIME"];
                        $order_status = $row["ORDER_STATUS"];
                        echo '
            <tbody>
            <tr>
              <td>' . $id . '</td>
              <td>' . $order_time . '</td>
              <td>' . $cust_name . '</td>
              <td>' . $order_product . '</td>
              <td>' . $order_quantity . '</td>
              <td>' . $order_feature . '</td>
              <td>' . $order_cost . '</td>
              
              <td>
                <select name="status" class = "btn-submitdetail" form="update_' . $id . '">
                  <option value="Pending" ' . ($order_status == "Pending" ? 'selected' : '') . '>Pending</option>
                  <option value="Fulfilled" ' . ($order_status == "Fulfilled" ? 'selected' : '') . '>Fulfilled</option>
                  <option value="Paid" ' . ($order_status == "Paid" ? 'selected' : '') . '>Paid</option>
                  <option value="Archived" ' . ($order_status == "Archived" ? 'selected' : '') . '>Archived</option>
                </select></td>
              <td><input type="submit" value="Drop" class="btn-submitdetail" form="drop_' . $id . '"></td>
              <td><input type="submit" value="Update" class="btn-submitdetail" form="update_' . $id . '"></td>
          </tr> 
          </tbody>
     
          ';
                    }

                    mysqli_free_result($result);
                }
                mysqli_close($conn);
            }
            ?>
            </table>
        </article>
    </div>
    <!-- /*enhancement -->
   
    <!-- Enhancement back-end -->

    <?php
    //if enhancement form was submitted
    if (isset($_POST["Check"])) {
        require_once('settings.php');        //Acquire connection to database
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);    //connect to database

        if (!$conn) {
            echo "<h2 class='align-center'>Unable to connect to the database.</h2>";
        } else {
            if ($_POST["bestSelling"] == "yes" || $_POST["statusNumber"] == "yes") {
                $query = "SELECT * FROM orders";
                $result = mysqli_query($conn, $query);                //execute the query and store the result into result pointer
                if (!$result) {
                    echo "<h2 class='align-center'>Failed to execute query: ", $query, ".</h2>";
                } else {
                    $basketballCount = 0;
                    $soccerCount = 0;
                    $runningCount = 0;
                    $tennisCount = 0;
                    $lifestyleCount = 0;
                    $pendingCount = 0;
                    $fulfilledCount = 0;
                    $paidCount = 0;
                    $archivedCount = 0;
                    while ($record = mysqli_fetch_assoc($result)) {                    //fetch all the records
                        // if showing best selling product was chosen
                        if ($_POST["bestSelling"] == "yes") {
                            if (strpos($record["ORDER_PRODUCT"], "Basketball") !== false)
                                $basketballCount++;
                            if (strpos($record["ORDER_PRODUCT"], "Soccer") !== false)
                                $soccerCount++;
                            if (strpos($record["ORDER_PRODUCT"], "Running") !== false)
                                $runningCount++;
                            if (strpos($record["ORDER_PRODUCT"], "Tennis") !== false)
                                $tennisCount++;
                            if (strpos($record["ORDER_PRODUCT"], "Lifestyle") !== false)
                                $lifestyleCount++;
                        }
                        // if Order Status was chosen
                        if ($_POST["statusNumber"] == "yes") {
                            if ($record["ORDER_STATUS"] == "Pending")
                                $pendingCount++;
                            if ($record["ORDER_STATUS"] == "Fulfilled")
                                $fulfilledCount++;
                            if ($record["ORDER_STATUS"] == "Paid")
                                $paidCount++;
                            if ($record["ORDER_STATUS"] == "Archived")
                                $archivedCount++;
                        }
                    }
                    //count products
                    echo '<h2 class="extratop">Advance report result</h2>';
                    if ($_POST["bestSelling"] == "yes") {
                        $max = $basketballCount;
                        $name = "Basketball";
                        if ($soccerCount > $max) {
                            $max = $soccerCount;
                            $name = "Soccer";
                        }
                        if ($runningCount > $max) {
                            $max = $runningCount;
                            $name = "Running";
                        }
                        if ($tennisCount > $max) {
                            $max = $tennisCount;
                            $name = "Tennis";
                        }
                        if ($lifestyleCount > $max) {
                            $max = $lifestyleCount;
                            $name = "Lifestyle";
                        }
                        echo '<p class = "extracontent">Best selling product is: '.$name.' <b>('.$max.')</b>.</p>';  //print reseults
                    }
                    if ($_POST["statusNumber"] == "yes") {
                        echo ' 
                        <p class = "extracontent">Status Summary: </p>
                        <div class="table-wrapper">         
                            <table class="fl-table">
                            <thead>
                            <tr>
                                <th>PENDING</th>
                                <th>FULFILLED</th>
                                <th>PAID</th>
                                <th>ARCHIVED</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                              <td>'.$pendingCount.'</td>
                              <td>'.$fulfilledCount.'</td>
                              <td>'.$paidCount.' </td>
                              <td>'.$archivedCount.'</td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                             ';
                    }
                }
            }
            mysqli_close($conn);
        }
    }
    ?>
    </div>
    <div id="managefooter">
        <?php include_once 'includes/footer.inc'; 
       ?>
    </div>
</body>

</html>