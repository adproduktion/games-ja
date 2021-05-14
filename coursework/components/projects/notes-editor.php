<?php include '../../db.php';  
    session_start();

    if($_GET['id_notes']){
        $notes_editor = mysqli_query($link, "SELECT * FROM `notes` WHERE id_users = {$_SESSION['user']['id']} AND id = {$_GET['id_notes']}");                    
        while ($note_editor = mysqli_fetch_assoc($notes_editor)){ 
        ?>
        <div class="notes-editor-title">
            <div class="input-ccs" style="width: 100%;">      
                <input type="text" id="notes-editor-name" style="width: 50%;" value="<?php echo  $note_editor["name"]; ?>" required>
                <span class="bar" style="width: 50%;"></span>
                <label>Название</label>
            </div>
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
    <?php }} else { ?>
        <div class="notes-editor-title">
            <div class="input-ccs" style="width: 100%;">      
                <input type="text" id="notes-editor-name" style="width: 50%;" value="" required>
                <span class="bar" style="width: 50%;"></span>
                <label>Название</label>
            </div> 
            <img class="notes-close" src="../images/close.png" alt="">
        </div>
        <div>
            <textarea id="editor" id="notes-editor-text"></textarea>
        </div>
        <div class="notes-editor-buttons">
            <button class="button-css notes-editor-create">
                Создать
            </button>
        </div>
    <?php }?>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/ckeditor.js"></script>