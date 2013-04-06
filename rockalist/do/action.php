<?php

include_once 'propeller.php';

$action = $_POST['action'];

switch($action) {
    
    //requires post data [email, pass]
    case 'registerUser':
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword(md5($_POST['pass']));
        $uid = md5($_POST['email'].$_POST['pass']);
        $user->setUniqueId($uid);
        $user->save();
        
        include_once 'mailer.php';
        echo json_encode(array(
            'success' => mailRegistration($_POST['email'], $uid)
            ));
        break;
    
    case 'loginUser':
        $msg = array('success' => false);
        $user = UserQuery::Create()->findOneByEmail($_POST['email']);
        if ($user) {
            if (md5($_POST['pass']) == $user->getPassword()) {
                session_start();
                $_SESSION['user'] = $user->getEmail();
                $msg['success'] = true;
            }
        }
        echo json_encode($msg);
        break;
        
    case 'userPlaylists':
        $user = thisUser();
        if ($user)
            echo $user->getPlayLists()->toJSON();
        break;
    
    case 'newPlaylist':
        $user = thisUser();
        if ($user) {
            $playlist = new PlayList();
            $playlist->setName($_POST['playlist']);
            $user->addPlayList($playlist);
            $user->save();
            echo $playlist->toJSON();
        }
        break;
        
    case 'newTrack':
        $user = thisUser();
        if ($user) {
            $track = new Track();
            $track->setUrl($_POST['url']);
            $track->setTitle($_POST['title']);
            $artist = new Artist();
            $artist->setName($_POST['artist']);
            $track->setArtist($artist);
            $playlist = PlayListQuery::create()->findPK($_POST['playlistId']);
            $playlisttrack = new PlayListTrack();
            $playlisttrack->setPlayList($playlist);
            $playlisttrack->setTrack($track);
            $playlisttrack->save();
            echo $playlisttrack->toJSON();
        }
        break;
        
    case 'getTracks':
        $user = thisUser();
        if ($user) {
            $playlist = PlayListQuery::create()->findPK($_POST['playlistId']);
            $playlistrack = PlayListTrackQuery::create()
                    ->filterByPlayList($playlist)
                    ->leftJoinWith('Track')
                    ->leftJoinWith('Track.Artist')
                    ->find();
            echo $playlistrack->toJSON();
        }
        break;
    
    case 'deleteTrack':
        $user = thisUser();
        if ($user) {
            $playlist = PlayListQuery::create()->findPK($_POST['playlistId']);
            $playlistrack = PlayListTrackQuery::create()
                    ->filterByPlayList($playlist)
                    ->findOneByTrackId($_POST['trackId']);
            $playlistrack->delete();
            echo $playlistrack->toJSON();
        }
        break;
        
    case 'copyTrack':
        $user = thisUser();
        if ($user) {
            $playlisttrack = new PlayListTrack();
            $playlisttrack->setPlayListId($_POST['playlistId']);
            $playlisttrack->setTrackId($_POST['trackId']);
            $playlisttrack->save();
            echo $playlisttrack->toJSON();
        }
        break;
        
    case 'clientRequestPlaylists':
        $auth_user = authUser();
        if ($auth_user) {
            echo $auth_user->getPlayLists()->toJSON();
        }
        break;
    
    case 'clientRequestTracks':
        $auth_user = authUser();
        if ($auth_user) {
            $tracks = PlayListTrackQuery::create()
                        ->usePlayListQuery()
                            ->filterById($_POST['playlistId'])
                        ->endUse()
                    ->leftJoinWith('Track')
                    ->leftJoinWith('Track.Artist')
                    ->find();
            echo $tracks->toJSON();
        }
        break;
}

function thisUser() {
    session_start();
    return UserQuery::create()->findOneByEmail($_SESSION['user']);
}

function authUser() {
    $auth_user = null;
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $user = UserQuery::create()->findOneByEmail($email);
    if ($user->getPassword() === $pass) {
        $auth_user = $user;
    }
    return $auth_user;
}

?>