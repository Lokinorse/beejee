<?php 

?><div class="containter">
    <div class="col-xl-5  mx-auto  form p-4">
    <div class="text-right mb-3">
            <a href="/" class="btn btn-dark">Main</a>
        </div>
        <h3>Please log in.</h3>
        <form method='POST' action = 'admin/login'>
            <div class="form-group">
                <input type="text" name = 'login' class="form-control" id="login" aria-describedby="emailHelp"
                    placeholder="Enter login">
            </div>
            <div class="form-group">
                <input type="password" name = 'password' class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>