<?php

  $u = $_POST['username'];
  $p = $_POST['password'];

if(isset($u) || isset($p)) {
  //Alle waarden zijn ingevuld
  LoginAdmin($u, $p);
} else {
  echo false;
}

function LoginAdmin($u, $p) {

  require '../config.php';

  //selecteer de rij waar username $u is
  $query = "SELECT * FROM admin WHERE name = '$u'";

  $result = mysqli_query($mysqli, $query);

  if ($row = mysqli_fetch_assoc($result)) { // bestaat

    if ($row['name'] == $u && $row['password'] == $p) { // in deze rij is het password gelijk aan $p
      session_start(); // start de sessie
      $_SESSION['name'] = $u;
      $_SESSION['id'] = $row['id'];
      $_SESSION['loggedin'] = true;

      $message = "You have been logged in";
      
      $Response = array(
        "message" => $message,
        "color" => "blue" 
      );

      // Send back new movie :)
      echo json_encode($Response);

    } 
        else {

          $Response = array(
            "error" => "Could not connect to user"
          );

          // Send back new movie :)
          echo json_encode($Response);
      
          // session_start();
          // session_destroy(); // maak de sessie kapot om gekke dingen te voorkomen

          // echo "not logged in!";
        }
      } else {
          $Response = array(
            "error" => "username doesnt exist"
          );

          // Send back new movie :)
          echo json_encode($Response);
      }
    }
?>