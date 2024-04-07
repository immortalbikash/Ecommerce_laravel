<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE = 1;
    const USER_ROLE = 0;

    const USER_ACTIVE = 1;
    const USER_DEACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'email',
        'contact',
        'password',
        'gender',
        'address',
        'country',
        'profile',
        'role_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getCountry(){
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    //accessor to get first name and last name together
    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function getRoleNameAttribute(){
        return ($this->role_id == self::ADMIN_ROLE) ? 'Admin' : 'User';
    }

    public function commentData(){
        return $this->hasOne(Comment::class);
    }
}
