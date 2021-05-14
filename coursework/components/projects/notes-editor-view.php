<?php include '../../db.php';  
    session_start();

    if($_GET['id_notes']){
        $notes_editor = mysqli_query($link, "SELECT * FROM `notes` WHERE id_users = {$_SESSION['user']['id']} AND id = {$_GET['id_notes']}");                    
        while ($note_editor = mysqli_fetch_assoc($notes_editor)){ 
        ?>
        <div>
        <?php echo $note_editor["text"]; ?>
        </div>
        
    <?php }} ?>
    