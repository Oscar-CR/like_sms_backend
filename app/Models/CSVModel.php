<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSVModel extends Model
{
    use HasFactory;

    public $table = 'csv';

    protected $fillable = [
        'name',
        'created_by'
    ];

    public function csvData()
    {
        return $this->hasMany(CSVDataModel::class, 'csv_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
