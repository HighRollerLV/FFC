<?php
// function userID(){
//     if($_SESSION['logged']){
//         $userID = $_SESSION['user'];
//         return $userID;
//     }else{
//         header("Location:index.php");
//     }
// }

// // function logOut(){
// //     if(isset($_POST['logOut'])){
// //         session_destroy();
// //         header("Location:../register.php");
// //     }
// // }

// // function nickName($conn){
// //     $userID = $_SESSION['user'];
// //     $sql = "SELECT * FROM loginhelp WHERE id = $userID";
// //     $result = select($sql, $conn);
// //         if($result){
// //             while($row = $result->fetch_assoc()){
// //                 echo $row['nickname'];
// //             }
// //         }/
// // }

// function loggedIn() {
//     if($_SESSION['logged']){
//         header("Location:index.php");
//     }
// }
?>