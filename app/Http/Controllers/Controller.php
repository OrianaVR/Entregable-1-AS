<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function restrictToAuthenticatedUser(Builder $query): Builder
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->getRole() !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        return $query;
    }
}
