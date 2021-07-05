var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;
$(document).click(function (click) {
    var target = $(click.target);

    if (target.hasClass("bg") || target.hasClass("CreatePlaylistButton")) {
        $("#PlaylistModel").hide();
        $("#CreatePlaylistModel").hide();
        $("#PlaylistModelBox").show();
    }

});

function logout() {
	$.post("includes/handlers/ajax/logout.php", function() {
		location.reload();
	});
}
function updateEmail(emailClass) {
	var emailValue = $("." + emailClass).val();

	$.post("includes/handlers/ajax/updateEmail.php", { email: emailValue, username: userLoggedIn})
	.done(function(response) {
		$("." + emailClass).nextAll(".message").text(response);
	})


}

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
	var oldPassword = $("." + oldPasswordClass).val();
	var newPassword1 = $("." + newPasswordClass1).val();
	var newPassword2 = $("." + newPasswordClass2).val();

	$.post("includes/handlers/ajax/updatePassword.php", 
		{ oldPassword: oldPassword,
			newPassword1: newPassword1,
			newPassword2: newPassword2, 
			username: userLoggedIn})

	.done(function(response) {
		$("." + oldPasswordClass).nextAll(".message").text(response);
	})


}

console.log(userId);
function LikeButtonClickHandler(button, i) {
    return function LikeButtonClickHandlerCurried() {
        Remove = button
            .classList
            .contains("liked")
            ? true
            : false;

        button.classList.toggle("liked");
        SongId = tempPlaylist[i];
        if (Remove) {
            $.post("includes/handlers/ajax/updatePlaylist.php", {
                songId: SongId,
                remove: Remove,
                playlistid: -1,
                userId:userId
            },function(data){
                console.log(data);
            });

        } else {
            $.post("includes/handlers/ajax/updatePlaylist.php", {
                songId: SongId,
                playlistid: -1,
                userId:userId
            },function(data){
                console.log(data);
            });
        }
    }
}
function OptionButtonClickHandler(button, i) {
    return function OptionButtonClickHandlerCurried() {}
}
function TrackControls() {
    const LikedButtons = document.getElementsByClassName("likedButton");
    const OptionsButtons = document.getElementsByClassName("optionsButton");
    for (let i = 0; i < OptionsButtons.length; i++) {
        OptionsButtons[i].addEventListener("click", OptionButtonClickHandler(OptionsButtons[i], i));
    }
    for (let i = 0; i < LikedButtons.length; i++) {
        LikedButtons[i].addEventListener("click", LikeButtonClickHandler(LikedButtons[i], i));
    }

}

function Destroy() {
    const LikedButtons = document.getElementsByClassName("likedButton");
    for (let i = 0; i < LikedButtons.length; i++) {
        LikedButtons[i].removeEventListener("click", LikeButtonClickHandler);
    }
    TrackContainer = document.getElementsByClassName('tracklistRow');
    for (let i = 0; i < TrackContainer.length; i++) {
        TrackContainer[i].removeEventListener('click', TrackContainerClickHandler)
    }
}

window
    .addEventListener("popstate", function () {
        var url = location.href;
        openPagePushState(url);
    })
function openPagePushState(url) {
	clearTimeout(timer);
    if (url.indexOf("?") === -1) {
        url = url + "?";
    }
    console.log(userLoggedIn);
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl, function () {
        Destroy();
        TrackControls();
    });
    $("body").scrollTop(0);
}
function openPage(url) {
    openPagePushState(url);
    history.pushState(null, null, url);
}
function formatTime(seconds) {
    
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60); //Rounds down
    var seconds = time - (minutes * 60);

    var extraZero = (seconds < 10)
        ? "0"
        : "";

    return minutes + ":" + extraZero + seconds;
}
function updateTimeProgressBar(audio) {
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    var progress = audio.currentTime / audio.duration * 100;
    $(".playbackBar .progress").css("width", progress + "%");
}
function updateVolumeProgressBar(audio) {
    var volume = audio.volume * 100;
    $(".volumeBar .progress").css("width", volume + "%");
}
function playFirstSong() {
    setTrack(tempPlaylist[0], tempPlaylist, true);
}
function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this
        .audio
        .addEventListener("ended", function () {
            nextSong();
        });

    this
        .audio
        .addEventListener("canplay", function () {
            //'this' refers to the object that the event was called on
            var duration = formatTime(this.duration);
            $(".progressTime.remaining").text(duration);
        });

    this
        .audio
        .addEventListener("timeupdate", function () {
            if (this.duration) {
                updateTimeProgressBar(this);
            }
        });

    this
        .audio
        .addEventListener("volumechange", function () {
            updateVolumeProgressBar(this);
        });

    this.setTrack = function (track) {
        this.currentlyPlaying = track;
        this.audio.src = track.songpath;
    }

    this.play = function () {
        this
            .audio
            .play();
    }

    this.pause = function () {
        this
            .audio
            .pause();
    }

    this.setTime = function (seconds) {
        this.audio.currentTime = seconds;
    }

}
