<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'member_id';
    
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'address',
        'contact',
        'type',
        'year_level',
        'status',
    ];
    
    /**
     * Get the book issuance details for the member.
     */
    public function bookIssuanceDetails(): HasMany
    {
        return $this->hasMany(BookIssuanceDetail::class, 'member_id', 'member_id');
    }
}
