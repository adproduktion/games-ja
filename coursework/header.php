<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="page" id="page">
        <section class="<?php if(!$_SESSION['user'] || !$project_result){ echo 'sections-header-index';}else{echo 'sections-header';}?>">
            <header class="header" id="header">
                <div class="headers">
                <?php 
                    if($_SESSION['user']){
                        if($project_result){
                    ?>
                    <div class="header-top">
                    <?php }else{ ?>
                        <div class="header-top-index">
                    <?php }?>
                        <div class="header-top-projekt t-w-32">
                            <?php if($project_result){
                                while ($project_content = mysqli_fetch_assoc($project_result))
                                {?>
                                <a class="t-w-32" href="projects.php"><?php echo $project_content["name"];?></a>                                
                            <?php }}else{ ?>
                                <a class="t-w-32" href="projects.php">Проекты</a> 
                            <?php } ?>
                        </div>
                        <div class="header-top-user-window">
                            <div class="header-top-user-window-left">
                                <img src="" alt="">
                            </div>
                            <div class="header-top-user-window-right">
                                <div class="header-top-user-window-right-name">
                                    <?php echo $_SESSION['user']['name']; ?>
                                </div>
                                <div class="header-top-user-window-right-label" id="logout">
                                    Выйти
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($project_result){?>
                        <div class="header-bottom">
                            <ul class="main-menu">
                                <li class="<?php if ($file_name == "aspects.php" || $file_name == "aspect.php"){ echo "main-menu-li-active";}else{echo "main-menu-li";}?> t-b-24"><a href="aspects.php?id-project=<?php echo $project_id ?>">Аспекты</a></li>
                                <li class="<?php if ($file_name == "scenes.php"){ echo "main-menu-li-active";}else{echo "main-menu-li";}?> t-b-24"><a href="scenes.php?id-project=<?php echo $project_id ?>">Сцены</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                <?php }else{ ?>
                    <div class="header-top-index">                    
                    </div>                   
                <?php } ?>
                </div>
            </header>
        </section>