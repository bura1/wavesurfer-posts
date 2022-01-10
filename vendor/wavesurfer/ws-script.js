var wsArchive = document.getElementsByClassName("ws_post_column");
var wsPosts = [];
var currentPlaying = '';

Array.prototype.forEach.call(wsArchive, function(column) {
    Array.prototype.forEach.call(column.children, function(el) {
        if (el.id.startsWith("waveform-")) {
            var ws_post_el = document.getElementById(el.id);
            wsPosts[el.id] = WaveSurfer.create({
                container: '#' + el.id,
                waveColor: ws_post_el.getAttribute("wave-color"),
                progressColor: ws_post_el.getAttribute("progress-color"),
                cursorColor: ws_post_el.getAttribute("cursor-color")
            });
            wsPosts[el.id].load(ws_post_el.getAttribute("file-url"));
            wsPosts[el.id].on('finish', function () {
                document.getElementById("wsbtn-" + el.id.substr(9)).className = "wsbtn wsbtn-play";
            });
        }
    });
});

function playStop(id) {
    var wsid = "waveform-" + id;
    var btnid = "wsbtn-" + id;
    var wsbtn = document.getElementById(btnid);
    
    if (currentPlaying == id && wsPosts[wsid].isPlaying()) {
        wsPosts[wsid].pause();
        currentPlaying = '';
        wsbtn.className = "wsbtn wsbtn-play";
    } else if (currentPlaying != id && currentPlaying != '') {
        wsPosts["waveform-" + currentPlaying].pause();
        document.getElementById("wsbtn-" + currentPlaying).className = "wsbtn wsbtn-play";

        wsPosts[wsid].play();
        wsbtn.className = "wsbtn wsbtn-pause";
        currentPlaying = id;
    } else {
        wsPosts[wsid].play();
        currentPlaying = id;
        wsbtn.className = "wsbtn wsbtn-pause";
    }
}