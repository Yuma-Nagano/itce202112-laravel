<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Task extends Model
{
    use HasFactory;
    use Sortable;
    protected $fillable = ['name', 'deadline', 'is_completed'];
    public $sortable = ['deadline', 'created_at'];
}
