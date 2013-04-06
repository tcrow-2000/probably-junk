<?php
    include_once '../do/propeller.php';
    
    $reg = $_GET['reg_code'];
    $user = UserQuery::create()->findOneByUniqueId($reg);
    $user->setRegistered(true);
    $user->setLastLogin(date('Y-m-d H:i:s'));
    //need to check if this user already has playlists
    if ($user->countPlayLists() == 0) {
        $playlist = new PlayList();
        $playlist->setName('Default Playlist');
        $user->addPlayList($playlist);
    }
    $user->save();
    
    session_start();
    $_SESSION['user'] = $user->getEmail();
    header('Location: ../go.php');
    exit;
    
?>