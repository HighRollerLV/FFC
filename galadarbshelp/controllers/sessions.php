<?php
function userID(){
    if(isset($_SESSION['logged'])){
        $userID = $_SESSION['user'];
        return $_SESSION['user'];
    }else{
         header("Location:./register.php");
    }
}

function logOut(){
    if(isset($_POST['logOut'])){
        session_destroy();
        header("Location:./register.php");
    }
}

function nickName($conn) {
    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['user'];
        $stmt = $conn->prepare("SELECT nickname FROM loginhelp WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<h3 class='nickname'>" . htmlspecialchars($row['nickname']) . "</h3>";
            }
        }
        $stmt->close();
    }
}

function currency($conn){
    if(isset($_SESSION['user'])){
        $userID = $_SESSION['user'];
        $stmt = $conn->prepare("SELECT currency FROM loginhelp WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result){
            $row = $result->fetch_assoc();
            return $row['currency'];
        }
    }
}

function nickNameProfile($conn){
    if(isset($_SESSION['user'])){
        $userID = $_SESSION['user'];
        $stmt = $conn->prepare("SELECT nickname FROM loginhelp WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo $row['nickname'];
            }
        }
        $stmt->close();
    }
}

function email($conn){
    if(isset($_SESSION['user'])){
        $userID = $_SESSION['user'];
        $sql = "SELECT email FROM loginhelp WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result){
            while($row = $result->fetch_assoc()){
                echo $row['email'];
            }
        }
    }
}

function profilePic($conn){
    if(isset($_SESSION['user'])){
        $userID = $_SESSION['user'];
        $sql = "SELECT * FROM loginhelp WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result){
            while($row = $result->fetch_assoc()){
                echo $row['profilePic'];
            }
        }
    }
}

function firstName($conn) {
    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['user'];
        $stmt = $conn->prepare("SELECT firstName FROM loginhelp WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['firstName'];
        }
        $stmt->close();
    }
}

function lastName($conn) {
    if(isset($_SESSION['user'])) {
        $userID = $_SESSION['user'];
        $sql = "SELECT lastName FROM loginhelp WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result) {
            while($row = $result->fetch_assoc()) {
                echo $row['lastName'];
            }
        }
    }
}

function location($conn) {
    if(isset($_SESSION['user'])) {
        $userID = $_SESSION['user'];
        $stmt = $conn->prepare("SELECT * FROM loginhelp WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result) {
            while($row = $result->fetch_assoc()){
                echo $row['location'];
            }
        }
    }
}

function age($conn){
    if(isset($_SESSION['user'])){
        $userID = $_SESSION['user'];
        $stmt = $conn->prepare("SELECT * FROM loginhelp WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result){
            while($row = $result->fetch_assoc()){
                echo $row['age'];
            }
        }
    }
}

function loggedIn() {
    if(isset($_SESSION['logged'])){
        header("Location:./index.php");
    }
}

?>

