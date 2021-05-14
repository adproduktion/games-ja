<?php
include 'db.php';
include 'functions.php';
$file_name = basename(__FILE__);
RelogSessionNon($_SESSION['user'], $file_name);

$project_id = $_GET["id-project"];
RelogProjectNon($project_id);

$project_result = mysqli_query($link, "SELECT * FROM `project` WHERE id='$project_id'");

include 'header.php'
?>

        <section class="section-content">    
            <div class="content-aspects">
                <div class="chapters">
                    <div class="chapters-new t-b-22-b">
                        Новая глава
                    </div>
                    <div class="chapters-string">
                        <div class="number">
                            №
                        </div>
                        <div class="name">
                            Название главы
                        </div>
                        <div class="scene">
                            Кол-во сцен
                        </div>
                        <div class="action">
                            Изменения
                        </div>
                    </div>
                    <div class="chapters-string <?php if(!$_GET['id-chapter'] || $_GET['id-chapter']=='undefined'){echo "string-active"; }?>">
                        <div class="number">
                        </div>
                        <div class="name">
                            Сцены вне глав
                        </div>
                        <div class="scene">

                        </div>
                        <div class="action">
                        </div>
                    </div>
                    <?php 
                        $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_GET['id-project']} AND `number` != 0 ORDER BY `number` ASC");
                        while ($chapter = mysqli_fetch_assoc($chapters)){ 
                        ?>
                        <div class="chapters-string <?php if($_GET['id-chapter'] == $chapter["id"]){echo "string-active"; }?>" id="<?php echo $chapter["id"]; ?>">
                            <div class="number">
                                <?php echo $chapter["number"]?>
                            </div>
                            <div class="name">
                                <a href="aspects.php?id-chapter=<?php echo $chapter["id"]?>"> <?php echo $chapter["name"]?> </a>
                            </div>
                            <div class="scene">

                            </div>
                            <div class="action">
                                    <div class="chapter-editor" id="<?php echo $chapter["id"]?>"></div>
                                    <div class="chapter-delete" id="<?php echo $chapter["id"]?>"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                        $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_GET['id-project']} AND `number` = 0");
                        while ($chapter = mysqli_fetch_assoc($chapters)){ 
                        ?>
                    <div class="chapters-string <?php if($_GET['id-chapter'] == $chapter["id"]){echo "string-active"; }?>" id="<?php echo $chapter["id"]; ?>">
                        <div class="number">
                            Нет
                        </div>
                        <div class="name">
                            <a href="aspects.php?id-chapter=<?php echo $chapter["id"]?>"> <?php echo $chapter["name"]?> </a>
                        </div>
                        <div class="scene">

                        </div>
                        <div class="action">
                                <img class="chapter-editor" id="<?php echo $chapter["id"]?>" src="images/table-editing.png" alt="">
                                <img class="chapter-delete" id="<?php echo $chapter["id"]?>" src="images/delete-box.png" alt="">
                        </div>
                    </div>
                    <?php } ?>
                </div> 
                <div class="scenes">
                    <div class="scenes-new t-b-22-b" id="<?php echo $_GET['id-chapter']?>">
                        Новая сцена
                    </div>
                    <div class="scenes-string">
                        <div class="number">
                            №
                        </div>
                        <div class="name">
                            Название
                        </div>
                        <div class="discription">
                            Описание
                        </div>
                        <div class="action">
                            Изменения
                        </div>
                    </div>
                    <?php if ($_GET['id-chapter'] && $_GET['id-chapter']!='undefined'){
                        $scenes = mysqli_query($link, "SELECT * FROM `scenes` WHERE id_project = {$_GET['id-project']} AND id_chapters = {$_GET['id-chapter']} AND number != 0 ORDER BY `number` ASC");                    
                        while ($scene = mysqli_fetch_assoc($scenes)){ ?>
                        <div class="scenes-string">
                            <div class="number">
                                <?php echo $scene["number"]?>
                            </div>
                            <div class="name">
                                <a href="#"> <?php echo $scene["name"]?> </a>
                            </div>
                            <div class="discription">
                            <?php echo $scene["discription"]?>
                            </div>
                            <div class="action">
                                <img class="scene-editor" id="<?php echo $scene["id"]?>" src="images/table-editing.png" alt="">
                                <img class="scene-delete" id="<?php echo $scene["id"]?>" src="images/delete-box.png" alt="">
                            </div>
                        </div>
                    <?php } $scenes = mysqli_query($link, "SELECT * FROM `scenes` WHERE id_project = {$_GET['id-project']} AND id_chapters = {$_GET['id-chapter']} AND number = 0");                    
                        while ($scene = mysqli_fetch_assoc($scenes)){?>
                        <div class="scenes-string">
                            <div class="number">
                                <?php echo $scene["number"]?>
                            </div>
                            <div class="name">
                                <a href="#"> <?php echo $scene["name"]?> </a>
                            </div>
                            <div class="discription">
                            <?php echo $scene["discription"]?>
                            </div>
                            <div class="action">
                                <img class="scene-editor" id="<?php echo $scene["id"]?>" src="images/table-editing.png" alt="">
                                <img class="scene-delete" id="<?php echo $scene["id"]?>" src="images/delete-box.png" alt="">
                            </div>
                        </div>
                    <?php }}else{  
                        $scenes = mysqli_query($link, "SELECT * FROM `scenes` WHERE id_project = {$_GET['id-project']} AND `id_chapters` IS NULL");                    
                        while ($scene = mysqli_fetch_assoc($scenes)){ ?>
                        <div class="scenes-string">
                            <div class="number">
                                <?php echo $scene["number"]?>
                            </div>
                            <div class="name">
                                <a href="#"> <?php echo $scene["name"]?> </a>
                            </div>
                            <div class="discription">
                            <?php echo $scene["discription"]?>
                            </div>
                            <div class="action">
                                <img class="scene-editor" id="<?php echo $scene["id"]?>" src="images/table-editing.png" alt="">
                                <img class="scene-delete" id="<?php echo $scene["id"]?>" src="images/delete-box.png" alt="">
                            </div>
                        </div>
                    <?php }} ?>                    
                </div>
            </div> 
        </section>

    </div> 

    <div class="bg-new-chapter">
        <div class="form-new-chapter">
            
        </div>
    </div>  
    <div class="bg-new-scene">
        <div class="form-new-scene">
            
        </div>
    </div> 
</body>
    <script>
            var id_project='<?= $_GET["id-project"] ?>';
    </script>                              
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/tags.js"></script>

    
</html>


