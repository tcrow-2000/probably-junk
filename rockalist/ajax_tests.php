<?php
session_start();
$_SESSION['user'] = 'xxx@gmail.com';
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
       
       function testRegistration() {
           $.post('do/action.php', {'action':'registerUser','email':'timothy.crosas@gmail.com','pass':'rockalist5576'},
                function(data) {
                    console.log(data);
                },
                'json'
           ); 
       }
       function testLogin() {
           $.post('do/action.php', {'action':'loginUser','email':'xxx@gmail.com','pass':'xxx'},
                function(data) {
                    console.log(data);
                },
                'json'
           ); 
       }
       function testPlaylists() {
           $.post('do/action.php', {'action':'userPlaylists'},
                function(data) {
                    console.log(data);
                },
                'json'
           ); 
       }
       function testFriendsPlaylists() {
           $.post('do/action.php', {'action':'friendsPlaylists'},
                function(data) {
                    console.log(data);
                },
                'json'
           ); 
       }
       function testTrack() {
           $.post('do/action.php', {'action':'newTrack', 'playlistId': 1},
                function(data) {
                    console.log(data);
                },
                'json'
           ); 
       }
       function testGetTracks() {
           $.post('do/action.php', {'action':'getTracks', 'playlistId': 1},
                function(data) {
                    console.log(data);
                },
                'json'
           ); 
       }
       function testClientRequestTrackList() {
            $.post('do/action.php', {'action':'clientRequestTrackList'},
                function(data) {
                    console.log(data);
                },
                'json'
           );
       }
       function makeRandomString(maxnum)
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < maxnum; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            console.log(text);
            return text;
        }
       function testLoadTimes() {
           for (i = 0; i < 20; i++) {
               console.log($.ajax({
                type: "POST",
                data: {'action':'newTrack', 
                    'playlistId': 1,
                    'url': 'http://www.youtube.com/watch?v=' + makeRandomString(Math.floor(Math.random() * (15 - 7 + 1)) + 7),
                    'title': makeRandomString(Math.floor(Math.random() * (30 - 3 + 1)) + 3),
                    'artist': makeRandomString(Math.floor(Math.random() * (20 - 2 + 1)) + 2)},
                url: 'do/action.php',
                async: false
                }).responseText);
           }
       }
       //testRegistration();
       //testLogin();
       //testPlaylists();
       //testTrack();
       //testClientRequestTrackList();
       testLoadTimes();
       //testGetTracks();
       //testFriendsPlaylists();
    });
    </script>
</head>
<body>
    
</body>
</html>