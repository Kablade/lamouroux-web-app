<?php
namespace App\Providers;

use App\Models\User as User;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as Authenticatable;
use Illuminate\Contracts\Auth\User as UserContract;

class CustomUserProvider implements UserProvider
{
    protected $model;

    public function __construct(Authenticatable $model)
    {
      $this->model = $model;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \App\Models\Account|null
     */
    public function retrieveById($identifier)
    {
        return User::find($identifier);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed   $identifier
     * @param  string  $token
     * @return \App\Models\Account|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return User::where('id = ? and remember_token = ?', $identifier, $token)->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \App\Models\User $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->remember_token = $token;
        $user->save();
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \App\Models\Account|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        return User::where('username', '=', $credentials['username'])->first();
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \App\Models\User $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $hashedPassword = $this->hashPassword($credentials['username'], $credentials['password']);
        return $user->password == $hashedPassword;
    }

    public function hashPassword($username, $password)
    {
        return self::hash($password);
    }

    /**
     * Hash he password
     * @param  string $username username
     * @param  string $password password not encrypted
     * @return string           hashed password
     */
    public static function hash($password)
    {
        return sha1($password);
    }
}
