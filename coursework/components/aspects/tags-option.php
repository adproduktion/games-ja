<?php include '../../db.php';  
    session_start();

    $tags = mysqli_query($link, "SELECT `tags`.* FROM `tags` 
        LEFT JOIN `project` ON `project`.`id` = `tags`.`id_project`
        WHERE `tags`.`id_project` = {$_GET["id_project"]} AND `project`.`id_users` = {$_SESSION['user']['id']}");
        while ($tag = mysqli_fetch_assoc($tags)){ ?>
        <div class="tag" id="<?php echo $tag["id"];?>" name="<?php echo $_GET["id_aspects"];?>" style="background-color: <?php echo $tag["color"]?>;">
            <?php if (0 < mysqli_num_rows(mysqli_query($link, "SELECT * FROM `tag_aspects` WHERE id_tags = {$tag["id"]} AND id_aspects = {$_GET["id_aspects"]}"))){?>
                <img class="check-img" src="images/check.png" alt="">
            <?php } echo $tag["name"];?>
        </div>
    <?php }?>

    <!-- <script type="text/javascript" src="js/tags.js"></script> -->