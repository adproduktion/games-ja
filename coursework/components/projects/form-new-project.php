<?php include '../../db.php';  
    session_start();
    if($_GET['id_project']){
        $projects = mysqli_query($link, "SELECT * FROM `project` WHERE id = {$_GET['id_project']} AND id_users = {$_SESSION['user']['id']}");
        while ($project = mysqli_fetch_assoc($projects)){ 
    ?>
        <div class="form-project-header t-w-24">
            <?php echo  $project["name"]; ?>
        </div>
            <div class="form-project-project-border">
                <div class="form-project-project">                   
                    <div class="input-ccs" class="new-project-name" style="width: 100%;">      
                        <input type="text" id="new-project-name" style="width: 100%;" value="<?php echo  $project["name"]; ?>" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Название проекта</label>
                    </div>  
                </div>
            </div>
            <div class="form-project-footer">
                <div class="t-b-18 new-project-save" id="<?php echo $_GET['id_project']; ?>">
                    Сохранить
                </div>
                <div class="t-b-18 close" >
                    Закрыть
                </div>
            </div>
        
        <!-- <input class="new-project-name" id="new-project-name" type="text" value="<?php echo $project["name"]?>"> -->
        <!-- <button class="button-css new-project-save" id="<?php echo $_GET['id_project']; ?>">
            Изменить
        </button> -->
    <?php }}else{ ?>
        
        <div class="form-project-header t-w-24">
            Новый проект
        </div>
        <div class="form-project-project-border">
            <div class="form-project-project">                   
                <div class="input-ccs" class="new-project-name" style="width: 100%;">      
                    <input type="text" id="new-project-name" style="width: 100%;" value="" required>
                    <span class="bar" style="width: 100%;"></span>
                    <label>Название проекта</label>
                </div>
            </div>
        </div>
        <div class="form-project-footer">
            <div class="t-b-18 new-project-create">
                    Создать
            </div>
            <div class="t-b-18 close" >
                Закрыть
            </div>
        </div>
        
        <!-- <input class="new-project-name" id="new-project-name" type="text"> -->
        <!-- <button class="button-css new-project-create">
            Создать
        </button> -->
    <?php } ?>

            