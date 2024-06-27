<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentView extends Model
{
    use HasFactory;
    
    protected $fillable = ['member_id','product_id', 'type', 'viewed_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
