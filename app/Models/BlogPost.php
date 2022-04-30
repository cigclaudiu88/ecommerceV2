<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul brands accesibile
    protected $guarded = [];

    // legatura dintre tabelul blog_post (category_id) si tabelul blog_post_categories (id)
    public function category()
    {
        return $this->belongsTo(BlogPostCategory::class, 'category_id', 'id');
    }
}