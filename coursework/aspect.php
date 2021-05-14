<?php
include 'db.php';
include 'functions.php';
$file_name = basename(__FILE__);
RelogSessionNon($_SESSION['user'], $file_name);

$project_id = $_GET["id-project"];
RelogProjectNon($project_id);

$project_result = mysqli_query($link, "SELECT * FROM `project` WHERE id='$project_id'");

include 'header.php'
?>

        <section class="section-content">    
            <div class="content-aspects">
                <div class="aspects">
                <?php if($_GET['id-aspect'] && 0 < mysqli_num_rows(mysqli_query($link, "SELECT * FROM `aspects` WHERE id = {$_GET['id-aspect']} AND id_project = {$_GET['id-project']}"))){?>
                    <?php $aspects = mysqli_query($link, "SELECT * FROM `aspects` WHERE id = {$_GET['id-aspect']} AND id_project = {$_GET['id-project']}"); ?>                    
                        <?php while ($aspect = mysqli_fetch_assoc($aspects)){ ?>
                        <div class="aspects-editor-title">
                            <div class="input-ccs" style="width: 300px;">      
                                <input type="text" id="aspects-editor-name" style="width: 100%;" value="<?php echo  $aspect["name"]; ?>" required>
                                <span class="bar" style="width: 100%;"></span>
                                <label>Название</label>
                            </div> 
                            <div class="msg-info">
                                <div class="t-b-18 msg-save" style="color: green; display:none;">Сохранен</div>
                                <div class="t-b-18 msg-non-save" style="color: red; display:none;">Не сохранен</div>
                            </div>
                        </div>
                        <div>
                            <textarea id="editor" id="aspects-editor-text"><?php echo $aspect["text"]; ?></textarea>
                        </div>
                        <div class="aspects-editor-buttons">
                            <button class="button-css aspects-editor-save" id="<?php echo  $aspect["id"]; ?>">
                                Сохранить
                            </button>  
                            <button class="button-css aspects-delete" id="<?php echo  $aspect["id"]; ?>">
                                Удалить
                            </button> 
                        </div>
                        <?php }?>
                    <?php } ?>                   
                </div>
            </div> 
        </section>

    </div>  
</body>
    <script>
            var id_project='<?= $_GET["id-project"] ?>';
            var id_aspect='<?= $_GET["id-aspect"] ?>';
    </script>                                    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/ckeditor.js"></script>

    
</html>
<?php 
    
?>


