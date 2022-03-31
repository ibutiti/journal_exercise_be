<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;
    protected $title = 'title';
    protected $content = 'content';
    protected $public_id = 'public_id';
    protected $user_id = 'user_id';

    protected $fillable = [
        'title',
        'content',
        'public_id',
        'user_id'
    ];
    // protected $hidden = [
    //     'user_id',
    // ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
