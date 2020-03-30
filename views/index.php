<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<div class="containter">
    <div class="col-xl-5  mx-auto  form p-4">
        <div class="text-right mb-3">
            <a href="/admin" class="btn btn-dark">Login</a>
        </div>
        <form id ='post' class='mw-50' attribute ='tasks/xhrPost'><!--  action ='index/xhrPost' -->
            <div class="form-group">
                <label for="username">Nickname</label>
                <input type="text" required class="form-control" name ="name"  placeholder="Nickname">
                <input type="hidden" name="statuss"  value="0">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input required type="email" name ="email" class="form-control"  aria-describedby="  emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Create new task</label>
                <textarea required class="form-control" name ="task"  rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
        <div id ='msg' style='background-color: #51f724; margin-top:5px'></div>
        <hr />
        <div class="list-wrapper">
        </div>
        <div id = 'pagination' style='float: right;'>page</div>
    </div>
</div>
<script type="text/javascript">
$.get('tasks/xhrGetTasks', function (data){
    for (let i=0; i<data.length-1; i++){
    $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" + data[i].email + "</h6><p class='card-text'>" + data[i].task + "</p> </div></div>");
    }
    let pages = data.slice(-1)[0];
    for (let i=1; i<=pages+1; i++){
        $('#pagination').append("<span class='paginHref' style=' padding: 5px; cursor:pointer;' rel ='"+i+"'>"+i+"</span>");
    }

}, 'json');

$(document).on('click', '.paginHref', function (e) {
      let numPage = $(this).attr('rel');
      $('.list-wrapper').empty();
      let url = 'tasks/xhrGetTasks/' + numPage;
      console.log(url);
      $.get(url, function (data){
        for (let i=0; i<data.length-1; i++){
        $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" + data[i].email + "</h6><p class='card-text'>" + data[i].task + "</p> </div></div>");
        }

}, 'json');

    });



$('#post').submit(function (){
    event.preventDefault();
    const url = $(this).attr('attribute')
    const data = $(this).serialize();
/*     const send = $.post(url, data, function(e){  
    }) */
    $.ajax({
        method: "POST",
        url: url,
        data: data
    })
  .done(function( msg ) {
    $("#msg").append('Задание успешно добавлено!');
    setTimeout(function(){
        location.reload();
    }, 600)
  });

})


</script>
