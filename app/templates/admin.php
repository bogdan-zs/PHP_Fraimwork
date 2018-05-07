<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/PHP_Fraimwork/static/css/admin.css">
    <meta charset="utf-8">
    <title>Вхід в адміністративну частину сайта</title>
</head>
<body>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="form col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
            <div class="tab-content" >
                    <h3>Admin</h3>
                    <form role="Form" method="POST" action="" accept-charset="UTF-8">
                        <div class="form-group">
                            <input type="text" name="login" placeholder="Login..." class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password..." class="form-control">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="remember"> Remember me
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class=" enter btn btn-primary btn-lg">Enter</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>


