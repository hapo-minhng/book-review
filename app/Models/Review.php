<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'rating'];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    protected static function booted()
    {
        static::updated(function (Review $review) {
            return cache()->forget("book:" . $review->book_id);
        });

        static::deleted(function (Review $review) {
            return cache()->forget("book:" . $review->book_id);
        });

        static::created(function (Review $review) {
            return cache()->forget("book:" . $review->book_id);
        });
    }
}
