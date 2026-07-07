<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationTimeline extends Model
{
    protected $fillable = ['application_id', 'stage', 'description', 'performed_by', 'completed_at'];

    protected $casts = ['completed_at' => 'datetime'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
