<?php
/**
 * Created by PhpStorm.
 * User: sn
 * Date: 20/07/17
 * Time: 1:38
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'user_id','role_id'
    ];
    public $timestamps = false;
}