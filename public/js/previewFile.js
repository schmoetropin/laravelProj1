if(document.getElementById('createTopicFile')){
    var inputFile = document.getElementById('createTopicFile');
    var divMedia = document.getElementById('createTopicMedia');
    inputFile.addEventListener('change',function(e){
        var type = e.target.files[0].type;
        if(type === 'image/jpeg' || type === 'image/jpg' || type === 'image/png'){
            if(document.getElementById('editTopicHiddenInput'))
                divMedia.innerHTML = "<img id='mediaPreview' style='height: 197px;' />"
            else
                divMedia.innerHTML = "<img id='mediaPreview' style='height: 247px;' />"
        }else if(type === 'video/mp4'){       
            if(document.getElementById('editTopicHiddenInput'))
                divMedia.innerHTML = "<video id='mediaPreview' style='height: 197px;' controls autoplay mute></video>"
            else
                divMedia.innerHTML = "<video id='mediaPreview' style='height: 247px;' controls autoplay mute></video>"
        }else{
            divMedia.innerHTML = "<p style='color: #E53935;'>*Unsuported file</p>";
        }
        var preview = document.getElementById('mediaPreview');
        preview.src = URL.createObjectURL(e.target.files[0]);
        preview.onload() = function(){
            URL.revokeObjectURL(preview.src);
        }
    });
}