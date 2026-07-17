<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    protected $fillable = [
        'application_id', 'name', 'type', 'file_path', 'original_name',
        'file_size', 'status', 'remarks', 'uploaded_by',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getUrlAttribute()
    {
        return storageFile($this->file_path);
    }
}
