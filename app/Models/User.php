<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'surname',
        'phone',
        'birthdate',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function is_admin()
    {
        return $this->role->name === config('constants.db.roles.admin');
    }

    public function instanceCartName()
    {
        return $this->id . '_' . $this->surname;
    }

    public function wishes()
    {
        return $this->belongsToMany(Product::class, 'wishlist', 'user_id', 'product_id');
    }

    public function addToWishList($product)
    {
        $this->wishes()->attach($product);
    }

    public function removeFromWishList($product)
    {
        $this->wishes()->detach($product);
    }

    //метод для регистрации
    public static function registerUser($data)
    {
        $role_id = Role::query()->where('name', config('constants.db.roles.costumer'))->value('id');

        $user = (new User)->fill($data);
        $user->role_id = $role_id;
        $user->password = Hash::make($data['password']);

        if ($user->save()) return $user;
        return $user->save();
    }

}
