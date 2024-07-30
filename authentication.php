<?php
// Used to pass data between PHP pages
session_start();
?>

<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:login.php');        //redirect to login.php if attempted to access directly
    exit;
}
require_once("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
    
    function get_query_param($name, $default_value)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default_value;
    }

    // Mercury uses PHP 5.4 which doesn't support null coalesce with undefined assoc array keys
    function array_key_coalesce($arr, $key, $default)
    {
        if (array_key_exists($key, $arr))
            return $arr[$key];

        return $default;
    }
    //For security purposes users databases will be created directly in phphmyadmin (so no auto create function for this)
    //Because I didn't do the registration form (only login )
    // Checks that the username and password entered match a user in the users table
    if (isset($_POST["username"]) && isset($_POST['password'])) {
        $username = sanitise_input($_POST["username"]);
        $password = sanitise_input($_POST["password"]);

        $user_query_sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password';";
        $result = $conn->query($user_query_sql);

        // If there no matching users, redirect to login page
        if ($result->num_rows == 0) {
            header("Location: ./login.php?error_msg=AccessDenied");
        } else {
            // Otherwise, add the authenticated variable to the session and redirect manager page
            $_SESSION["authenticated"] = true;
            header("Location: ./manager.php");
        }
    }
}
?>
