<?php
session_start();
function getUser() {
    if (isset($_SESSION['user'])) {
        echo $_SESSION['user'];
        echo "<a href='./logout.php' class='btn' id='active-user-logout'>Log out</a>";
    }
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/vendor/bootstrap.css" />
    <link rel="stylesheet" href="public/css/site.css" />
    <title>RockA List</title>
</head>
<body>
       <!-- templates -->
    <script id="tpl-playlist" type="text/x-handlebars-template">
        <div class="playlist" data-playlist-id="{{id}}">
            <div class="playlist-inner">
            <div class="record-container">
        <img src="public/img/record.png" class="record" />
        </div>
            <div class="playlist-name">{{name}}</div>
            </div>
        </div>
    </script>
    
    <script id="tpl-track" type="text/x-handlebars-template">
        <div data-track-id="{{id}}" class="track-obj">
            <div class="sync-status {{synced}}"></div>
            <div class="track-data">
            <div class="track-title">{{title}}
            </div>
            <div class="track-artist">
                <span>by</span>{{artist}}
            </div>
            </div>
            <div class="track-actions">
                <div class="action" id="action-edit" data-toggle="tooltip" title="Edit this Track">
                    <i class="icon-pencil icon-white"></i>
                </div>
                <div class="action" id="action-info" data-toggle="tooltip" title="Show Track Info">
                    <i class="icon-info-sign icon-white"></i>
                </div>
                <div class="action" id="action-move" data-toggle="tooltip" title="Move this Track">
                    <i class="icon-hand-right icon-white"></i>
                </div>
                <div class="action" id="action-copy" data-toggle="tooltip" title="Copy this Track">
                    <i class="icon-th icon-white"></i>
                </div>
                <div class="action" id="action-rate" data-toggle="tooltip" title="Rate this Track">
                    <i class="icon-star icon-white"></i>
                </div>
                <div class="action" id="action-delete" data-toggle="tooltip" title="Delete this Track">
                        <i class="icon-remove icon-white"></i>
                </div>
            </div>
        </div>
    </script>
    <script id="tpl-track-edit" class="track-edit" type="text/x-handlebars-template">
        <div data-track-id="{{id}}">
        <label>Youtube Url</label>
        <input type="text" id="edit-url" placeholder="Track url"><br/>
        <label>Title Name</label>
        <input type="text" id="edit-title" placeholder="Track title"><br/>
        <label>Artist Name</label>
        <input type="text" id="edit-artist" placeholder="Track artist"><br/>
        <label>Album Name</label>
        <input type="text" id="edit-album" placeholder="Track album"><br/>
        <label>Genre</label>
        <input type="text" id="edit-genre" placeholder="Track genre"><br/>
        <label>Year</label>
        <input type="text" id="edit-year" placeholder="Track year"><br/>
        <div id="commit-edit" class="btn btn-info pull-right">Done</div>
        </div>
    </script>
    
   <div id="page">
        <div id="header">
            <div id="logo" class="tonda">Rock A List<span class="tonda" style="font-size:20px;">Beta</span></div>
        </div>
        <div id="nav-bar" >
          <div class="tabbable ">
            <div id='active-user' style='float:right'><?php getUser(); ?></div>
            <ul class="nav nav-tabs pull left">
              <li class="active">
                <a href="#1" data-toggle="tab">Welcome</a>
              </li>
              <li id='login-tab'><a href="#2" data-toggle="tab">Log in</a></li>
              <li><a href="#3" data-toggle="tab">My Playlists</a></li>
              <li><a href="#4" data-toggle="tab">Friends</a></li>
              <li><a href="#5" data-toggle="tab">Profile</a></li>
            </ul>
            
            <div class="tab-content">
              <div class="tab-pane active" id="1">
                <div class="hero-unit welcome">
                  <p>Love music? Hate expensive music services? Looking for something better?</p>
                  <h1>Welcome to<br/> <span class="tonda">Rock A List!</span></h1>
                  <p>This is music freedom</p>
                  <p>
                    <a href="#form-registration" data-toggle="modal" class="btn btn-primary btn-large btn-info">
                      Register now
                    </a>
                  </p>
                </div>
                  <h2>What is Rock A List?</h2>
                  <p  class="well well-large lead">Rock A List is a playlist-building site based on music videos posted to YouTube. 
                  Easily create and share playlists of your favourite songs using YouTube urls, then
                  we will help you sync them to your computer for easy listening on any of your devices.
                  This is true music freedom.</p>
                  <br />
                  <br />
                  <h2>Sounds awesome, is it legal?</h2>
                  <p class="well well-large lead">Rock A List is 100% legal as of today. We are not helping you to download music illegally,
                  we are simply helping you assemble a playlist based on urls. Then using open source software, we
                  help you turn those urls into music files for your own personal enjoyment. As long as you do not share
                  the mp3 files we help you create, you are not doing anything illegal.</p>
              </div>
              <div class="tab-pane" id="2">
                <div class="hero-unit login">  
                  <h3>We've been expecting you</h3>
                  <fieldset >
                    <label>Email</label>
                    <input type="text" id="login-email" placeholder="user@mydomain.com">
                    <label>Password</label>
                    <input type="password" id="login-pass" placeholder="password">
                  </fieldset>
                  <div id="login" class="btn btn-large btn-info">Log In</div>
                </div>
              </div>
              <div class="tab-pane" id="3">
                  <div style='min-width:960px; width: auto !important; width: 960px;'>
                    <div id='user-playlist-active'>
                        <div id="playlist-area">
                            <div id="playlist-new-track">
                                <div id="new-track-inner">
                                    <div id="new-track-input">
                                        <input type="text" id="new-track-url" placeholder="Paste a url then hit enter" />
                                    </div>
                                    <div id="new-track-add">
                                        <a href="#" class="btn btn-info">Add</a>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div id="new-track-info-container">
                                        <div id="new-track-title" class="new-track-link">
                                            <a href="#">Title</a>
                                        </div>
                                        <div id="new-track-artist" class="new-track-link">
                                            <a href="#">Artist</a>
                                        </div>
                                        <div id="new-track-album" class="new-track-link">
                                            <a href="#">Album</a>
                                        </div>
                                        <div id="new-track-genre" class="new-track-link">
                                            <a href="#">Genre</a>
                                        </div>
                                        <div id="new-track-year" class="new-track-link">
                                            <a href="#">Year</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="playlist-track-list">
                                <div id="track-list-sort-container">
                                    <div >Sort by</div>
                                    <div class="sort-link">Newest</div>
                                    <div class="sort-link">Rated</div>
                                    <div class="sort-link selected">Title</div>
                                    <div class="sort-link">Artist</div>
                                    <div class="sort-link">Album</div>
                                    <div class="sort-link">Genre</div>
                                    <div class="sort-link">Year</div>
                                </div>
                                <div id="tracks">
                                    
                                    <!-- script provides tracks -->
                                    <div id="temp-sort"></div>
                                    <div id="cache"></div>
                                </div>
                            </div>
                        </div>
                        <div id="playlist-a-z"></div>
                    </div>
                    <div id='user-playlist-select'>
                        <div class="playlist add-playlist">
                            <div class="playlist-inner">
                                <div class="record-container">
                                    <img src="public/img/record.png" class="record" />
                                </div>
                                <div class="btn btn-info btn-large">Add New Playlist</div>
                                <input id="new-playlist-name" type="text" placeholder="New playlist" />
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane" id="4">
                <p>Howdy, I'm in Section 4.</p>
              </div>
            </div>
          </div>
       </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/js/vendor/handlebars.js"></script>
    <script type="text/javascript" src="public/js/site.js"></script>
    
    <!-- Modal Registration -->
    <div id="form-registration" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header cool-blue-bg">
        <h3 id="myModalLabel" class="tonda">Registration</h3>
      </div>
      <div class="modal-body">
        <div id="registration-form">
            <div id="registration-info">
                <fieldset >
                    <label>Email</label>
                    <input type="text" id="registration-email" placeholder="user@mydomain.com">
                    <label>Password</label>
                    <input type="password" id="registration-pass" placeholder="password">
                    <div id="validation-email" class="alert alert-error validation-alert">You must enter a valid email address</div>
                    <div id="validation-pass" class="alert alert-error validation-alert">Your password must be 6-10 characters long</div>
                </fieldset>
                <div id="registration-loader" class="validation-alert">
                    <img src="public/img/loader-big.gif" alt="" />
                </div>
            </div>
            <div id="registration-client">
                <h4>Please choose a client</h4>
                <img src="public/img/windowsmaclinux.png" alt="" />
                <ul class="client-selection">
                    <li>
                        <input type="radio" class="client-win" name="client" value="win" checked="true"/>
                    </li>
                    <li>
                        <input type="radio" class="client-mac" name="client" value="mac"/>
                    </li>
                    <li>
                        <input type="radio" class="client-lin" name="client" value="lin"/>
                    </li>
                </ul>
                <p>Clients are used to sync your online playlists to mp3 files on your computer.</p>
                <p>After registration is complete, we will package up your client and send you a
                link to download it</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div id="validation-submit" class="alert validation-alert pull-left"></div>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button id="registration-submit" class="btn btn-primary">Sign me up!</button>
      </div>
    </div>
</body>
</html>