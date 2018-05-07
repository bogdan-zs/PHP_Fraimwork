<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/PHP_Fraimwork/static/css/admin_table.css">
    <title>{{$table}}</title>
</head>
<body>

<div class="header"><h1><a href="/PHP_Fraimwork/admin/">Admin control panel</a></h1></div>

<div class="container">
    <div class="row">
        <div class="main col edit">
            <form action="" method="POST">
                {%foreach($labels_types as $label=>$type):%}
                <div class="row">
                    <label class="col-md-3">{{$label}}:</label>
<!--                    <div class="col-md-3">{{$name}}</div>-->
                    <div class="col-md-9">
                        {%if($type=='"text"'):%}
                        {!"<textarea type='text' name='$label'
                                     rows='10' cols='40' class='form-control'></textarea>"!}
                        {%else:%}
                        {!"<input type=$type  name='$label'
                                 rows='10' cols='40' class='form-control'>"!}
                        {%endif%}
                    </div>
                </div>
                <hr>
                {%endforeach%}
                <div class="col" style="padding: 0">
                    <button type="submit" class="enter btn btn-primary btn-lg" >Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>