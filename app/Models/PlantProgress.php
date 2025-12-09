<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantProgress extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plant_progresses'; 
    protected $fillable = [ 'user_id', 'plant_id', 'description', 'progress_type', 'progress_date' ];
    protected $casts = [ 'progress_date' => 'date' ];

    public function user() { return $this->belongsTo(User::class); }
    public function plant() { return $this->belongsTo(Plant::class); }
}