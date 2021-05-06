<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation () {
        return User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(2);
        // return $user->phone;
        // return response()->json($user);
    }
}
