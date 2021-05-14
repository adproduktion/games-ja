<?php include '../../db.php';  
        session_start();
?>   

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
            <a href="characters.php"> <?php echo $note["name"]?> </a>
        </div>
        <div class="action">
            <img class="notes-editor" id="<?php echo $note["id"]?>" src="images/table-editing.png" alt="">
            <img class="notes-delete" id="<?php echo $note["id"]?>" src="images/delete-box.png" alt="">
        </div>
    </div>
    <?php }?>  
    
    
    
