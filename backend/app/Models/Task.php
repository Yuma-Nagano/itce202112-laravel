<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Task extends Model
{
    use HasFactory;
    use Sortable;
    protected $fillable = ['name', 'deadline_date_time', 'is_completed'];
    public $sortable = ['deadline_date_time', 'created_at'];
}
