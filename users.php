<?php
if ($_GET["q"]) {
    $query = $_GET["q"];
    if (strlen($query) >= 3) {
      $statisticsJson = file_get_contents("https://api.roblox.com/users/get-by-username?username=" . $query);
      $statisticsObj = json_decode($statisticsJson, true);
      if ($statisticsObj['Id']) {
        $Id = $statisticsObj['Id'];
        $getFriendsJSON = file_get_contents("https://friends.roblox.com/v1/users/". $statisticsObj["Id"] ."/friends/count");
        $friendCount = json_decode($getFriendsJSON, true);
        $getFollowersJSON = file_get_contents("https://friends.roblox.com/v1/users/". $statisticsObj["Id"] ."/followers/count");
        $followersCount = json_decode($getFollowersJSON, true);
        $getFollowingCountJSON = file_get_contents("https://friends.roblox.com/v1/users/". $statisticsObj["Id"] ."/followings/count");
        $followingCount = json_decode($getFollowingCountJSON, true);
        $getStatusJSON = file_get_contents("https://users.roblox.com/v1/users/". $statisticsObj["Id"] ."/status");
        $statusMsg = json_decode($getStatusJSON, true);
        $getDesc = file_get_contents("https://users.roblox.com/v1/users/". $statisticsObj["Id"]);
        $descMsg = json_decode($getDesc, true);
        
      }
    }
  }
  $api->Id = $Id;
  $api->Friends = $friendCount["count"];
  $api->Followers = $followersCount["count"];
  $api->Following = $followingCount["count"];
  
  $rJSON = json_encode($api);
  header('Content-Type: application/json');
  echo $rJSON;
?>