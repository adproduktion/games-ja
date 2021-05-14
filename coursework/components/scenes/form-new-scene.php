<?php include '../../db.php';  
    session_start();
    if($_POST['id-scene']){
        $scenes = mysqli_query($link, "SELECT * FROM `scenes` WHERE id = {$_POST['id-scene']} AND id_project = {$_POST['id-project']}");
        while ($scene = mysqli_fetch_assoc($scenes)){ 
    ?>
        <div class="form-scene-header t-w-24">
            <?php echo  $scene["name"]; ?>
        </div>
            <div class="form-scene-scene-border">
                <div class="form-scene-scene">                   
                    <div class="input-ccs" class="new-scene-name" style="width: 100%;">      
                        <input type="text" id="new-scene-name" style="width: 100%;" value="<?php echo  $scene["name"]; ?>" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Название сцены</label>
                    </div>  
                    <div class="select-block">
                    <span class="t-b-16">Глава</span>
                        <select class="new-chapter-number select-css" style="width: 200px;">
                            <option value="NULL" <?php if ($_POST['id-chapter'] == 'undefined' || $scene['id_chapters'] == NULL){ echo 'selected';} ?>>
                                Сцены всне глав
                            </option>
                            <?php $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND number != 0 ORDER BY `number` ASC");
                                while ($chapter = mysqli_fetch_assoc($chapters)){ ?>
                                <option value="<?php echo $chapter["id"];?>" <?php if ($scene['id_chapters'] == $chapter['id']){ echo 'selected';} ?>>
                                    <?php echo $chapter["number"].' - '.$chapter["name"]; ?>
                                </option>
                            <?php }?>
                            <?php $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND number = 0");
                                while ($chapter = mysqli_fetch_assoc($chapters)){ ?>
                                <option value="<?php echo $chapter["id"];?>" <?php if ($scene['id_chapters'] == $chapter['id']){ echo 'selected';} ?>>
                                    <?php echo $chapter["name"]; ?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="form-scene-footer">
                <div class="t-b-18 new-scene-save" id="<?php echo $_POST['id-scene']; ?>">
                    Сохранить
                </div>
                <div class="t-b-18 close" >
                    Закрыть
                </div>
            </div>
        
        <!-- <input class="new-scene-name" id="new-scene-name" type="text" value="<?php echo $scene["name"]?>"> -->
        <!-- <button class="button-css new-scene-save" id="<?php echo $_POST['id-scene']; ?>">
            Изменить
        </button> -->
    <?php }}else{ ?>
        
        <div class="form-scene-header t-w-24">
            Новая сцена
        </div>
        <div class="form-scene-scene-border">
            <div class="form-scene-scene">                   
                <div class="input-ccs" class="new-scene-name" style="width: 100%;">      
                    <input type="text" id="new-scene-name" style="width: 100%;" value="" required>
                    <span class="bar" style="width: 100%;"></span>
                    <label>Название сцены</label>
                </div>
                <div class="select-block">
                    <span class="t-b-16">Глава</span>
                    <select class="new-chapter-number select-css" style="width: 200px;">
                        <option value="NULL" <?php if ($_POST['id-chapter'] == 'undefined'){ echo 'selected';} ?>>
                            Сцены всне глав
                        </option>
                        <?php $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND number != 0 ORDER BY `number` ASC");
                            while ($chapter = mysqli_fetch_assoc($chapters)){ ?>
                            <option value="<?php echo $chapter["id"];?>" <?php if ($_POST['id-chapter'] == $chapter['id']){ echo 'selected';} ?>>
                                <?php echo $chapter["number"].' - '.$chapter["name"]; ?>
                            </option>
                        <?php }?>
                        <?php $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND number = 0");
                            while ($chapter = mysqli_fetch_assoc($chapters)){ ?>
                            <option value="<?php echo $chapter["id"];?>" <?php if ($_POST['id-chapter'] == $chapter['id']){ echo 'selected';} ?>>
                                <?php echo $chapter["name"]; ?>
                            </option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-scene-footer">
            <div class="t-b-18 new-scene-create">
                    Создать
            </div>
            <div class="t-b-18 close" >
                Закрыть
            </div>
        </div>
        
        <!-- <input class="new-scene-name" id="new-scene-name" type="text"> -->
        <!-- <button class="button-css new-scene-create">
            Создать
        </button> -->
        
    <?php } ?>



