<?php 
    require '../db.php';
    require '../functions.php';

    if ($_POST['signin'] == "signin")
    {
        $email = $_POST['signin_email'];
        $password = $_POST['signin_password'];
        
        $check_user = mysqli_query($link, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
        if (mysqli_num_rows($check_user) > 0) {
    
            $user = mysqli_fetch_assoc($check_user);
    
            $_SESSION['user'] = [
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email']
            ];
            $msg_box = 1;
            echo json_encode(array(
                'result' => $msg_box
            ));
            unset($_SESSION['projects_user']); 
            $projects_user = mysqli_query($link, "SELECT id FROM `project` WHERE `id_users`={$_SESSION['user']['id']}");
            for($i=0; $i<mysqli_num_rows($projects_user); $i++){
                $id_projects_user = mysqli_fetch_assoc($projects_user);
                $_SESSION['projects_user'][$i] = [
                    'id' => $id_projects_user["id"] 
                ];
            }
        } 
        else {
            $msg_box = 0;
            echo json_encode(array(
                'result' => $msg_box
            ));               
        }       
    }

    if ($_POST['logout'] == "logout")
    {
        unset($_SESSION['user']);  
        unset($_SESSION['projects_user']);
        session_unset();
        $msg_box = 0;
        echo json_encode(array(
            'result' => $msg_box
        ));      
    }

    if ($_POST['signup'] == "signup")
    {
        $name = $_POST['signup_name'];
        $email = $_POST['signup_email'];
        $password = $_POST['signup_password'];
        
        $check_user = mysqli_query($link, "SELECT * FROM `users` WHERE `email` = '$email'");
        if (mysqli_num_rows($check_user) == 0) {
            
            mysqli_query($link, "INSERT INTO users (`name`,`email`,`password`) VALUES ('$name','$email','$password')");
            $check_user = mysqli_query($link, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
            $user = mysqli_fetch_assoc($check_user);
    
            $_SESSION['user'] = [
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email']
            ];
            $msg_box = 1;
            echo json_encode(array(
                'result' => $msg_box
            ));
        } 
        else {
            $msg_box = 0;
            echo json_encode(array(
                'result' => $msg_box
            ));               
        }       
    }


    if ($_POST['project_create'] == "project_create")
    {
        $name = $_POST['project_create_name'];
        mysqli_query($link, "INSERT INTO project (`id_users`,`name`) VALUES ('{$_SESSION['user']['id']}','$name')");
        unset($_SESSION['projects_user']); 
            $projects_user = mysqli_query($link, "SELECT id FROM `project` WHERE `id_users`={$_SESSION['user']['id']}");
            for($i=0; $i<mysqli_num_rows($projects_user); $i++){
                $id_projects_user = mysqli_fetch_assoc($projects_user);
                $_SESSION['projects_user'][$i] = [
                    'id' => $id_projects_user["id"] 
                ];
            }
        echo json_encode(array(
        ));
    }

    if ($_POST['project_save'] == "project_save")
    {
        $name = $_POST['project_save_name'];
        $id = $_POST['project_save_id'];
        mysqli_query($link, "UPDATE project SET name='$name' WHERE id='$id' AND id_users = {$_SESSION['user']['id']}");

        echo json_encode(array(
        ));
    }

    if ($_POST['project_delete'] == "project_delete")
    {
        $id = $_POST['project_delete_id'];
        mysqli_query($link, "DELETE FROM project WHERE id = '$id' AND id_users = {$_SESSION['user']['id']}");
        unset($_SESSION['projects_user']); 
            $projects_user = mysqli_query($link, "SELECT id FROM `project` WHERE `id_users`={$_SESSION['user']['id']}");
            for($i=0; $i<mysqli_num_rows($projects_user); $i++){
                $id_projects_user = mysqli_fetch_assoc($projects_user);
                $_SESSION['projects_user'][$i] = [
                    'id' => $id_projects_user["id"] 
                ];
            }

        echo json_encode(array(
        ));
    }


    if ($_POST['notes_editor_create'] == "notes_editor_create")
    {
        $name = $_POST['notes_editor_name'];
        $text = $_POST['notes_editor_text'];
        $description = mysqli_real_escape_string($link, $description);
        mysqli_query($link, "INSERT INTO notes (`id_users`,`name`,`text`) VALUES ('{$_SESSION['user']['id']}','$name','$text')");
        $msg_box = mysqli_insert_id($link);

        echo json_encode(array(
            'result' => $msg_box
        ));
    }

    if ($_POST['notes_delete'] == "notes_delete")
    {
        $id = $_POST['notes_delete_id'];
        $query = mysqli_query($link, "DELETE FROM notes WHERE id = '$id' AND id_users = {$_SESSION['user']['id']}");
        $msg_box = 1;

        echo json_encode(array(
            'result' => $msg_box
        ));
    }

    if ($_POST['notes_editor_save'] == "notes_editor_save")
    {
        $name = $_POST['notes_editor_name'];
        $text = $_POST['notes_editor_text'];
        $id = $_POST['notes_editor_id'];
        $description = mysqli_real_escape_string($link, $description);
        $query = mysqli_query($link, "UPDATE notes SET name='$name', text='$text' WHERE id='$id' AND id_users = {$_SESSION['user']['id']}");
        $msg_box = 1;

        echo json_encode(array(
            'result' => $msg_box
        ));
    }



    if ($_POST['create_new_tag'] == "create_new_tag")
    {
        $name = $_POST['new_tag_name'];
        $color = $_POST['new_tag_color'];
        mysqli_query($link, "INSERT INTO tags (`id_project`, `name`, `color`) VALUES ('{$_POST['id_project']}', '$name', '$color')");

        echo json_encode(array(
        ));
    }

    if ($_POST['editor_tag'] == "editor_tag")
    {
        $name = $_POST['tag_name'];
        $color = $_POST['tag_color'];
        $id = $_POST['id_tag'];
        $query = mysqli_query($link, "UPDATE tags SET name='$name', color='$color' WHERE id='$id' AND id_project = {$_POST['id_project']}");
        echo json_encode(array(
        ));
    }
    if ($_POST['delete_tag'] == "delete_tag")
    {
        $id = $_POST['id_tag'];
        $query = mysqli_query($link, "DELETE FROM tags WHERE id = '$id'");

        echo json_encode(array(
        ));
    }

    if ($_POST['add_tag'] == "add_tag")
    {
        $tag = $_POST['id_tag'];
        $aspect = $_POST['id_aspects'];
        if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `tag_aspects` WHERE `id_tags` = '$tag' AND `id_aspects` = '$aspect'")) == 0) {
            mysqli_query($link, "INSERT INTO tag_aspects (`id_tags`, `id_aspects`) VALUES ('$tag', '$aspect')");
            $msg_box = 1;
        } else{
            $msg_box = 0;
            mysqli_query($link, "DELETE FROM tag_aspects WHERE id_tags = '$tag' AND id_aspects = '$aspect'");
        }
        echo json_encode(array(
            'result' => $msg_box
        ));
    }



    if ($_POST['aspect_create'] == "aspect_create")
    {
        $name = $_POST['aspect_create_name'];
        mysqli_query($link, "INSERT INTO `aspects` (`id_project`,`name`, `text`) VALUES ('{$_POST['id_project']}','$name','')");
        
        echo json_encode(array(
        ));
    }

    if ($_POST['aspect_save'] == "aspect_save")
    {
        $name = $_POST['aspect_save_name'];
        $id = $_POST['aspect_save_id'];
        mysqli_query($link, "UPDATE aspects SET name='$name' WHERE id='$id' AND id_project = {$_POST['id_project']}");

        echo json_encode(array(
        ));
    }

    if ($_POST['aspect_delete'] == "aspect_delete")
    {
        $id = $_POST['aspect_delete_id'];
        mysqli_query($link, "DELETE FROM aspects WHERE id = '$id' AND id_project = {$_POST['id_project']}");

        echo json_encode(array(
        ));
    }

    if ($_POST['aspects_editor_save'] == "aspects_editor_save")
    {
        $name = $_POST['aspects_editor_name'];
        $text = $_POST['aspects_editor_text'];
        $id = $_POST['aspects_editor_id'];
        $description = mysqli_real_escape_string($link, $description);
        $query = mysqli_query($link, "UPDATE aspects SET name='$name', text='$text' WHERE id='$id' AND id_project = {$_POST['id_project']}");

        echo json_encode(array(
        ));
    }



    if ($_POST['chapter_create'] == "chapter_create")
    {   $number = $_POST['number'];
        $end_number = $_POST['end_number'];
        $name = $_POST['chapter_create_name'];
        
        
        if ($number == $end_number){
            mysqli_query($link, "INSERT INTO `chapters` (`id_project`,`name`, `number`) VALUES ('{$_POST['id_project']}','$name', '$number')");
        }
        if($number == 0){
            mysqli_query($link, "INSERT INTO `chapters` (`id_project`,`name`) VALUES ('{$_POST['id_project']}','$name')");
        }
        if($number != 0 && $number != $end_number){
            $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` >= '$number' ORDER BY `number` ASC");
                            
            for($i=$number+1; $i<=$end_number; $i++){
                $chapter = mysqli_fetch_assoc($chapters);
                mysqli_query($link, "UPDATE chapters SET number='$i' WHERE id={$chapter["id"]} AND id_project = {$_POST['id_project']}");
            }
            mysqli_query($link, "INSERT INTO `chapters` (`id_project`,`name`, `number`) VALUES ('{$_POST['id_project']}','$name', '$number')");
            
            
            $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` != 0 ORDER BY `number` ASC");
                        
            for($i=1; $i<$end_number-1; $i++){
                $chapter = mysqli_fetch_assoc($chapters);
                mysqli_query($link, "UPDATE chapters SET number='$i' WHERE id={$chapter["id"]} AND id_project = {$_POST['id_project']}");
            }
        }
        echo json_encode(array(
        ));
    }

    if ($_POST['chapter_save'] == "chapter_save")
    {
        $number = $_POST['number'];
        $end_number = $_POST['end_number'];
        $name = $_POST['chapter_save_name'];
        $id = $_POST['chapter_save_id'];
        $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id = '$id' AND id_project = {$_POST['id_project']}");
        $chapter = mysqli_fetch_assoc($chapters);
        $number_old = $chapter["number"];
        // $number = $_POST['chapter_save_number'];
        if ($number == $end_number || $number == $chapter["number"]){
            mysqli_query($link, "UPDATE chapters SET name='$name', number='$number' WHERE id='$id' AND id_project = {$_POST['id_project']}");
        }


        if($number == 0){
            mysqli_query($link, "UPDATE chapters SET name='$name', number='$number' WHERE id='$id' AND id_project = {$_POST['id_project']}");
            $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` != 0 ORDER BY `number` ASC");
                        
            for($i=1; $i<$end_number-1; $i++){
                $chapter = mysqli_fetch_assoc($chapters);
                mysqli_query($link, "UPDATE chapters SET number='$i' WHERE id={$chapter["id"]} AND id_project = {$_POST['id_project']}");
            }
        }


        if($number != 0 && $number != $end_number && $number != $chapter["number"]){
            if($number_old == 0){
                $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` >= '$number' ORDER BY `number` ASC");
                            
                for($i=$number+1; $i<=$end_number; $i++){
                    $chapter = mysqli_fetch_assoc($chapters);
                    mysqli_query($link, "UPDATE chapters SET number='$i' WHERE id={$chapter["id"]} AND id_project = {$_POST['id_project']}");
                }
                mysqli_query($link, "UPDATE chapters SET name='$name', number='$number' WHERE id='$id' AND id_project = {$_POST['id_project']}");
                
                
                $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` != 0 ORDER BY `number` ASC");
                            
                for($i=1; $i<$end_number-1; $i++){
                    $chapter = mysqli_fetch_assoc($chapters);
                    mysqli_query($link, "UPDATE chapters SET number='$i' WHERE id={$chapter["id"]} AND id_project = {$_POST['id_project']}");
                }
            }else{
                if($number > $number_old){
                    mysqli_query($link, "UPDATE chapters SET name='$name', number=0 WHERE id='$id' AND id_project = {$_POST['id_project']}");

                    $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` != 0 ORDER BY `number` ASC");
                                
                    for($i=1; $i<$number; $i++){
                        $chapter = mysqli_fetch_assoc($chapters);
                        mysqli_query($link, "UPDATE chapters SET `number`='$i' WHERE id = {$chapter["id"]} AND id_project = {$_POST['id_project']}");
                    }
                    mysqli_query($link, "UPDATE chapters SET name='$name', number='$number' WHERE id='$id' AND id_project = {$_POST['id_project']}");
                }else{
                    mysqli_query($link, "UPDATE chapters SET name='$name', number=0 WHERE id='$id' AND id_project = {$_POST['id_project']}");

                    $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` >= '$number' AND `number` <= '$number_old' ORDER BY `number` ASC");
                            
                    for($i=$number+1; $i<=$number_old; $i++){
                        $chapter = mysqli_fetch_assoc($chapters);
                        mysqli_query($link, "UPDATE chapters SET number='$i' WHERE id={$chapter["id"]} AND id_project = {$_POST['id_project']}");
                    }
                    mysqli_query($link, "UPDATE chapters SET name='$name', number='$number' WHERE id='$id' AND id_project = {$_POST['id_project']}");
                }
            }  
        }
        

        echo json_encode(array(
        ));
    }

    if ($_POST['chapter_delete'] == "chapter_delete")
    {
        
        $id = $_POST['chapter_delete_id'];
        $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id = '$id' AND id_project = {$_POST['id_project']}");
        $chapter = mysqli_fetch_assoc($chapters);
        $number = $chapter["number"];

        if ($number !=0){
            mysqli_query($link, "DELETE FROM chapters WHERE id = '$id' AND id_project = {$_POST['id_project']}");
            $chapters = mysqli_query($link, "SELECT * FROM `chapters` WHERE id_project = {$_POST['id_project']} AND `number` != 0 ORDER BY `number` ASC");
            $end_number = mysqli_num_rows($chapters);            
            for($i=1; $i<=$end_number; $i++){
                $chapter = mysqli_fetch_assoc($chapters);
                mysqli_query($link, "UPDATE chapters SET number='$i' WHERE id={$chapter["id"]} AND id_project = {$_POST['id_project']}");
            }
        }
        if($number == 0){
            mysqli_query($link, "DELETE FROM chapters WHERE id = '$id' AND id_project = {$_POST['id_project']}");
        }
        echo json_encode(array(
        ));
    }



    
    if ($_POST['scene_create'] == "scene_create")
    {
        $name = $_POST['scene_create_name'];
        mysqli_query($link, "INSERT INTO `scenes` (`id_project`,`name`, `text`) VALUES ('{$_POST['id_project']}','$name','')");
        
        echo json_encode(array(
        ));
    }

    if ($_POST['scene_save'] == "scene_save")
    {
        $name = $_POST['scene_save_name'];
        $id = $_POST['scene_save_id'];
        mysqli_query($link, "UPDATE scenes SET name='$name' WHERE id='$id' AND id_project = {$_POST['id_project']}");

        echo json_encode(array(
        ));
    }

    if ($_POST['scene_delete'] == "scene_delete")
    {
        $id = $_POST['scene_delete_id'];
        mysqli_query($link, "DELETE FROM scenes WHERE id = '$id' AND id_project = {$_POST['id_project']}");

        echo json_encode(array(
        ));
    }

?>