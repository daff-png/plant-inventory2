<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'category_id', 'plant_name', 'latin_name', 'location', 
        'photo', 'barcode', 'planting_date', 'condition', 'stock', 
        'description', 'health_benefits', 'cultural_benefits', 'habitat',
    ];
    protected $casts = [ 'planting_date' => 'date' ];

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(PlantCategory::class, 'category_id'); }
    public function tips() { return $this->hasMany(PlantTip::class); }
    public function progresses() { return $this->hasMany(PlantProgress::class); }
}