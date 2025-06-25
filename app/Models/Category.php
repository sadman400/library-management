<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'category_id';
    
    protected $fillable = [
        'classname',
    ];
    
    /**
     * Get the books for the category.
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_id', 'category_id');
    }
}
