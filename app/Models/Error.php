<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    protected $fillable = [
        'message',
        'short_message',
    ];

    public function withShortMessage(string $shortMessage = ''): Error
    {
        $this->shortMessage = $shortMessage;
        return $this;
    }

    public function withMessage(string $message = ''): Error
    {
        $this->message = $message;
        return $this;
    }
}
