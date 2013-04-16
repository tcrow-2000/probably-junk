<?php
session_start();
function getUser() {
    if (isset($_SESSION['user'])) {
        echo $_SESSION['user'];
    }
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Main Selection</title>
    <link rel="stylesheet" href="public/css/site.css" />
</head>
<body>
    <input type="hidden" id="active-user" value="<?php getUser() ?>" />
    <div id="tuner">
        <div class="rivets">
            <div class="rivet"></div>
            <div class="rivet"></div>
        </div>
        <div id="selection-container">
            <div id="selection-box"><div id="selection-arrow"></div></div>
            <div class="selection" data-screen="screen-login">Log In</div>
            <div class="selection" data-screen="screen-about">About</div>
            <div class="selection" data-screen="screen-faq">F.A.Q</div>
            <div class="selection" data-screen="screen-playlist">Playlist</div>
            <div class="selection" data-screen="screen-friends">Friends</div>
            <div class="selection" data-screen="screen-settings">Settings</div>
            <div class="selection" data-screen="screen-logout">Log Out</div>
        </div>
        <div id="light-button-container">
            <div class="light-button" data-audio="public/audio/moon.mp3">
                <div class="light-button-backlight" data-off="#008000" data-on="#33FF33">
                    <div class="light-button-bezel"></div>
                </div>
            </div>
            <div class="light-button" data-audio="public/audio/kiaHoraTeMarino.mp3">
                <div class="light-button-backlight" data-off="#B8B800" data-on="#FFFF00">
                    <div class="light-button-bezel"></div>
                </div>
            </div>
            <div class="light-button" data-audio="public/audio/greatestSpeechInTheWorld.mp3">
                <div class="light-button-backlight" data-off="#990000" data-on="#FF0000">
                    <div class="light-button-bezel"></div>
                </div>
            </div>
            <div id="test" class="light-button">
                <div class="light-button-backlight" data-off="#000080" data-on="#4DB8FF">
                    <div class="light-button-bezel"></div>
                </div>
            </div>
            <div id="test2" class="light-button">
                <div class="light-button-backlight" data-off="#993D00" data-on="#FFAD33">
                    <div class="light-button-bezel"></div>
                </div>
            </div>
        </div>
        <div class="rivets">
            <div class="rivet"></div>
            <div class="rivet"></div>
        </div>
    </div>
    
    <div id="screen">
        <div class="rivets">
            <div class="rivet"></div>
            <div class="rivet"></div>
        </div>
        <div id="inner-screen">
            <!-- dynamic -->
        </div>
        <div class="rivets">
            <div class="rivet"></div>
            <div class="rivet"></div>
        </div>
    </div>
    
    <audio id="radio" style="display: none;"></audio>
    <audio id="special-audio" style="display: none;"></audio>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="public/js/site.js"></script>
    
    <div id="screen-cache">
        
        <!-- LOGIN SCREEN -->
        
        <div id="screen-login" class="subscreen">
            <div class="screen-header">
                <div class="title">Hello.</div>
                <div class="selectable-action" data-action="show-register">Register</div>
                <div class="selectable-action" data-action="show-login">Log In</div>
            </div>
            <div class="screen-menu">
                <div class="inner">
                    
                </div>
            </div>
            <div class="screen-action">
                <div class="inner"> 
                    <div id="show-login" class="action-subscreen">
                        <div class="field-set">
                            <div class="field" data-type="email">
                                <input type="text" id="email" />
                                <div class="arrow-down"></div>
                                <div class="input-label">Email</div>
                                <div class="validation-message">* Valid email required</div>
                            </div>
                            <div class="field" data-type="password">
                                <input type="password" id="password" />
                                <div class="arrow-down"></div>
                                <div class="input-label">Password</div>
                                <div class="validation-message">* Non empty password required</div>
                            </div>
                        </div>
                        <div id="login" class="selectable-action">Let me in</div>
                    </div>
                    <div id="show-register" class="action-subscreen">
                        <div class="field-set">
                            <div class="field" data-type="email">
                                <input type="text" id="new-email" />
                                <div class="arrow-down"></div>
                                <div class="input-label">User email</div>
                                <div class="validation-message">* Valid email required</div>
                            </div>
                            <div class="field" data-type="password">
                                <input type="password" id="new-password" />
                                <div class="arrow-down"></div>
                                <div class="input-label">Password (6-10 chars)</div>
                                <div class="validation-message">* Non empty password required</div>
                            </div>
                        </div>
                        <div id="client-select">Please select your OS
                            <img id="client-img" src="public/img/windowsmaclinux-yellow.png" />
                            <div id="client-win" class="client-selection"><div class="selection-inner selected"></div></div>
                            <div id="client-mac" class="client-selection"><div class="selection-inner"></div></div>
                            <div id="client-lin" class="client-selection"><div class="selection-inner"></div></div>
                        </div>
                        <div id="register" class="selectable-action">Register me already!</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- FAQ SCREEN -->
        
        <div id="screen-faq" class="subscreen">
            <div class="screen-header">
                <div class="title">F.A.Q.</div>
            </div>
            <div class="screen-menu">
                <div class="inner">
                    <ul id="faq-list">
                        <li class="faq-item selected" data-message="faq-registration">How do I complete registration?</li>
                        <li class="faq-item" data-message="faq-syncmore">How do I sync more than 20 songs?</li>
                        <li class="faq-item" data-message="faq-howitworks">How does this sync music to my computer?</li>
                        <li class="faq-item" data-message="faq-legality">Is this service legal?</li>
                        <li class="faq-item" data-message="faq-friends">How do I add friends?</li>
                        <li class="faq-item" data-message="faq-awesome">Why is this so awesome?</li>
                        <li class="faq-item" data-message="faq-momoney">Can I pay you more than $2.99?</li>
                        <li class="faq-item" data-message="faq-songlimit">Is there a limit to how many songs I can sync?</li>
                        <li class="faq-item" data-message="faq-violation">Doesn't this violate YouTube's terms of service?</li>
                        <li class="faq-item" data-message="faq-filesharing">How is this different than file sharing?</li>
                    </ul>
                </div>
            </div>
            <div class="screen-action">
                <div class="inner">
                    <div id="faq-registration" class="faq-message active">You should receive an email shortly which will explain how to complete registration</div>
                    <div id="faq-syncmore" class="faq-message">In order to sync more than 20 songs you will need to pay a one-time subscription fee of $2.99.
                        This can be accomplished on the "Settings" screen. Once you pay the subscription fee, you will be able to sync as many songs as you would
                        like
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</body>
</html>