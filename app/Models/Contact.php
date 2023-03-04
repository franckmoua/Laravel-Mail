<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMail;

class Contact extends Model

{
    use HasFactory;

    public $fillable = ['message','token','email'];

    public static function boot() {
        parent::boot();
        static::created(function ($item) {

            Mail::to("franckmoua@gmail.com")->send(new ContactMail($item));

        });
    }
}