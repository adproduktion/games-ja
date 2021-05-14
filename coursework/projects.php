<?php
include 'db.php';
include 'functions.php';
$file_name = basename(__FILE__);
RelogSessionNon($_SESSION['user'], $file_name);


include 'header.php'
?>
        <section class="section-content">
            <div class="content-project">
                <div class="projects">
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
                </div> 
                <div class="notes">
                <?php if($_GET['id_notes'] && 0 < mysqli_num_rows(mysqli_query($link, "SELECT * FROM `notes` WHERE id_users = {$_SESSION['user']['id']} AND id = {$_GET['id_notes']}"))){?>
                    <?php $notes_editor = mysqli_query($link, "SELECT * FROM `notes` WHERE id_users = {$_SESSION['user']['id']} AND id = {$_GET['id_notes']}"); ?>                    
                        <?php while ($note_editor = mysqli_fetch_assoc($notes_editor)){ ?>
                        <div class="notes-editor-title">
                            <div class="input-ccs" style="width: 100%;">      
                                <input type="text" id="notes-editor-name" style="width: 50%;" value="<?php echo  $note_editor["name"]; ?>" required>
                                <span class="bar" style="width: 50%;"></span>
                                <label>Название</label>
                            </div> 
                            <!-- <input type="text" id="notes-editor-name" value="<?php echo  $note_editor["name"]; ?>"> -->
                            <!--<img class="notes-view1" src="../images/close.png" alt="">--> <img class="notes-close" src="../images/close.png" alt="">
                        </div>
                        <div>
                            <textarea id="editor" id="notes-editor-text"><?php echo $note_editor["text"]; ?></textarea>
                        </div>
                        <div class="notes-editor-buttons">
                            <button class="button-css notes-editor-save" id="<?php echo  $note_editor["id"]; ?>">
                                Сохранить
                            </button>  
                            <button class="button-css notes-delete" id="<?php echo  $note_editor["id"]; ?>">
                                Удалить
                            </button> 
                        </div>
                        <?php }?>
                <?php }else{ ?>
                    <div class="notes-new t-b-22-b">
                        Новая заметка
                    </div>
                    <div class="notes-string">
                        <div class="name">
                            Название
                        </div>
                        <div class="action">
                            Изменения
                        </div>
                    </div>
                    <?php $notes = mysqli_query($link, "SELECT * FROM `notes` WHERE id_users = {$_SESSION['user']['id']}"); ?>                    
                    <?php while ($note = mysqli_fetch_assoc($notes)){ ?>
                    <div class="notes-string">
                        <div class="name">
                            <a href="#"> <?php echo $note["name"]?> </a>
                        </div>
                        <div class="action">
                            <img class="notes-editor" id="<?php echo $note["id"]?>" src="images/table-editing.png" alt="">
                            <img class="notes-delete" id="<?php echo $note["id"]?>" src="images/delete-box.png" alt="">
                        </div>
                    </div>
                    <?php }}?>                   
                </div>
            </div>            
        </section>

    </div>  
    <div class="bg-new-project">
        <div class="form-new-project">
            
        </div>
    </div>    
</body>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <?php if($_GET['id_notes'] && 0 < mysqli_num_rows(mysqli_query($link, "SELECT * FROM `notes` WHERE id_users = {$_SESSION['user']['id']} AND id = {$_GET['id_notes']}"))){?>
        <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <?php }?>
    <script type="text/javascript" src="js/main.js"></script>
    <?php if($_GET['id_notes'] && 0 < mysqli_num_rows(mysqli_query($link, "SELECT * FROM `notes` WHERE id_users = {$_SESSION['user']['id']} AND id = {$_GET['id_notes']}"))){?>
        <script type="text/javascript" src="js/ckeditor.js"></script>
    <?php }?>
    
</html>
