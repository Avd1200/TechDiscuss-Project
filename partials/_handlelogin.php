<?php
$showError = false;
if($_SERVER['REQUEST_METHOD'] =="POST"){
    include '_dbconnect.php';
    $email = $_POST['loginemail'];
    $pass = $_POST['loginpass'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['Sno'];
                $_SESSION['useremail'] = $email;
                echo "logged in" . $email;
            }
            header("Location: /Forum/index.php");
    }
}
?>