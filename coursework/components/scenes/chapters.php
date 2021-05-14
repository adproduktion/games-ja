<?php include '../../db.php'; 
    session_start(); ?> 

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
                    <div class="chapters-string <?php if(!$_POST['id-chapter'] || $_POST['id-chapter']=='undefined'){echo "string-active"; }?>">
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
                        $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND `number` != 0 ORDER BY `number` ASC");
                        while ($chapter = mysqli_fetch_assoc($chapters)){ 
                        ?>
                        <div class="chapters-string <?php if($_POST['id-chapter'] == $chapter["id"]){echo "string-active"; }?>" id="<?php echo $chapter["id"]; ?>">
                            <div class="number">
                                <?php echo $chapter["number"]?>
                            </div>
                            <div class="name">
                                <a href="chapters.php?id-chapter=<?php echo $chapter["id"]?>"> <?php echo $chapter["name"]?> </a>
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
                        $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND `number` = 0");
                        while ($chapter = mysqli_fetch_assoc($chapters)){ 
                        ?>
                    <div class="chapters-string <?php if($_POST['id-chapter'] == $chapter["id"]){echo "string-active"; }?>" id="<?php echo $chapter["id"]; ?>">
                        <div class="number">
                            Нет
                        </div>
                        <div class="name">
                            <a href="chapters.php?id-chapter=<?php echo $chapter["id"]?>"> <?php echo $chapter["name"]?> </a>
                        </div>
                        <div class="scene">

                        </div>
                        <div class="action">
                                <img class="chapter-editor" id="<?php echo $chapter["id"]?>" src="images/table-editing.png" alt="">
                                <img class="chapter-delete" id="<?php echo $chapter["id"]?>" src="images/delete-box.png" alt="">
                        </div>
                    </div>
                    <?php } ?>


    



