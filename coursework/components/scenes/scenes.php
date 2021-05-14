<?php include '../../db.php'; 
    session_start(); ?> 

                    <div class="scenes-new t-b-22-b" id="<?php echo $_POST['id-chapter']?>">
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
                    <?php if ($_POST['id-chapter']){
                        $scenes = mysqli_query($link, "SELECT * FROM `scenes` WHERE id_project = {$_POST['id-project']} AND id_chapters = {$_POST['id-chapter']} AND number != 0 ORDER BY `number` ASC");                    
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
                    <?php } $scenes = mysqli_query($link, "SELECT * FROM `scenes` WHERE id_project = {$_POST['id-project']} AND id_chapters = {$_POST['id-chapter']} AND number = 0");                    
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
                        $scenes = mysqli_query($link, "SELECT * FROM `scenes` WHERE id_project = {$_POST['id-project']} AND `id_chapters` IS NULL");                    
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
                    
                    


