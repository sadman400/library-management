<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookReturnDetail extends Model
{
    use HasFactory;
    
    protected $table = 'bookreturndetails';
    protected $primaryKey = 'borrow_detail_id';
    
    protected $fillable = [
        'book_id',
        'borrow_id',
        'borrow_status',
        'date_return',
    ];
    
    protected $casts = [
        'date_return' => 'date',
    ];
    
    /**
     * Get the book that is being returned.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
    
    /**
     * Get the book issuance detail that owns the book return detail.
     */
    public function bookIssuanceDetail(): BelongsTo
    {
        return $this->belongsTo(BookIssuanceDetail::class, 'borrow_id', 'borrow_id');
    }
}
