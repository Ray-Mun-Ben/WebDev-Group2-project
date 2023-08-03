<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Check if the form is submitted (the submit button is clicked)
if (isset($_POST['submit'])) {

    // Retrieve user input from the form
    $AutoID = $_POST['autoid'];
    $Name = $_POST['name'];
    $ID = $_POST['id'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    // Original SQL query (without prepared statements - not recommended for production)
    $sql = "UPDATE `user` SET Name='$Name', ID='$ID', Email='$Email', Password='$Password' WHERE AutoID=$AutoID";

    // Execute the SQL query using mysqli_query
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        echo "Data updated successfully";
        // Redirect back to user.php after the update is successful
        header('Location: user.php');
        exit(); // Ensure that no more code is executed after the redirect
    } else {
        // In case of an error, display the MySQL error message
        die(mysqli_error($con));
    }
}

// Check if the updateid parameter is set and retrieve the user details from the database
if (isset($_GET['updateid'])) {
    $AutoID = $_GET['updateid'];

    // Prepare the SQL query with a parameterized query
    $sql = "SELECT * FROM `user` WHERE AutoID = $AutoID";

    // Execute the SQL query using mysqli_query
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the user details
        $row = mysqli_fetch_assoc($result);

        // Free the result set
        mysqli_free_result($result);
    } else {
        // In case of an error, display the MySQL error message
        die(mysqli_error($con));
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Update Form</title>
    <link rel="stylesheet" href="thecss.css">
</head>
<body>
    <div class="container">
        <h1>User Update</h1>
        <form id="updateForm" method="post" >
            <input type="hidden" name="autoid" value="<?php echo $row['AutoID']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" required>

            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $row['ID']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $row['Password']; ?>" required>

            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
