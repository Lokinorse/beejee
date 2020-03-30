$.get('tasks/xhrGetTasks', function (data){
    console.log($('.card-text'));
    for (let i=0; i<data.length; i++){
/*             $('.list-wrapper').append(data[i].task); */
        $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" + data[i].email + "</h6><p class='card-text'>" + data[i].task + "</p></div></div>");
    }
}, 'json');
$('#post').submit(function (){
    const url = $(this).attr('attribute')
    const data = $(this).serialize();
    $.post(url, data, function(e){
    })
})