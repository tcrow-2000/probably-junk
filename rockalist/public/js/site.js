UserPlaylists = {};

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

var Playlist = function(playlistData) {
    this.template = Handlebars.compile($('#tpl-playlist').html());
    this.data = playlistData;
    this.tracks = {};
    this.addTrack = function(trackData) {
        var t = new Track(trackData);
        this.tracks[t.data.Track.Id] = t;
        t.render();
    };
    this.acceptCopy = function(trackId) {
        $.post('do/action.php', {'action':'copyTrack', 'trackId':trackId, 'playlistId': this.data.Id},
                function(trackData) {
                    console.log(trackData);
                },
                'json'
           ); 
    };
    this.getTracks = function() { 
        var self = this;
        $.post('do/action.php', {'action':'getTracks', 'playlistId': this.data.Id},
                function(playlisttracks) {
                    for(precId in playlisttracks) {
                        self.addTrack(playlisttracks[precId]);
                    }
                },
                'json'
           ); 
    };
    this.deleteTrack = function(trackId) {
        //delete from database
        //delete from playlist
        var self = this;
        $.post('do/action.php', {'action':'deleteTrack', 'playlistId': this.data.Id, 'trackId':trackId}, 
            function(trackData) {
                delete self.tracks[trackId];
                $("div[data-track-id='" + trackId + "']").remove();
            }, 
        'json');
        
    };
    this.render = function() {
        var context = {'id': this.data.Id, 'name': this.data.Name};
        $('.playlist.add-playlist').before(this.template(context));
    };
};
var Track = function(trackData) {
    this.template = Handlebars.compile($('#tpl-track').html());
    this.data = trackData;
    this.render = function() {
        var context = {
                'id':this.data.Track.Id,
                'synced':this.data.Synced,
                'title':this.data.Track.Title,
                'artist':this.data.Track.Artist.Name};
        $('#tracks').append(this.template(context));
    };
    return this;
};

var PendingTrack = function() {
    this.url = '';
    this.title = '';
    this.artist = '';
    this.album = '';
    this.genre = '';
    this.year = '';
};

