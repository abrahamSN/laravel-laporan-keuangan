<?php
/**
 * Created by PhpStorm.
 * User: sn
 * Date: 20/07/17
 * Time: 2:03
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id','role_id'
    ];
    public $timestamps = false;
}
