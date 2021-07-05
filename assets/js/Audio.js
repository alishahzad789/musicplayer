var currentPlaylist = [];
var audioElement;

function formatTime(seconds) {
	var time = Math.round(seconds);
	var minutes = Math.floor(time / 60); //Rounds down
	var seconds = time - (minutes * 60);

	var extraZero = (seconds < 10) ? "0" : "";

	return minutes + ":" + extraZero + seconds;
}

function AudioListeners(audio) {
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

	audio.addEventListener("ended", function() {
		nextSong();
	});

	audio.addEventListener("canplay", function() {
		//'this' refers to the object that the event was called on
		var duration = formatTime(this.duration);
		$(".progressTime.remaining").text(duration);
	});

	audio.addEventListener("timeupdate", function(){
		if(this.duration) {
			updateTimeProgressBar(this);
		}
	});

	audio.addEventListener("volumechange", function() {
		updateVolumeProgressBar(this);
	});
}
function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio');
    AudioListeners(this.audio);

	this.setTrack = function(track) {
		this.currentlyPlaying = track;
		this.audio.src = track.songpath;
	}

	this.play = function() {
		this.audio.play();
	}

	this.pause = function() {
		this.audio.pause();
	}

	this.setTime = function(seconds) {
		this.audio.currentTime = seconds;
	}
}