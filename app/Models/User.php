<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

//實做implements JWTSubject 的驗證方式
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    //取得JWT變識字串
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    //回傳鍵值陣列,內容包括被加入JWT的自定義Payload
    public function getJWTCustomClaims()
    {
        return [];
    }

    //WT SECRET 是什麼？ 要部署jwt需要下php artisan jwt:secret

    //JWT (JSON Web Token) SECRET 是一個字串，用來加密和解密 JWT，確保 JWT 的安全性。
    //在使用 JWT 簽署和驗證時，需要提供 SECRET 以保證 JWT 的正確性和完整性。
    //SECRET 通常是一個長度適當且具有隨機性的字串，可以是任何內容，只要保證在簽署和驗證 
    //JWT 時使用相同的 SECRET 即可。請注意，SECRET 必須保密，不應公開或在不安全的地方儲存。
}
