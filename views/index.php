<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<style>
.currentPage{
    color:red;
}
</style>
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
<script type="text/javascript">
function statusFunc (datastatus, status){
        if(datastatus==0){
            status = "<span style='cursor:pointer';  class='badge badge-secondary'>Not done yet...";
        } else {
            status ="<span style='cursor:pointer'; class='badge badge-success'>Done!";
        }
        return status;
}
function isUpdated(datastatus, statusUpdated){
    if(datastatus == 0 ){
        statusUpdated = ''
    } else {
        statusUpdated = '</br><span class="text-muted float-right">edited by Admin</span>';
    }
    return statusUpdated
}
function getTasks(data){
    for (let i=0; i<data.length-2; i++){
        let status;
        let statusUpdated;
        $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" 
        + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" 
        + data[i].email + "</h6><p class='card-text'>" 
        + data[i].task + "</p></br></br><span attr_id='" + data[i].id + "'"
        + statusFunc(data[i].status, status)+"</span>"
        + isUpdated(data[i].updated, statusUpdated)+"</div></div>");
    }
    $( document ).ready(function() {
        let curPage =     $('#pagination').children()[data[data.length - 1]];
        $(curPage).css('color', 'red');
    });
}



/// СОРТИРОВКА
let name=null;
$('select').change(function(){
    $('.list-wrapper').empty();
    name = this.value;
    let url = 'tasks/xhrGetTasks/1/' + name;
    $.get(url, function (data){
    for (let i=0; i<data.length-2; i++){
    $('.list-wrapper').append( "<div class='card mt-3' style='width: 100%;'><div class='card-body'><h5 class='card-title'>" 
    + data[i].name + "</h5><h6 class='card-subtitle mb-2 text-muted'>" 
    + data[i].email + "</h6><p class='card-text'>" 
    + data[i].task + "</p>"+statusFunc(data[i].status, status) +"</div></div>");
    }
}, 'json');
})  

//Первый рендер
$.get('tasks/xhrGetTasks/1', function (data){
    getTasks(data);
    let pages = data.slice(-2)[0];
    for (let i=1; i<pages+1; i++){
        $('#pagination').append("<span class='paginHref' style=' padding: 5px; cursor:pointer;' rel ='"+i+"'>"+i+"</span>");
    }

    $( document ).ready(function() {
        let curPage =     $('#pagination').children()[data[data.length - 1]];
        $(curPage).css('color', 'red');
    });
}, 'json');

//Переход по страницам
$(document).on('click', '.paginHref', function (e) {
    console.log(name);
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
</script>
