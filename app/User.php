<?php namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_users', 'id', 'book_id');
    }

    public function scopeTransactionBorrow($query)
    {
        return $query->join('book_users', 'users.id', '=', 'book_users.user_id')
            ->join('books', 'books.id', '=', 'book_users.book_id')
            ->select(
                'books.title',
                'users.name',
                'book_users.created_at',
                'book_users.updated_at',
                'book_users.status',
                'book_users.id',
                'book_users.book_id'
            )
            ->whereNotIn('status', ['pesan']);
    }

    public function scopeOrder($query)
    {

        return $query->join('book_users', 'users.id', '=', 'book_users.user_id')
            ->join('books', 'books.id', '=', 'book_users.book_id')
            ->select(
                'books.title',
                'users.name',
                'book_users.created_at',
                'book_users.updated_at',
                'book_users.status',
                'book_users.id'
            )
            ->where('status', 'pesan')
            ->where('book_users.created_at', '>=', Carbon::now()->toDateString().' 00:00:00')
            ->where('book_users.created_at', '<=', Carbon::now());

    }

}
