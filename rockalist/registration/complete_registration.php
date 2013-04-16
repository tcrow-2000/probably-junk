<?php
    include_once '../do/propeller.php';
    
    $reg = $_GET['reg_code'];
    $user = UserQuery::create()->findOneByUniqueId($reg);
    $user->setRegistered(true);
    $user->setLastLogin(date('Y-m-d H:i:s'));
    //need to check if this user already has playlists
    if ($user->countPlayLists() == 0) {
        $rock = new PlayList();
        $rock->setName('My Rock');
        $user->addPlayList($rock);
        $country = new PlayList();
        $country->setName('My Country');
        $user->addPlayList($country);
        $alt = new PlayList();
        $alt->setName('My Alternative');
        $user->addPlayList($alt);
        $pop = new PlayList();
        $pop->setName('My Pop');
        $user->addPlayList($pop);
        $hip = new PlayList();
        $hip->setName('My Hiphop');
        $user->addPlayList($hip);
        $rap = new PlayList();
        $rap->setName('My Rap');
        $user->addPlayList($rap);
        $friend = new Friend();
        $friend->setFriendEmail('timothy.crosas@gmail.com');
        $user->addFriend($friend);
    }
    $user->save();
    
    session_start();
    $_SESSION['user'] = $user->getEmail();
    header('Location: ../radio.php');
    exit;
    
?>