<?php include '../../db.php';  
    session_start();

    $tags = mysqli_query($link, "SELECT `tags`.* FROM `tags` 
        LEFT JOIN `project` ON `project`.`id` = `tags`.`id_project`
        WHERE `tags`.`id_project` = {$_GET["id_project"]} AND `tags`.`id` = {$_GET["id_tag"]} AND `project`.`id_users` = {$_SESSION['user']['id']}");
        while ($tag = mysqli_fetch_assoc($tags)){ ?><img class="check-img" src="images/check.png" alt=""><?php echo $tag["name"]; }?>
