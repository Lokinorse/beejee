<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<div class="containter">
    <div class="col-xl-5  mx-auto  form p-4">
        <div class="text-right mb-3">
            <a href="/admin_logged/logout" class="btn btn-dark">Logout</a>
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
                    <!-- //сортировка -->
        <div style = 'padding-top: 20px;'>
            <form method="get" id="order">
                <select class="form-control" name="select" onchange='' style="width:200px">  <!-- onchange='this.form.submit()' -->
                <option disabled selected value> -- select an option -- </option>
                <option value="name_plus">By name(Asc.)</option>
                <option value="name_minus">By name(Desc.)</option>
                <option value="mail_plus">By email(Asc.)</option>
                <option value="mail_minus">By email(Desc.)</option>
                <option value="status_off">Uncompleted first</option>
                <option value="status_on">Completed first</option>
                </select>
            </form>
        </div>
        <div id ='msg' style='background-color: #51f724; margin-top:5px'></div>
        <hr />
        <div class="list-wrapper">
        </div>
        <div id = 'pagination' style='float: right;'>page</div>
    </div>
</div>
<script type='text/javascript'>
let name=null;
//Рендер
function getTasks(data){
    for (let i=0; i<data.length-2; i++){
        let status;
        $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" 
        + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" 
        + data[i].email + "</h6><p class='card-text'>" 
        + data[i].task + "</p><button onClick='window.location.reload();' attr_id = '" 
        + data[i].id + "' type='submit' class='btn btn-danger'>Remove</button></br></br><span attr_id='" + data[i].id + "'"
        + statusFunc(data[i].status, status)+"</span><br><span attr_id='" + data[i].id + "' style='cursor:pointer'; >Редактировать</span></div></div>");
    }
    $( document ).ready(function() {
        let curPage =     $('#pagination').children()[data[data.length - 1]];
        $(curPage).css('color', 'red');
    });
}

function statusFunc (datastatus, status){
        if(datastatus==0){
            status = " style='cursor:pointer'; id='status' class='badge badge-secondary'>Not done yet...</span>";
        } else {
            status =" style='cursor:pointer'; id='status' class='badge badge-success'>Done!";
        }
        return status;
}
///Cортировка
$('select').change(function(){
    $('.list-wrapper').empty();
    name = this.value;
    let url = 'tasks/xhrGetTasks/1/' + name;
    $.get(url, function (data){
        getTasks(data);

    }, 'json');
})  


///Первый рендер страницы
$.get('tasks/xhrGetTasks/1', function (data){
    getTasks(data);
    let pages = data.slice(-2)[0];
    for (let i=1; i<pages+1; i++){
        $('#pagination').append("<span class='paginHref' style=' padding: 5px; cursor:pointer;' rel ='"+i+"'>"+i+"</span>");
    }
}, 'json');






$(document).on('click', '.paginHref', function (e) {
    let numPage = $(this).attr('rel');
    $('.list-wrapper').empty();
    let url = 'tasks/xhrGetTasks/' + numPage + '/' + name;
    let allPages = $('#pagination').children();
    $(allPages).css('color', 'black');
    $.get(url, function (data){
        getTasks(data);

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
///Удаление таска
    $(document).on('click', '.btn-danger', function (e) {
        const post_id = $(this).attr('attr_id');
        $.post('tasks/xhrDeleteTasks', post_id, function(e){
        })

    });
///Смена статуса выполнения
    $(document).on('click', '#status', function (e) {
        const update_id = $(this).attr('attr_id');
        $.post('tasks/UpdateStatus', update_id, function(e){
        })
        location.reload();
    })
</script>
