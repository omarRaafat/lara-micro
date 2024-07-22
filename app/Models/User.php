<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\test;
use Filament\Panel;
use Webpatser\Uuid\Uuid;
use App\Casts\UserActiveCast;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Models\Contracts\FilamentUser;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable implements HasMedia , Searchable , FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles , InteractsWithMedia;

    // protected $touches = ['roles'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',

    // ];
    protected $guarded = [];
    protected $perPage = 10;

    public const VERSION = '1.0';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'name' => test::class,
        'active' => UserActiveCast::class,
    ];

    // protected $connection = 'laramicro';

    public function cacheRolesAndPermissions()
    {
        $this->roles = Cache::rememberForever($this->cacheKey(), function () {
            return $this->roles->flatMap->permissions;
        });

      
    }


    public function invalidateCache()
    {
        Cache::forget($this->cacheKey());
        // Cache::forget($this->cacheKey() . '-permissions');
    }


    public function cacheKey()
    {
        return 'user-' . $this->id . '-' . $this->email;
    }


    // protected static function booted(){
    //     static::addGlobalScope('active' , function(Builder $builder){
    //         $builder->whereActive(1);
    //     });
    // }

    
    public function scopeActive(Builder $query){
        return $query->whereActive(1);
    }
   

    protected function data(): Attribute{
        return Attribute::make(
            get: fn($value)=> json_decode($value , true),
            set: fn($value)=> json_encode($value)
        );
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image');
    }

    public function getTotalActiveUsersAttribute(){
        return User::whereActive(1)->count();
    }


    public function posts(){
        return $this->hasMany(Post::class , 'user_id' , 'id');
    }

    public function items(){
        return $this->belongsToMany(Item::class , 'users_items' , 'user_id' , 'item_id');
    }


    public function maxViewsPost(){
        return $this->hasOne(Post::class , 'user_id' , 'id')->ofMany('views' , 'max');

    }


    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email && $this->hasVerifiedEmail();
    }
   

   
}
