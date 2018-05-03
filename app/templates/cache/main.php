<?php foreach ($arr as $value):?>
    <?=htmlentities($value->name)?>  <?=htmlentities($value->id)?><hr>
<?php endforeach ;?>