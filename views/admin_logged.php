<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<div class="containter">
    <div class="col-xl-5  mx-auto  form p-4">
        <div class="text-right mb-3">
            <a href="admin_logged/logout" class="btn btn-dark">Logout</a>
        </div>
        <h3>Добро пожаловать, вы наделены властью админа.</h3>
        <form id ='post' class='mw-50' attribute ='tasks/xhrPost'>
            <div class="form-group">
                <label for="username">Nickname</label>
                <input type="text" class="form-control" name ="name" id="exampleInputPassword1" placeholder="Nickname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name ="email" class="form-control" id="exampleInputEmail1" aria-describedby="  emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Create new task</label>
                <textarea class="form-control" name ="task" id="exampleFormControlTextarea1" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
        <hr />
        <div class="list-wrapper">

        </div>
        <div id = 'pagination' style='float: right;'>page</div>
    </div>
</div>
<script type='text/javascript'>
$.get('tasks/xhrGetTasks', function (data){
    for (let i=0; i<data.length-1; i++){
    $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" + data[i].email + "</h6><p class='card-text'>" + data[i].task + "</p><button onClick='window.location.reload();' attr_id = '" + data[i].id + "' type='submit' class='btn btn-danger'>Remove</button> </div></div>");
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
        $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" + data[i].email + "</h6><p class='card-text'>" + data[i].task + "</p><button onClick='window.location.reload();' attr_id = '" + data[i].id + "' type='submit' class='btn btn-danger'>Remove</button> </div></div>");
        }

}, 'json');

    });



$('#post').submit(function (){
    event.preventDefault();
    const url = $(this).attr('attribute')
    const data = $(this).serialize();
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

    $(document).on('click', '.btn-danger', function (e) {
        const post_id = $(this).attr('attr_id');
        $.post('tasks/xhrDeleteTasks', post_id, function(e){
        })

    });

</script>
