<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookIssuanceDetail extends Model
{
    use HasFactory;
    
    protected $table = 'bookissuancedetails';
    protected $primaryKey = 'borrow_id';
    
    protected $fillable = [
        'member_id',
        'book_id',
        'date_borrow',
        'due_date',
    ];
    
    protected $casts = [
        'date_borrow' => 'date',
        'due_date' => 'date',
    ];
    
    /**
     * Get the member that owns the book issuance detail.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
    
    /**
     * Get the book that is issued.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
    
    /**
     * Get the book return details for the book issuance.
     */
    public function bookReturnDetails(): HasMany
    {
        return $this->hasMany(BookReturnDetail::class, 'borrow_id', 'borrow_id');
    }
}
