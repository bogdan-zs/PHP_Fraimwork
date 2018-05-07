<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/PHP_Fraimwork/static/css/admin_table.css">
    <title>Admin control panel</title>
</head>
<body>

<div class="header"><h1><a href="/PHP_Fraimwork/admin/">Admin control panel</a></h1></div>

<div class="container">
    <div class="row">
<!--        <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 main">-->
            <div class="main col">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Table</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php   foreach($tables as $table):?>
                <tr>
                    <td onclick="window.location.href='<?=htmlentities($table)?>/'; return false"><h3><?=htmlentities($table)?></h3></td>
                    <td class="commands">
                        <a href="<?=htmlentities($table)?>/add/"> <button type="button" class="btn btn-success">Add</button></a>
                    </td>
                </tr>
                <?php  endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>