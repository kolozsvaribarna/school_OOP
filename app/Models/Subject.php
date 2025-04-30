<?php

namespace App\Models;

class Subject extends Model
{
    public ?string $subject_name = null;
    protected static $table = 'subjects';

    public function __construct(?string $name = null)
    {
        parent::__construct();
        if ($name != null) {
            $this->subject_name = $name;
        }
    }
}
/* creating a new subject:
$subject = new Subject("Honvédelmi alapismeretek");
$subject->create();
*/