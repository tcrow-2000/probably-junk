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
           $.post('do/action.php', {'action':'registerUser','email':'xxx@gmail.com','pass':'blahblah'},
                function(data) {
                    alert(data.success);
                },
                'json'
           ); 
       }
       function testLogin() {
           $.post('do/action.php', {'action':'loginUser','email':'xxx@gmail.com','pass':'xxx'},
                function(data) {
                    alert(data.success);
                },
                'json'
           ); 
       }
       function testPlaylists() {
           $.post('do/action.php', {'action':'userPlaylists'},
                function(data) {
                    alert(data);
                },
                'json'
           ); 
       }
       function testTrack() {
           $.post('do/action.php', {'action':'newTrack', 'playlistId': 1},
                function(data) {
                    alert(data);
                },
                'json'
           ); 
       }
       function testClientRequestTrackList() {
            $.post('do/action.php', {'action':'clientRequestTrackList'},
                function(data) {
                    alert(data);
                },
                'json'
           );
       }
 
       function testLoadTimes() {
           for (i = 0; i < 500; i++) {
               console.log($.ajax({
                type: "POST",
                data: {'action':'newTrack', 
                    'playlistId': 1, 
                    'title': 'title' + i,
                    'artist': 'artist' + i*2},
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
       //testLoadTimes();
    });
    </script>
</head>
<body>
    
</body>
</html>