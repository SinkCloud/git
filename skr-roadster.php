<?php
  ob_start ();
 if (!$_POST) {
    
    header('Content-Type: application/json');
    echo '{"errors":[{"code":400,"message":"Bad request."}]}';
 }
 if ($_GET["get"]) {
     ob_clean ();
    header('Content-Type: application/json');
    echo '{"content":"Display"}';
 }
  if ($_POST) {
  $api->Id = $Id;
  $api->Friends = $friendCount["count"];
  $api->Followers = $followersCount["count"];
  $api->Following = $followingCount["count"];
  
  $rJSON = json_encode($api);
  header('Content-Type: application/json');
  echo $rJSON;
  }
?>