<?php include '../../db.php';  
    session_start();

    $tags = mysqli_query($link, "SELECT `tags`.* FROM `tags` 
        LEFT JOIN `project` ON `project`.`id` = `tags`.`id_project`
        WHERE `tags`.`id_project` = {$_GET["id_project"]} AND `project`.`id_users` = {$_SESSION['user']['id']}");
        while ($tag = mysqli_fetch_assoc($tags)){ ?>
        <div class="tag" name="<?php echo $tag["id"];?>" style="background-color: <?php echo $tag["color"]?>;"><?php echo $tag["name"];?></div>
    <?php }?>
