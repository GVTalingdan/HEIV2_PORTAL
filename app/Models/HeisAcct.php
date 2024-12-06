<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Import the Authenticatable class
use Illuminate\Notifications\Notifiable;

class HeisAcct extends Authenticatable
{
    public function getAuthIdentifierName()
    {
        return 'hei_username'; // Use the column name that holds the unique username
    }
    public function getAuthPassword()
    {
        return $this->hei_password;
    }

    use Notifiable;

    protected $table = 'tbl_heis_acct';

    protected $fillable = [
        'hei_username',
        'hei_password',
        'hei_name',
    ];
}
