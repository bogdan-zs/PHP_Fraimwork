<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/PHP_Fraimwork/static/css/admin_table.css">
    <title><?=htmlentities($table)?></title>
</head>
<body>

<div class="header"><h1><a href="/PHP_Fraimwork/admin/">Admin control panel</a></h1></div>

<div class="container">
    <div class="row">
        <div class="main col">
            <h1 style="text-align: center"><?=htmlentities($table)?></h1>
            <table class="table table-hover">

                <thead>
                <tr>
                    <?php   foreach($keys as $key): ;?>
                    <th scope="col"><?=htmlentities($key)?></th>
                    <?php  endforeach;?>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php   foreach($records as $record):?>
                <tr>
                    <?php   foreach($record as $field):?>
                    <td onclick="window.location.href='<?=htmlentities($record[$keys[0]])?>/'; return false">
                        <h5><?=htmlentities($field)?></h5>
                    </td>

                    <?php  endforeach;?>
                    <td>
                        <a href="<?=htmlentities($record[$keys[0]])?>/delete/"><button type="button" class="btn btn-danger">Delete</button></a>
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