<?php 
    $i = 1;
    foreach($SongArray as $songId) {

        $playlistSong = new Song($con, $songId);
        $songArtist = $playlistSong->getArtist();
        $likedSong = $playlistSong->IsSongLiked($userId,$songId) ? "liked likedButton" :"likedButton";

        echo "<li id = 'trackId".$i."' class='tracklistRow'>
                    <div class='trackCount'>
                        <img id = 'playButton".$i."' class='play' src='assets/images/icons/play-white.png' onclick=''>
                        <img id = 'pauseButton".$i."' class='pause' src='assets/images/icons/pause-green.png'>							
                        <span class='trackNumber'>$i</span>
                    </div>
                    <div class='trackInfo'>
                        <span class='trackName'>" . $playlistSong->getTitle() . "</span>
                        <span class='artistName'>" . $songArtist->getName() . "</span>
                    </div>
                    <div class='trackOptions'>
                        <input type='hidden' class='songId' value='" . $playlistSong->getId() . "'>
                        <div data-songId = '".$songId."' class ='".$likedSong."'>
                            <svg viewBox='0 -28 512.00002 512'>
                                <path d='m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0'/>
                            </svg>
                        </div>
                        <div data-songId = ". $songId. " class='optionsButton' onclick = 'showOptions(this)'>
                            <img  src='assets/images/icons/more.png'>
                        </div>
                        
                    </div>
                    <div class='trackDuration'>
                        <span class='duration'>" . $playlistSong->getDuration() . "</span>
                    </div>
            </li>";

        $i = $i + 1;
    }
?>
<div data-songId = -1 id = "PlaylistModel" class = "PlaylistModelContainer" >
    <div class = "bg"></div>
    <div class="PlaylistModel" id = "PlaylistModelBox">
        <h2>Add to Playlist...</h2>
        <div id = "playlistsId" class = "playlists">
            <div class="playlist newplaylist" onclick = "createNewPlaylist()">
                <p>Create New Playlist</p>
            </div>
            <?php 
                $i =0;
                foreach($playlistsAll as $playlist){                    
                    echo "
                    <div class='playlist' onclick = addToPlaylist(".json_encode($playlist).") >
                        <p class = 'playlistName'>".$playlist["playlistname"]."</p>
                        <img data-playlistId = ".$playlist['playlistid']." class = 'playlistTick' src = 'assets/images/icons/tick.png'></img>
                    </div>";
                    $i++;
                }
            ?>
        </div>
    </div>
    <div class = "CreatePlaylist" id = "CreatePlaylistModel">
        <h2>Create Playlist</h2>
        <form id = "newPlaylistForm" method="post" action = "includes/handlers/ajax/newPlaylist.php">
            <input type = "hidden" name = "userid" value = '<?php echo $userId; ?>'></input>
            <input type = "text" name = "title" value = ""></input>
            <div class = "buttons">
                <button type = "submit" class = "CreatePlaylistButton" name = "SubmitButton">Save</button>
                <button class = "CreatePlaylistButton" name = "CancelButton">Cancel</button>
            </div>
        </form> 
    </div>
</div>
<script>
    function createNewPlaylist(){
        document.getElementById("PlaylistModelBox").style.display = "none";
        document.getElementById("CreatePlaylistModel").style.display = "block";
    }
    $("#newPlaylistForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data){
                <?php $playlistsAll = $playlists->getPlaylists(); ?>
                addToPlaylist(JSON.parse(data))
            }
        });

    });
    function TrackContainerClickHandler(TrackContainer, i ){
        return function TrackContainerClickHandlerCurry(event){
            let target = $(event.target);
            if (target.hasClass("likedButton")) return false;
            if (target.hasClass("optionsButton")) return false;
            if (TrackContainer[i].classList.contains('Playing')) {
                pauseSong();
                for (let i = 0; i < TrackContainer.length; i++) {
                    TrackContainer[i].classList.remove('Playing')
                }
            } else {
                setTrack(tempPlaylist[i], tempPlaylist, true);
                for (let i = 0; i < TrackContainer.length; i++) {
                    TrackContainer[i].classList.remove('Playing')
                }
                TrackContainer[i].classList.add('Playing')
            }
        }
    }
    Playlists = document.getElementsByClassName("playlistName");
    PlaylistsTick = document.getElementsByClassName("playlistTick");    
    Model = document.getElementById("PlaylistModel");
    tempSongIds = '<?php echo json_encode($SongArray) ?>';
    tempPlaylist = Object.values(JSON.parse(tempSongIds));
    TrackContainer = document.getElementsByClassName('tracklistRow');
    for (let i = 0; i < TrackContainer.length; i++) {
        TrackContainer[i].addEventListener('click', TrackContainerClickHandler(TrackContainer,i))
    }
    function showOptions(target){
        Model.style.display = "flex";
        TrackIndex = target.getAttribute("data-songId");
        Model.setAttribute("data-songId", TrackIndex);  
        
        for(let i=0; i < Playlists.length;i++){
            $.post("includes/handlers/ajax/editPlaylist.php",{
                songId: TrackIndex,
                playlistname: Playlists[i].innerText
            },function(response){
                if (response == "true"){
                    PlaylistsTick[i].style.display = "block";
                }
            })
        }
              
    }
    function addToPlaylist(playlist){
        SongId = Model.getAttribute("data-songId");
        let PlaylistTick = null;
        for(let i=0 ; i< PlaylistsTick.length;i++){
            if (PlaylistsTick[i].getAttribute("data-playlistId") == playlist['playlistid']){
                PlaylistTick = PlaylistsTick[i];
            }
        }
        if (PlaylistTick == null){
            let playlistsId = document.getElementById("playlistsId");
             PlaylistTick = playlistsId.insertAdjacentHTML("afterend", '<div class="playlist" onclick = addToPlaylist('+
             playlist+')><p class = "playlistName">'+playlist['playlistname'] +
             '</p><img data-playlistId = '+ playlist['playlistid'] + ' class = "playlistTick" src = "assets/images/icons/tick.png"></img></div>')   
             PlaylistsTick = document.getElementsByClassName("playlistTick");
             for (let i = 0; i < PlaylistsTick.length; i++) { 
                if (PlaylistsTick[i].getAttribute("data-playlistId") == playlist['playlistid']) {
                     PlaylistTick = PlaylistsTick[i];
                 }
             }
        }
         if ($(PlaylistTick).css("display") === 'none'){
             $.post("includes/handlers/ajax/updatePlaylist.php", {
                     songId: SongId,
                     playlistid: playlist["playlistid"]
             },function(response){
                 //console.log(response)
                 PlaylistTick.style.display = "block";
             });
         }
         else{
             $.post("includes/handlers/ajax/updatePlaylist.php", {
                     songId: SongId,
                     playlistid: playlist["playlistid"],
                     remove:true
             },function(response){
                 //console.log(response)
                 PlaylistTick.style.display = "none";
             });
         }
    }
</script>