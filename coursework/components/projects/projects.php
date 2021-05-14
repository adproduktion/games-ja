<?php include '../../db.php';  
    session_start(); ?> 
    <div class="projects-new t-b-22-b">
        Новый проект
    </div>
    <div class="projects-string">
        <div class="name">
            Название проекта
        </div>
        <div class="scene">
            Кол-во сцен
        </div>
        <div class="aspect">
            Кол-во аспектов
        </div>
        <div class="action">
            Изменения
        </div>
    </div>
    <?php 
        $projects = mysqli_query($link, "SELECT * FROM `project` WHERE id_users = {$_SESSION['user']['id']}");
        while ($project = mysqli_fetch_assoc($projects)){ 
        ?>
    <div class="projects-string">
        <div class="name">
            <a href="aspects.php?id-project=<?php echo $project["id"]?>"> <?php echo $project["name"]?> </a>
        </div>
        <div class="scene">

        </div>
        <div class="aspect">

        </div>
        <div class="action">
                <img class="project-editor" id="<?php echo $project["id"]?>" src="images/table-editing.png" alt="">
                <img class="project-delete" id="<?php echo $project["id"]?>" src="images/delete-box.png" alt="">
        </div>
    </div>
    <?php } ?>