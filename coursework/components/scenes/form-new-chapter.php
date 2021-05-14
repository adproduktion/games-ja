<?php include '../../db.php';  
    session_start();
    if($_POST['id-chapter']){
        $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id = {$_POST['id-chapter']} AND id_project = {$_POST['id-project']}");
        while ($chapter = mysqli_fetch_assoc($chapters)){ 
    ?>
        <div class="form-chapter-header t-w-24">
            <?php echo  $chapter["name"]; ?>
        </div>
            <div class="form-chapter-chapter-border">
                <div class="form-chapter-chapter">                   
                    <div class="input-ccs" class="new-chapter-name" style="width: 100%;">      
                        <input type="text" id="new-chapter-name" style="width: 100%;" value="<?php echo  $chapter["name"]; ?>" required>
                        <span class="bar" style="width: 100%;"></span>
                        <label>Название главы</label>
                    </div>  
                    <div class="select-block">
                        <span class="t-b-16">Нумерация</span>
                        <select class="new-chapter-number select-css" style="width: 200px;">
                        <?php $i_option = mysqli_num_rows($number_chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND number != 0 ORDER BY `number` ASC"));
                            if($chapter["number"]==0){
                            for($i=0; $i<=$i_option+1; $i++){?>
                                <option value="<?php echo $i;?>" <?php if($i==$i_option+1){ echo 'class="number-end" id="'. $i .'"';} if($i==$chapter["number"]){ echo 'selected';}?>>
                                    <?php echo $i;
                                    if($i==0){ echo '  -  Главы без нумерации';}
                                    if ($i > 0){
                                        $number_chapter = mysqli_fetch_assoc($number_chapters);
                                        echo  '  -  '. $number_chapter["name"];
                                    }
                                    if ($i == $i_option+1){
                                        
                                        echo  ' ...';
                                    }
                                    ?>
                                </option>
                        <?php }}else{
                            for($i=0; $i<=$i_option+1; $i++){?>                       
                            <option value="<?php echo $i;?>" <?php if($i==$i_option+1){ echo 'class="number-end none" id="'. $i .'"';} if($i==$chapter["number"]){ echo 'selected';}?>>
                                <?php echo $i;
                                    if($i==0){ echo '  -  Главы без нумерации';}
                                    if ($i > 0){
                                        $number_chapter = mysqli_fetch_assoc($number_chapters);
                                        echo  '  -  '. $number_chapter["name"];
                                    }
                                    if ($i == $i_option+1){
                                        
                                        echo  ' ...';
                                    }
                                ?>
                            </option>
                        <?php }}?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-chapter-footer">
                <div class="t-b-18 new-chapter-save" id="<?php echo $_POST['id-chapter']; ?>">
                    Сохранить
                </div>
                <div class="t-b-18 close" >
                    Закрыть
                </div>
            </div>
        
        <!-- <input class="new-chapter-name" id="new-chapter-name" type="text" value="<?php echo $chapter["name"]?>"> -->
        <!-- <button class="button-css new-chapter-save" id="<?php echo $_POST['id-chapter']; ?>">
            Изменить
        </button> -->
    <?php }}else{ ?>
        
        <div class="form-chapter-header t-w-24">
            Новая глава
        </div>
        <div class="form-chapter-chapter-border">
            <div class="form-chapter-chapter">                   
                <div class="input-ccs" class="new-chapter-name" style="width: 100%;">      
                    <input type="text" id="new-chapter-name" style="width: 100%;" value="" required>
                    <span class="bar" style="width: 100%;"></span>
                    <label>Название главы</label>
                </div>
                <div class="select-block">
                    <span class="t-b-16">Нумерация</span>
                    <select class="new-chapter-number select-css" style="width: 200px;">
                        <?php $i_option = mysqli_num_rows($number_chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id-project']} AND number != 0 ORDER BY `number` ASC"));
                            for($i=0; $i<=$i_option+1; $i++){?>
                            <option value="<?php echo $i;?>" <?php if($i==$i_option+1){ echo 'class="number-end" id="'. $i .'" selected';} ?>>
                                <?php echo $i;
                                    if($i==0){ echo '  -  Главы без нумерации';}
                                    if ($i > 0){
                                        $number_chapter = mysqli_fetch_assoc($number_chapters);
                                        echo  '  -  '. $number_chapter["name"];
                                    }
                                    if ($i == $i_option+1){
                                        
                                        echo  ' ...';
                                    }
                                ?>
                            </option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-chapter-footer">
            <div class="t-b-18 new-chapter-create" id="<?php echo $_POST['id-chapter']; ?>">
                    Создать
            </div>
            <div class="t-b-18 close" >
                Закрыть
            </div>
        </div>
        
        <!-- <input class="new-chapter-name" id="new-chapter-name" type="text"> -->
        <!-- <button class="button-css new-chapter-create">
            Создать
        </button> -->
        
    <?php } ?>


