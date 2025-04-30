<?php

namespace App\Models;

class ClassModel extends Model
{
    public ?string $class_name = null;
    public ?int $year = null;
    protected static $table = 'classes';

    public function __construct(?string $class_name = null, ?int $year = null)
    {
        parent::__construct();
        if ($class_name != null) {
            $this->class_name = $class_name;
        }
        if ($year != null) {
            $this->year = $year;
        }
    }
}