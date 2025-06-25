<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'book_id';
    
    protected $fillable = [
        'book_title',
        'category_id',
        'author',
        'book_copies',
        'book_pub',
        'publisher_name',
        'ISBN',
        'copyright_year',
        'date_receiver',
        'date_added',
        'status',
    ];
    
    protected $casts = [
        'copyright_year' => 'integer',
        'date_receiver' => 'date',
        'date_added' => 'date',
    ];
    
    /**
     * Get the category that owns the book.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    /**
     * Get the return details for the book.
     */
    public function bookReturnDetails(): HasMany
    {
        return $this->hasMany(BookReturnDetail::class, 'book_id', 'book_id');
    }
}
