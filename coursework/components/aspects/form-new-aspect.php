<?php include '../../db.php';  
    session_start();
    if($_POST['id_aspect']){
        $aspects = mysqli_query($link, "SELECT * FROM `aspects` WHERE id = {$_POST['id_aspect']} AND id_project = {$_POST['id_project']}");
        while ($aspect = mysqli_fetch_assoc($aspects)){ 
    ?>
        <div class="form-aspect-header t-w-24">
            <?php echo  $aspect["name"]; ?>
        </div>
            <div class="form-aspect-aspect-border">
                <div class="form-aspect-aspect">                   
                    <div class="input-ccs" class="new-aspect-name" style="width: 100%;">      
                        <input type="text" id="new-aspect-name" style="width: 100%;" value="<?php echo  $aspect["name"]; ?>" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Название аспекта</label>
                    </div>  
                </div>
            </div>
            <div class="form-aspect-footer">
                <div class="t-b-18 new-aspect-save" id="<?php echo $_POST['id_aspect']; ?>">
                    Сохранить
                </div>
                <div class="t-b-18 close" >
                    Закрыть
                </div>
            </div>
        
        <!-- <input class="new-aspect-name" id="new-aspect-name" type="text" value="<?php echo $aspect["name"]?>"> -->
        <!-- <button class="button-css new-aspect-save" id="<?php echo $_POST['id_aspect']; ?>">
            Изменить
        </button> -->
    <?php }}else{ ?>
        
        <div class="form-aspect-header t-w-24">
            Новый аспект
        </div>
        <div class="form-aspect-aspect-border">
            <div class="form-aspect-aspect">                   
                <div class="input-ccs" class="new-aspect-name" style="width: 100%;">      
                    <input type="text" id="new-aspect-name" style="width: 100%;" value="" required>
                    <span class="bar" style="width: 100%;"></span>
                    <label>Название аспекта</label>
                </div>
            </div>
        </div>
        <div class="form-aspect-footer">
            <div class="t-b-18 new-aspect-create" id="<?php echo $_POST['id_aspect']; ?>">
                    Создать
            </div>
            <div class="t-b-18 close" >
                Закрыть
            </div>
        </div>
        
        <!-- <input class="new-aspect-name" id="new-aspect-name" type="text"> -->
        <!-- <button class="button-css new-aspect-create">
            Создать
        </button> -->
        
    <?php } ?>


