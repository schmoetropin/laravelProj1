if(document.querySelector('.topId')){
    document.querySelectorAll('.topId').forEach(function(values){
        var id = values.value;
        document.getElementById('topic'+id).addEventListener('mouseover', function(){
            document.getElementById('topicVideo'+id).play()
        });
        document.getElementById('topic'+id).addEventListener('mouseleave', function(){
            document.getElementById('topicVideo'+id).pause()
        });
    });
}