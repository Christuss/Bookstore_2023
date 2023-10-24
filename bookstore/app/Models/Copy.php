<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;

    protected $primaryKey = 'copy_id';
    protected $fillable = [
        'publications',
        'book_id',
        'status',
        'hardcovered'
    ];

    public function copy() {
        return $this->hasMany(Copy::class, 'copy_id', 'copy_id');
    }

}
