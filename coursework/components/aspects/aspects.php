<?php include '../../db.php'; 
    session_start(); ?> 

    <div class="aspects-new t-b-22-b">
        Новый аспект
    </div>
    <div class="aspects-string">
        <div class="name">
            Название аспекта
        </div>
        <div class="tags">
            Теги
        </div>
        <div class="action">
            Изменения
        </div>
    </div>
    <?php
        $aspects = mysqli_query($link, "SELECT * FROM `aspects` WHERE id_project = {$_POST["id_project"]}");
        while ($aspect = mysqli_fetch_assoc($aspects)){ 
        ?>
    <div class="aspects-string">
        <div class="name">
            <a href="aspect.php?id-project=<?php echo $_POST["id_project"]?>&id-aspect=<?php echo $aspect["id"]?>"> <?php echo $aspect["name"]?> </a>
        </div>
        <div class="tags">
            <div class="tags-string">
            <?php  $tags = mysqli_query($link, "SELECT `tags`.*, `tag_aspects`.`id_aspects` FROM `tags` 
            LEFT JOIN `tag_aspects` ON `tag_aspects`.`id_tags` = `tags`.`id` WHERE `tag_aspects`.`id_aspects` = {$aspect["id"]};");
            while ($tag = mysqli_fetch_assoc($tags)){ ?>
                <div class="tag" style="background-color: <?php echo $tag["color"]?>;">
                    <?php echo $tag["name"]?>
                </div>
                <?php } ?>
            </div>
            <img class="tags-editor" name="<?php echo $aspect["name"]?>" id="<?php echo $aspect["id"]?>" src="images/table-editing.png" alt="">
        </div>
        <div class="action">
                <img class="aspect-editor" id="<?php echo $aspect["id"]?>" src="images/table-editing.png" alt="">
                <img class="aspect-delete" id="<?php echo $aspect["id"]?>" src="images/delete-box.png" alt="">
        </div>
    </div>
    <?php } ?>
