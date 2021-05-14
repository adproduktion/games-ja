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
                <div class="aspects">
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
                        $aspects = mysqli_query($link, "SELECT * FROM `aspects` WHERE id_project = $project_id");
                        while ($aspect = mysqli_fetch_assoc($aspects)){ 
                        ?>
                    <div class="aspects-string">
                        <div class="name">
                            <a href="aspect.php?id-project=<?php echo $_GET["id-project"]?>&id-aspect=<?php echo $aspect["id"]?>"> <?php echo $aspect["name"]?> </a>
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
                </div> 
            </div> 
        </section>

    </div>  
    <section class="bg-tags">
        <div class="form-tags">
            <div class="form-tags-header t-w-24">
                Теги
            </div>
            <div class="form-tags-tags-border">
                <div class="form-tags-tags">                   
                    <div class="tags">
                        <div class="title-tags" id="main-tags1">
                            <div class="t-b-18">
                            Убрать или добавить теги к "<span class="title-tags-aspects t-b-18"></span>"
                            </div>
                            <div>
                                <img src="images/arrow-top.png" alt="">
                            </div>
                        </div>
                        <div class="main-tags1">
                            <!-- <?php $tags = mysqli_query($link, "SELECT * FROM `tags` WHERE id_project = $project_id");
                                while ($tag = mysqli_fetch_assoc($tags)){ ?>
                                <div class="tag" style="background-color: <?php echo $tag["color"]?>;">
                                    <?php if (0 < mysqli_num_rows(mysqli_query($link, "SELECT * FROM `tag_aspects` WHERE id_tags = {$tag["id"]} AND id_aspects = 1"))){?>
                                        <img class="check-img" src="images/check.png" alt="">
                                    <?php } echo $tag["name"];?>
                                </div>
                            <?php }?> -->
                        </div>
                    </div>
                    <div class="new-tags">
                        <div class="title-tags" id="main-tags2">
                            <div class="t-b-18">
                                Создать новый тег
                            </div>
                            <div>
                                <img src="images/arrow-bottom.png" alt="">
                            </div>
                        </div>
                        <div class="main-tags2">
                            <div class="new-tags-title">
                                <div class="input-ccs">      
                                    <input id="name-tag" type="text" required>
                                    <span class="bar"></span>
                                    <label>Название</label>
                                </div>
                                <!-- <input type="text"> -->
                                <div class="preview">
                                    <div class="title t-b-16">
                                        Предпросмотр
                                    </div>
                                    <div class="tag" id="tag-preview"  style="background-color: #FE3C00;"></div>
                                </div>
                            </div>
                            <div class="palette">
                                <div class="pallete-color" style="background-color: #FE3C00;"><img src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #E91D62;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #691A99;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #B29CDA;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #304EFE;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #019587;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #2E7C31;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #B0B42B;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #FCD633;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #FE8D00;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #785446;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="pallete-color" style="background-color: #00E6FF;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                            </div>
                            <button class="button-css create-new-tag" disabled>
                                Созадать
                            </button>
                        </div>
                    </div>
                    <div class="editor-tags">
                        <div class="title-tags" id="main-tags3">
                            <div class="t-b-18">
                                Редактировать тег
                            </div>
                            <div>
                                <img src="images/arrow-bottom.png" alt="">
                            </div>
                        </div>
                        <div class="main-tags3">
                            <div class="main-tags3-1">
                                
                            </div>
                            <div class="new-tags-title">
                                <div class="input-ccs">      
                                    <input id="name-tag-editor" type="text" disabled required>
                                    <span class="bar"></span>
                                    <label>Название</label>
                                </div>
                                <!-- <input type="text"> -->
                                <div class="preview">
                                    <div class="title t-b-16">
                                        Предпросмотр
                                    </div>
                                    <div class="tag" id="tag-preview-editor" style="background-color: #FE3C00;"></div>
                                </div>
                            </div>
                            <div class="palette">
                                <div class="editor-pallete-color" style="background-color: #FE3C00;"><img src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #E91D62;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #691A99;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #B29CDA;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #304EFE;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #019587;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #2E7C31;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #B0B42B;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #FCD633;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #FE8D00;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #785446;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                                <div class="editor-pallete-color" style="background-color: #00E6FF;"><img style="display: none;" src="images/check-1.png" alt=""></div>
                            </div>
                            <div class="buttons">
                                <button class="button-css editor-tag" disabled>
                                    Изменить
                                </button>
                                <button class="button-css delete-tag" disabled>
                                    Удалить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-tags-footer">
                <div class="t-b-18">
                    Закрыть
                </div>
            </div>
        </div>
    </section>
    <section class="bg-new-aspect">
        <div class="form-new-aspect">
            
        </div>
    </section>  
</body>
    <script>
            var id_project='<?= $_GET["id-project"] ?>';
    </script>                                    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/tags.js"></script>

    
</html>