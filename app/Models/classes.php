<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    use HasFactory;
    protected $table = "classes";

    public function sections()
    {
        return $this->belongsToMany(sections::class, 'classes_sections_mapping', 'class_id', 'section_id');
    }
    public function classSectionMapping()
    {
        return $this->hasMany(classesSectionsMapping::class, 'class_id', 'id');
    }
}
