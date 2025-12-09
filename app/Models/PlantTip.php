<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantTip extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'plant_id', 'watering_tips', 'lighting_tips', 'soil_media' ];
    public function plant() { return $this->belongsTo(Plant::class); }
}