<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/PHP_Fraimwork/static/css/admin_table.css">
    <title>Admin control panel</title>
</head>
<body>

<div class="header row">
    <h1 class="col-sm-6 col-md-9 col-lg-9" style="margin: 0"><a href="/PHP_Fraimwork/admin/" style="margin: 0 10px; line-height: 70px;">7777Admin control panel</a></h1>
    <div class="col-sm-6 col-md-3 col-lg-3" style="display: inline-block; text-align: center;">
        <a href="?q=exit"><button class="exit btn btn-secondary" style="margin: 30px 0; padding: 5px 20px;
    background-color: #75ADC8;">
           Exit
        </button></a>
    </div>
</div>

<div class="container">

    <div class="row">
        <!--        <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 main">-->
        <div class="main col">
            <a href="exit/">exit</a>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Table</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                {% foreach($tables as $table):%}
                <tr>
                    <td onclick="window.location.href='{{$table}}/'; return false"><h3>{{$table}}</h3></td>
                    <td class="commands">
                        <a href="{{$table}}/add/">
                            <button type="button" class="btn btn-success">Add</button>
                        </a>
                    </td>
                </tr>
                {%endforeach%}
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>