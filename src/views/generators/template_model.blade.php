{{ '<?php' }}
class {{ $classname }} extends Eloquent{
    protected $table = '{{ $tablename }}';
    protected $fillable = array(
        '{{ implode("','", $fillables) }}'
    );
}

