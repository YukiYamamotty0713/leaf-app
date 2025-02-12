<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DailyActivity extends Model
{
    use HasFactory;

    protected $table = 'daily_activity';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'activity',
    ];

    protected $casts = [
        'activity' => 'string',
    ];


    public function getCreatedOnAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }
}