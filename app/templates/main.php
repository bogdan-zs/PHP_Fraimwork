{% foreach ($arr as $value):%}
    {{$value->name}}  {{$value->id}}<hr>
{% endforeach %}