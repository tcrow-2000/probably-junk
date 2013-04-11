<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        /* color classes */
        .click-text {
            color: #3BB9FF;
        }
        body {
            padding: 0;
            margin: 0;
        }
        #app {
            min-width: 1050px;
            min-height: 550px;
            position: relative;
            /*background-color: lightblue;*/
            
            margin-top: 20px;
        }
        #sidebar {
            width: 250px;
            min-height: 550px;
            height: auto;
            /*background-color: fuchsia;*/
            position: absolute;
        }
        #sidebar .inner {
            width: 240px;
            min-height: 550px;
            margin: 0 auto;
            /*background-color: grey;*/
        }
        .selection-container {
            width: 100%;
            min-height: 200px;
            /*background-color: lightblue;*/
        }
        .selection-container .header {
            color: white;
            width: 100%;
            height: 50px;
            /*border-radius: 5px;*/
        }
        #playlist-selection-container .header {
            background-color: #D6A7BA;
        }
        #friends-selection-container .header {
            background-color: #9E7BFF;
        }
        .img-container {
            margin: 0 10px;
            float: left;
        }
        .img-container img {
            height: 50px;
        }
        .header-name {
            float: left;
            line-height: 50px;
            font-size: 35px;
        }
        ul.playlist-selection {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: right;
        }
        ul.playlist-selection > li {
            text-decoration: none;
            margin: 2.5px 20px;
        }
        ul.playlist-selection > li > a {
            text-decoration: none;
        }
        .friend {
            padding-right: 20px;
            margin: 5px 0px;
        }
        .arrow-up {
            width: 0; 
            height: 0; 
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;

            border-bottom: 5px solid blue;
            float: right;
            margin-top: 10px;
        }
        .arrow-down {
            width: 0; 
            height: 0; 
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;

            border-top: 5px solid blue;
            float: right;
            margin-top: 10px;
        }
        .friend-id {
            float: right;
            color: grey;
            font-size: 20px;
            margin-right: 5px;
        }
        .friend-playlists-selection {
            display: none;
        }
        #track-details {
            width: 300px;
            min-height: 550px;
            background-color: white;
            position:absolute;
            left: 251px;
            z-index: 1;
        }
        #playlist-details {
            min-height: 550px;
            min-width: 720px;
            width: 720px;
            background-color:rgb(185,185,185);
            position: absolute;
            left: 251px;
            z-index: 99;
        }
    </style>
</head>
<body>
    <div id="app">
        <div id="sidebar">
            <div class="inner">
                <div id="playlist-selection-container" class="selection-container">
                    <div class="header">
                        <div class="img-container">
                            <img src="public/img/record.png" >
                        </div>
                        <div class="header-name">Playlists</div>
                    </div>
                    <ul id="my-playlist-selection" class="playlist-selection">
                        
                    </ul>
                </div>
                <div id="friends-selection-container"  class="selection-container">
                    <div class="header">
                        <div class="img-container">
                            <img src="public/img/avatar.png" >
                        </div>
                        <div class="header-name">Friends</div>
                    </div>
                    <div id="friends-selection">
                        <!-- dynamic -->
                        <div class="friend">
                            <div class="indicator arrow-up"></div><div class="friend-id">timothy.crosas</div>
                            <div style="clear:both"></div>
                            <div class="friend-playlists-selection">
                                <ul class="friend-playlists playlist-selection">
                                    <li><a href="#" class="click-text">My rock tunes</a></li>
                                    <li><a href="#" class="click-text">My classic tunes</a></li>
                                    <li><a href="#" class="click-text">Chilling tracks</a></li>
                                    <li><a href="#" class="click-text">Soft and sexy</a></li>
                                    <li><a href="#" class="click-text">Country</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- dynamic -->
                        <!-- dynamic -->
                        <div class="friend">
                            <div class="indicator arrow-up"></div><div class="friend-id">zachM81</div>
                            <div style="clear:both"></div>
                            <div class="friend-playlists-selection">
                                <ul class="friend-playlists playlist-selection">
                                    <li><a href="#" class="click-text">My rock tunes</a></li>
                                    <li><a href="#" class="click-text">My classic tunes</a></li>
                                    <li><a href="#" class="click-text">Chilling tracks</a></li>
                                    <li><a href="#" class="click-text">Soft and sexy</a></li>
                                    <li><a href="#" class="click-text">Country</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- dynamic -->
                        <!-- dynamic -->
                        <div class="friend">
                            <div class="indicator arrow-up"></div><div class="friend-id">jdweaze</div>
                            <div style="clear:both"></div>
                            <div class="friend-playlists-selection">
                                <ul class="friend-playlists playlist-selection">
                                    <li><a href="#" class="click-text">My rock tunes</a></li>
                                    <li><a href="#" class="click-text">My classic tunes</a></li>
                                    <li><a href="#" class="click-text">Chilling tracks</a></li>
                                    <li><a href="#" class="click-text">Soft and sexy</a></li>
                                    <li><a href="#" class="click-text">Country</a></li>
                                </ul>
                            </div>
                        <!-- dynamic -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="track-details"></div>
        <div id="playlist-details"></div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        function getUserPlaylists() {
            $.post('do/action.php', {'action':'userPlaylists'},
                function(playlists) {
                    for(p in playlists) {
                        var id = playlists[p].Id;
                        var name = playlists[p].Name;
                        $('#my-playlist-selection')
                        .append("<li><a href='#" + id + "' class='click-text'>" + name + "</a></li>");
                    }
                },
                'json'
           ); 
        }
        $(document).ready(function() {
            $('#playlist-details').click(function() {
               $('#playlist-details').animate({marginLeft: "+=300px"},'slow');
            });
            
            // show friends playlist
            $('.friend').click(function() {
                var ind = $(this).find('.indicator');
                if (ind.hasClass('arrow-up')) {
                    ind.removeClass('arrow-up').addClass('arrow-down');
                } else {
                    ind.removeClass('arrow-down').addClass('arrow-up');
                }
                $(this).find('.friend-playlists-selection').slideToggle(400);
            });
            
            getUserPlaylists();
        });
    </script>
</body>
</html>