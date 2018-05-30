<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/PHP_Fraimwork/static/css/admin_table.css">
    <title>{{$table}}</title>
</head>
<body>

<div class="header row"><h1 class="col-sm-6 col-md-9 col-lg-9" style="margin: 0">
        <a href="/PHP_Fraimwork/admin/" style="margin: 0 10px; line-height: 70px;">Admin
            control panel</a></h1></div>

<div class="container">
    <div class="row">
        <div class="main col">
            <h1 style="text-align: center">{{$table}}</h1>
            <table class="table table-hover">

                <thead>
                <tr>
                    {% foreach($fields as $field): %}
                    <th scope="col">{{$field["name"]}}</th>
                    {%endforeach%}
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                {% foreach($records as $record):%}
                <tr>
                    {% foreach($fields as $field=>$info):%}
                    <td onclick="window.location.href='{!$record->id!}/'; return false">
                        <h5>{{$record->get_attributes()[$field]}}</h5>
                    </td>

                    {%endforeach%}
                    <td style="text-align: right;">
                        <a href="{!$record->id!}/delete/">
                            <button type="button" class="btn btn-danger">Delete</button>
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