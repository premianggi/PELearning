<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datalkpd extends Model
{
    use HasFactory;

    protected $table = 'datalkpd';
    protected $fillable =[
                            'assignment_name',
                            'description',
                            'add_file',
                        ];
}
