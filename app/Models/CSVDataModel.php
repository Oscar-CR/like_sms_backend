<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSVDataModel extends Model
{
    use HasFactory;

    public $table = 'csv_data';

    protected $fillable = [
        'phone',
        'message',
        'status',
        'csv_id',
    ];

    public function csv()
    {
        return $this->belongsTo(CSVModel::class, 'csv_id');
    }
}
