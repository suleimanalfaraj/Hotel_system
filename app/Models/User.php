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

    protected $table = 'users';  // تحديد اسم الجدول هنا
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type', 
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


    // دالة للتحقق ��ذا كان المستخدم مشرف (admin)
    public function isAdmin()
    {
        return $this->user_type === 'admin'; // تحقق إذا كان user_type هو admin
    }

    // // في نموذج User
    //     public function isAdmin()
    //     {
    //         return $this->role === 'admin'; // مثال: إذا كان لديك حقل 'role' في جدول المستخدمين
    //     }


    // // دالة للتحقق إذا كان المستخدم عادي (مستخدم)
    // public function isUser()
    // {
    //     return $this->user_type === 'user'; // تحقق إذا كان user_type هو user
    // }
}