$(document).ready(function() {
    
    /*
     * Playlists
     * 
     */
    $.post('do/action.php', {'action':'userPlaylists'}, 
        function(playlists) {
            for(pid in playlists) {
                var playlist = new Playlist(playlists[pid]);
                UserPlaylists[playlist.data.Id] = playlist;
                playlist.render();
            }
            $('#user-playlist-select > .playlist:first-child').addClass('active');
            getPlaylistTracks();
        }, 
    'json');
    
    function resetAddPlaylist() {
        $('#new-playlist-name').val('');
        $('#new-playlist-name').hide();
        $('.playlist.add-playlist .btn').show();
    }
    function getPlaylistTracks() {
        $('#tracks').empty();
        var pid = $('.playlist.active').data('playlist-id');
        UserPlaylists[pid].getTracks();
    }
    $(document).delegate('.playlist', 'click', function(){
       if (!$(this).hasClass('add-playlist')) {
            if (!$(this).hasClass('active')) {
                $(this).siblings('.active').removeClass('active');
                $(this).addClass('active');
                getPlaylistTracks();
            }
            if ($('#new-playlist-name:visible')) {
                resetAddPlaylist();
            }
       }
    });
    $('#new-playlist-name').keyup(function(e) {
       if (e.keyCode === 13) {
           $.post('do/action.php', {'action':'newPlaylist', 'playlist':$('#new-playlist-name').val()},
            function(data) {
                var playlist = new Playlist(data);
                UserPlaylists[playlist.data.Id] = playlist;
                playlist.render();
                resetAddPlaylist();
            },
            'json');
           
       } 
       else if (e.keyCode === 27) {
            resetAddPlaylist();
       } 
    });
    
    $('.playlist.add-playlist .btn').click(function() {
        $(this).hide();
        $('#new-playlist-name').show();
        $('#new-playlist-name').focus();
    });
    
    /*
     * User adds a track
     * 
     */
    var pendingTrack = new PendingTrack();
    
    var popOpts = {
        trigger: 'manual',
        placement: 'bottom',
        html: true
    };
    
    /*
     * Add title, artist, album, genre, year
     * 
     */
    function enterTitle() {
        var opts = $.extend({}, popOpts);
        opts.content = '<input type="text" id="new-track-title-input" placeholder="Enter a title and hit enter" />' +
                '<br /><span class="info_error">Sorry, we need a title name</span>';;
        opts.title = 'New track title';
        $('#new-track-title a')
        .popover(opts)
        .popover('show');
        $('#new-track-title-input').val(pendingTrack.title);
        $('#new-track-title-input').focus();
    }
    function enterArtist() {
        var opts = $.extend({}, popOpts);
        opts.content = '<input type="text" id="new-track-artist-input" placeholder="Enter an artist and hit enter" />' +
                '<br /><span class="info_error">Sorry, we need an artist name</span>';
        opts.title = 'New track artist';
        $('#new-track-artist a')
        .popover(opts)
        .popover('show');
        $('#new-track-artist-input').val(pendingTrack.artist);
        $('#new-track-artist-input').focus();
    }
    function enterAlbum() {
        var opts = $.extend({}, popOpts);
        opts.content = '<input type="text" id="new-track-album-input" placeholder="Enter an album and hit enter" />';
        opts.title = 'New track album';
        $('#new-track-album a')
        .popover(opts)
        .popover('show');
        $('#new-track-album-input').val(pendingTrack.album);
        $('#new-track-album-input').focus();
    }
    function enterGenre() {
        var opts = $.extend({}, popOpts);
        opts.content = '<input type="text" id="new-track-genre-input" placeholder="Enter a genre and hit enter" />';
        opts.title = 'New track genre';
        $('#new-track-genre a')
        .popover(opts)
        .popover('show');
        $('#new-track-genre-input').val(pendingTrack.genre);
        $('#new-track-genre-input').focus();
    }
    function enterYear() {
        var opts = $.extend({}, popOpts);
        opts.content = '<input type="text" id="new-track-year-input" placeholder="Enter a year and hit enter" />';
        opts.title = 'New track year';
        $('#new-track-year a')
        .popover(opts)
        .popover('show');
        $('#new-track-year-input').val(pendingTrack.year);
        $('#new-track-year-input').focus();
    }
    $(document).delegate('#new-track-title-input', 'keypress', function(e) {
       if (e.keyCode === 13) {
           if (!$(this).val()) {
               $(this).parent().find('.info_error').show();
               return;
           }
           pendingTrack.title = $(this).val();
           $('#new-track-title a').popover('hide');
           enterArtist();
       } 
    });
    $(document).delegate('#new-track-artist-input', 'keypress', function(e) {
       if (e.keyCode === 13) {
           if (!$(this).val()) {
               $(this).parent().find('.info_error').show();
               return;
           }
           pendingTrack.artist = $(this).val();
           $('#new-track-artist a').popover('hide');
           enterAlbum();
       } 
    });
    $(document).delegate('#new-track-album-input', 'keypress', function(e) {
       if (e.keyCode === 13) {
           pendingTrack.album = $(this).val();
           $('#new-track-album a').popover('hide');
           enterGenre();
       } 
    });
    $(document).delegate('#new-track-genre-input', 'keypress', function(e) {
       if (e.keyCode === 13) {
           pendingTrack.genre = $(this).val();
           $('#new-track-genre a').popover('hide');
           enterYear();
       } 
    });
    $(document).delegate('#new-track-year-input', 'keypress', function(e) {
       if (e.keyCode === 13) {
           pendingTrack.year = $(this).val();
           $('#new-track-year a').popover('hide');
           $('#new-track-add a').focus();
       } 
    });
    $('#new-track-url').keypress(function(e) {
       if (e.keyCode === 13) {
           pendingTrack.url = $(this).val();
           enterTitle();
       } 
    });
    $('#new-track-add a').keyup(function(e) {
       if (e.keyCode === 13) {
           var pid = parseInt($('.playlist.active').data('playlist-id'));
           $.post('do/action.php', 
                {
                    'action':'newTrack', 
                    'playlistId': pid,
                    'url':pendingTrack.url,
                    'title':pendingTrack.title,
                    'artist':pendingTrack.artist
                },
                function(trackData) {
                    UserPlaylists[pid].addTrack(trackData);
                    pendingTrack = new PendingTrack();
                    $('#new-track-url').val('');
                },
                'json'
           ); 
       }
    });
    
    /*
     * Track Actions [DELETE]
     * 
     */
    $(document).delegate('#action-delete', 'click', function() {
        var trackId = $(this).parents('.track-obj').data('track-id');
        var pid = $('.playlist.active').data('playlist-id');
        UserPlaylists[pid].deleteTrack(trackId);
    });
    
    /*
     * Track Actions [COPY] / [MOVE]
     * 
     */
    function makePlaylistActionButtons(trackId, actionClass) {
        var playlists = $('<div/>');
        $('.playlist').not('.active').not('.add-playlist').each(function() {
            var del = (function() { 
                        if (actionClass === 'move-track') {
                        return $('.playlist.active').data('playlist-id');
                        }
                    })();
            playlists.append('<div class="btn btn-info ' + actionClass + '" ' +
                    'data-track-id="' + trackId + '" ' +
                    'data-playlist-id="' + $(this).data('playlist-id') + '" ' +
                    'data-playlist-id-del="' + del + '" ' +
                    ' style="margin-bottom:5px;">' + 
                    $(this).find('.playlist-name').text() + '</div>');
        });
        return playlists.html();
    }
    $(document).delegate('#action-copy,#action-move', 'click', function() {
        if ($(this).parent().find('.popover').length) {
            $(this).popover('destroy');
            return;
        };
        var trackId = $(this).parents('.track-obj').data('track-id');
        var options = {'placement':'right', 'html': true, 'trigger': 'manual'};
        if ($(this).attr('id') === 'action-copy') {
            options.content = makePlaylistActionButtons(trackId, 'copy-track');
        } else {
            options.content = makePlaylistActionButtons(trackId, 'move-track');
        }
        $(this)
        .popover(options)
        .popover('show');
    });
    $(document).delegate('.copy-track', 'click', function() {
        var trackId = $(this).data('track-id');
        var pid = $(this).data('playlist-id');
        UserPlaylists[pid].acceptCopy(trackId);
        $(this).remove();
    });
    $(document).delegate('.move-track', 'click', function() {
        var trackId = $(this).data('track-id');
        var pid = $(this).data('playlist-id');
        var dpid = $(this).data('playlist-id-del');
        UserPlaylists[pid].acceptCopy(trackId);
        UserPlaylists[dpid].deleteTrack(trackId);
        $(this).remove();
    });
    
    
    /*
     * Check if active user
     * 
     */
    if (!$('#active-user').text()) {
        $('#login-tab').show();
    }
    
    /*
     * A-Z
     * 
     */
    var a_z = '*ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
    for (i = 0; i < a_z.length; i++) {
        $('#playlist-a-z').append("<div class='a-z-letter'>" + a_z[i] + "</div>");
    }
    
    /*
     * User Registration
     * 
     */
    $('#registration-submit').click(function(e){
       var email = $('#registration-email').val();
       var pass = $('#registration-pass').val();
       var errors = false;
       if (!isValidEmailAddress(email)) {
           $('#validation-email').show();
           errors = true;
       }
       else {
           $('#validation-email').hide();  
       }
       if (pass.length < 6 || pass.length > 10) {
           $('#validation-pass').show();
           errors = true;
       } else {
           $('#validation-pass').hide();  
       }
       if (errors) {
           e.preventDefault();
           return;
       }
       $('.validation-alert').hide();
       $('#registration-loader').show();
       $.post( 'do/action.php',
            {'action':'registerUser', 'email':email, 'pass':pass}, 
            function(data) {
                $('#registration-loader').hide();
                var msg = $('#validation-submit').text(data.message);
                if (data.success) {
                    $('#registration-submit').hide();
                    msg.addClass('alert-success'); 
                } else {
                    msg.addClass('alert-error');
                }
                $('#validation-submit').fadeIn();
            },
            'json'
        );
    });
    
    /*
     * User Sign In
     * 
     */
    $('#login').click(function() {
       var email = $('#login-email').val();
       var pass = $('#login-pass').val();
       $.post( 'do/action.php',
            {'action':'loginUser', 'email':email, 'pass':pass},
            function(action) {
                if (action.success) {
                    location.reload(true);
                }
                else
                    alert('Username or password incorrect');
            },
            'json'
        );
    });
       
    /*
     * Editing a playlist name
     * 
     */
    $(document).delegate('.user-playlist-tab', 'dblclick', function() {
       if ($(this).find('input').length)
           return;
       $(this).parent().not($(this)).each(function() {
           $(this).find('input').remove();
           $(this).find('a').show();
       });
       $(this).find('a').hide();
       $(this).append('<input type="text" class="user-playlist-name-edit" placeholder="New playlist name">');
       $(this).find('input').focus();
    });
    $(document).delegate('.user-playlist-name-edit', 'keypress', function(e) {
        if (e.keyCode === 13) {
            var name = $(this).val();
            if (!name) return;
            var p = $(this).parent('.user-playlist-tab');
            p.find('.user-playlist-name-edit').remove();
            p.find('a').text(name).show();
            
            // sync to database
        }
    });
    
    /*
     * Adding a new playlist
     * 
     */
    $('.btn.user-playlist-add').click(function(){
        $li = $(this).parent();
        $tabs = $li.parent();
        $li.addClass('user-playlist-tab');
        $tabs.append($("<li></li>").append($(this)));
        //$(this).hide();
        $li.append("<a href='#id-playlist-1' data-toggle='tab'>New Playlist</a>");
        //$(this).show();
    });
}); 


