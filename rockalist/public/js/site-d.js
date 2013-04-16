UserPlaylists = {};
var a_z = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
var a_z0_9 = '0123456789'.split('').concat(a_z);
var sortMode = 'Title';

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
var currentPlaylistId = null;
var Playlist = function(playlistData) {
    this.template = Handlebars.compile($('#tpl-playlist').html());
    this.data = playlistData;
    this.tracks = {};
    this.cacheId = 'playlist-cache-' + this.data.Id;
    this.titleSort = new Array();
    this.artistSort = new Array();
    this.albumSort = new Array();
    this.sortTracks = function() {
      switch (sortMode) {
           case 'Title':
               this.sortTitles();
           break
           case 'Artist':
               this.sortArtists();
           break;
           case 'Album':
               this.sortAlbums();
           break;
      }
      var cache = $('#' + this.cacheId);
      cache.find('.sort-bucket').each(function() {
         if (!$(this).find('.track-obj').length) {
             $(this).hide();
         }
      });
    };
    this.sortTitles = function() {
        this.titleSort.sort(function(a,b) {
            return a.name.localeCompare(b.name);
        });
        var cache = $('#' + this.cacheId);
        for(t in this.titleSort) {
            var title = this.titleSort[t].name;
            var trackId = this.titleSort[t].id;
            var titleFirstLetter = title.charAt(0).toUpperCase();
            var bucket = cache.find('.sort-bucket[data-sort-id="' + titleFirstLetter + '"]');
            cache.find('.track-obj[data-track-id="' + trackId + '"]').appendTo(bucket);
            bucket.show();
        }
    };
    this.sortArtists = function() {
        this.artistSort.sort(function(a,b) {
            return a.name.localeCompare(b.name);
        });
        var cache = $('#' + this.cacheId);
        for(t in this.artistSort) {
            var artist = this.artistSort[t].name;
            var trackId = this.artistSort[t].id;
            var artistFirstLetter = artist.charAt(0).toUpperCase();
            var bucket = cache.find('.sort-bucket[data-sort-id="' + artistFirstLetter + '"]');
            cache.find('.track-obj[data-track-id="' + trackId + '"]').appendTo(bucket);
            bucket.show();
        }
    };
    this.sortAlbums = function() {
        this.albumSort.sort(function(a,b) {
            return a.name.localeCompare(b.name);
        });
        var cache = $('#' + this.cacheId);
        for(t in this.albumSort) {
            var album = this.albumSort[t].name;
            var trackId = this.albumSort[t].id;
            var albumFirstLetter = album.charAt(0).toUpperCase();
            var bucket = cache.find('.sort-bucket[data-sort-id="' + albumFirstLetter + '"]');
            cache.find('.track-obj[data-track-id="' + trackId + '"]').appendTo(bucket);
            bucket.show();
        }
    };
    this.addTrack = function(trackData) {
        var t = new Track(trackData, this.cacheId);
        var trackId = t.data.Id;
        this.tracks[trackId] = t;
        this.addToSort(t);
        t.render();
    };
    this.addToSort = function(track) {
        this.titleSort.push({name: track.data.Title, id: track.data.Id});
        this.artistSort.push({name: track.data.ArtistName, id: track.data.Id});
        if (track.data.AlbumName) {
            this.albumSort.push({name: track.data.AlbumName, id: track.data.Id});
        } else {
            this.albumSort.push({name: 'Unknown', id: track.data.Id});
        }
    };
    this.acceptCopy = function(trackId) {
        $.post('do/action.php', {'action':'copyTrack', 'trackId':trackId, 'playlistId': this.data.Id},
                function(trackData) {
                    //console.log(trackData);
                },
                'json'
           ); 
    };
    this.getTracks = function() { 
        var self = this;
        if ($('#' + this.cacheId).hasClass('cached')) {
            $('#' + this.cacheId).appendTo('#tracks').removeClass('cached');
        } else {
            /*
            * Create sort buckets
            * 
            */
           var playlist = $('<div/>');
           playlist.attr('id', this.cacheId);
           for(v in a_z0_9) {
               playlist.append(
                   '<div class="sort-bucket" data-sort-id="'+ a_z0_9[v] + '">' +
                   '<div class="sort-marker">' + a_z0_9[v] + '</div>'
                   );
           }
           playlist.appendTo($('#tracks'));
           $.post('do/action.php', {'action':'getTracks', 'playlistId': this.data.Id},
                    function(playlisttracks) {
                        for(precId in playlisttracks) {
                            self.addTrack(playlisttracks[precId]);
                        }
                        self.sortTracks();
                    },
                    'json'
           ); 
        }
    };
    this.deleteTrack = function(trackId) {
        //delete from database
        //delete from playlist
        var self = this;
        $.post('do/action.php', {'action':'deleteTrack', 'playlistId': this.data.Id, 'trackId':trackId}, 
            function(trackData) {
                delete self.tracks[trackId];
                var cache = $('#'+ self.cacheId);
                var track = cache.find(".track-obj[data-track-id='" + trackId + "']");
                var hideBucket = false;
                var trackBucket = track.parents('.sort-bucket');
                if (trackBucket.children('.track-obj').length === 1) {
                    hideBucket = true;
                }
                track.remove();
                if (hideBucket) {
                    trackBucket.hide();
                }
            }, 
        'json');
        
    };
    this.editTrack = function(trackId, trackDetails) {
        var self = this;
        $.post('do/action.php', 
            $.extend({'action':'editTrack', 'trackId':trackId}, trackDetails),
            function(trackData) {
                delete self.tracks[trackId];
                var newTrack = new Track(trackData, self.cacheId);
                this.tracks[trackId] = newTrack;
                this.addToSort(newTrack);
                var cache = $('#'+ self.cacheId);
                cache.find(".track-obj[data-track-id='" + trackId + "']").remove();
                newTrack.render();
            },
        'json');
    };
    this.render = function() {
        var context = {'id': this.data.Id, 'name': this.data.Name};
        $('.playlist.add-playlist').before(this.template(context));
    };
    this.cache = function() {
        $('#' + this.cacheId).addClass('cached').appendTo($('#cache'));
    };
};
Playlist.getTrack = function(trackId) {
    return UserPlaylists[currentPlaylistId].tracks[trackId];
};
var Track = function(trackData, cacheId) {
    this.template = Handlebars.compile($('#tpl-track').html());
    this.cacheId = cacheId;
    this.data = trackData;
    this.render = function() {
        var context = {
                'id':this.data.Id,
                'synced':this.data.Synced,
                'title':this.data.Title,
                'artist':this.data.ArtistName};
        //$('#temp-sort').append(this.template(context));
        var bucket = $('#' + this.cacheId + ' .sort-bucket[data-sort-id="' + this.data.Title.charAt(0).toUpperCase() + '"]');
        bucket.append(this.template(context));
    };
    return this;
};
Track.edit_template = Handlebars.compile($('#tpl-track-edit').html());

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
     * Sorting tracks
     * 
     */
    function performSort(mode) {
        sortMode = mode;
        UserPlaylists[currentPlaylistId].sortTracks();
    }
    $('.sort-link').click(function() {
        if ($(this).hasClass('selected')) {
            return;
        }
        $('.sort-link.selected').removeClass('selected');
        $(this).addClass('selected');
        performSort($(this).text());
    });
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
        var pid = $('.playlist.active').data('playlist-id');
        if (currentPlaylistId) {
            UserPlaylists[currentPlaylistId].cache();
        }
        currentPlaylistId = pid;
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
           $.post('do/action.php', 
                {
                    'action':'newTrack', 
                    'playlistId': currentPlaylistId,
                    'url':pendingTrack.url,
                    'title':pendingTrack.title,
                    'artist':pendingTrack.artist
                },
                function(trackData) {
                    UserPlaylists[currentPlaylistId].addTrack(trackData);
                    UserPlaylists[currentPlaylistId].sortTracks();
                    pendingTrack = new PendingTrack();
                    $('#new-track-url').val('');
                },
                'json'
           ); 
       }
    });
    
    function killPopovers() {
        $('.popover').remove();
    }
    /*
     * Track Actions [DELETE]
     * 
     */
    $(document).delegate('#action-delete', 'click', function() {
        var trackId = $(this).parents('.track-obj').data('track-id');
        UserPlaylists[currentPlaylistId].deleteTrack(trackId);
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
                        return currentPlaylistId;
                        }
                    })();
            playlists.append('<div class="btn btn-info ' + actionClass + '" ' +
                    'data-track-id="' + trackId + '" ' +
                    'data-playlist-id="' + $(this).data('playlist-id') + '" ' +
                    'data-playlist-id-del="' + del + '" ' +
                    ' style="margin-bottom:5px;">' + 
                    $(this).find('.playlist-name').text() + '</div><br/>');
        });
        return playlists.html();
    }
    $(document).delegate('#action-copy,#action-move', 'click', function() {
        if ($(this).parent().find('.popover').length) {
            $(this).popover('destroy');
            return;
        };
        var trackId = $(this).parents('.track-obj').data('track-id');
        killPopovers();
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
        dumpCache(pid);
        $(this).remove();
    });
    $(document).delegate('.move-track', 'click', function() {
        var trackId = $(this).data('track-id');
        var pid = $(this).data('playlist-id');
        var dpid = $(this).data('playlist-id-del');
        UserPlaylists[pid].acceptCopy(trackId);
        dumpCache(pid);
        UserPlaylists[dpid].deleteTrack(trackId);
        $(this).remove();
    });
    function dumpCache(pid) {
      if ($('#playlist-cache-'+pid).length) {
          $('#playlist-cache-'+pid).remove();
      }  
    };
    
    /*
     * Track Actions [EDIT]
     * 
     */
    $(document).delegate('#action-edit','click', function() {
        if ($(this).parent().find('.popover').length) {
            $(this).popover('destroy');
            return;
        };
        killPopovers();
        var trackId = $(this).parents('.track-obj').data('track-id');
        var track = Playlist.getTrack(trackId);
        var options = {'placement':'left', 'html': true, 'trigger': 'manual'};
        options.content = Track.edit_template({'id':trackId});
        $(this)
        .popover(options)
        .popover('show');
        $('#edit-url').val(track.data.Url);
        $('#edit-title').val(track.data.Title);
        $('#edit-artist').val(track.data.ArtistName);
        $('#edit-album').val(track.data.AlbumName);
        $('#edit-genre').val(track.data.Genre);
        $('#edit-year').val(track.data.Year);
    });
    
    $(document).delegate('#commit-edit','click', function() {
        var u,t,ar,al,g,y;
        if (!$('#edit-url').val()) {
            $('#edit-url').focus();
            return;
        }
        u = $('#edit-url').val();
        if (!$('#edit-title').val()) {
            $('#edit-title').focus();
            return;
        }
        t = $('#edit-title').val();
        if (!$('#edit-artist').val()) {
            $('#edit-artist').focus();
            return;
        }
        ar = $('#edit-artist').val();
        al = $('#edit-album').val();
        g = $('#edit-genre').val();
        y = $('#edit-year').val();
        var trackId = $(this).parent().data('track-id');
        UserPlaylists[currentPlaylistId].editTrack(trackId, {
           'url':u,
           'title':t,
           'artist':ar,
           'album':al,
           'genre':g,
           'year':y
        });
    });
    /*
     * Track Actions [RATE] 
     * 
     */
    $(document).delegate('#action-rate','click', function() {
        
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
    $('#playlist-a-z').append("<div class='a-z-letter'>*</div>");
    for (i = 0; i < a_z0_9.length; i++) {
        $('#playlist-a-z').append("<div class='a-z-letter'>" + a_z0_9[i] + "</div>");
    }
    $(document).delegate('.a-z-letter', 'click', function() {
        if ($(this).text() === '*') {
            $('#tracks .sort-bucket').each(function() {
               if ($(this).children().length > 1) {
                   $(this).show();
               } else {
                   $(this).hide();
               }
            });
        } else {
            $('#tracks .sort-bucket[data-sort-id="' + $(this).text() + '"]').show();
            $('#tracks .sort-bucket[data-sort-id!="' + $(this).text() + '"]').hide();
        }
    });
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


