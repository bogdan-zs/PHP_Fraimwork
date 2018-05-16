<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/PHP_Fraimwork/static/css/admin_table.css">
    <title><?=htmlentities($table)?></title>
</head>
<body>

<div class="header row">
    <h1 class="col-sm-6 col-md-9 col-lg-9" style="margin: 0"><a href="/PHP_Fraimwork/admin/"
                                                                style="margin: 0 10px; line-height: 70px;">
            Admin control panel</a>
    </h1></div>

<div class="container">
    <div class="row">
        <div class="main col edit">
            <form action="" method="POST">
                <?php  foreach($record as $name=>$field):?>
                <div class="row">
                    <label class="col-md-3"><?=htmlentities($name)?>:</label>
                    <!--                    <div class="col-md-3"><?=htmlentities($name)?></div>-->
                    <div class="col-md-9">
                        <?php  if($record_types[$field]=='"text"'):?>
                        <?="<textarea type='text' name='$name'
                                     rows='10' cols='40' class='form-control'>$field</textarea>"?>
                        <?php  else:?>
                        <?="<input type=$record_types[$field] value='$field' name='$name'
                                  rows='10' cols='40' class='form-control'>"?>
                        <?php  endif;?>
                    </div>
                </div>
                <hr>
                <?php  endforeach;?>
                <div class="col" style="padding: 0">
                    <button type="submit" class="enter btn btn-primary btn-lg">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>