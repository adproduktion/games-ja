<?php
session_start();
// $_SESSION['user'] = [
//     "id" => $user['id'],
//     "login" => $user['login'],
//     "email" => $user['email'],
//     "flag"=>$user["flag"]
// ];
    
    function RelogSessionNon($session, $page)
    {
        if (!$session && $page != 'index.php') {
            header('Location: index.php');
        }
        
    }
    function RelogProjectNon($project_id)
    {
        $project_id_yes = 0;
        for ($i = 0; $i < count($_SESSION['projects_user']); $i++){
            if($_SESSION['projects_user'][$i]['id'] == $project_id){
                $project_id_yes++;
            }
        }
        if($project_id_yes==0){
            header("Location: projects.php");
        }
    }
    
?>