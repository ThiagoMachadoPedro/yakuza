<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{


          public function dashboard()
          {
                    $usersWithPostCount = User::leftJoin('posts', 'users.id', '=', 'posts.id_user')
                              ->select('users.id', 'users.name', DB::raw('MAX(posts.created_at) as last_post_date'), DB::raw('COUNT(posts.id) as post_count'))
                              ->groupBy('users.id', 'users.name')
                              ->get();

                    $usersWithPostCount->transform(function ($item) {
                              $item->last_post_date = $item->last_post_date ? new \DateTime($item->last_post_date) : null;
                              return $item;
                    });

                    return view('user.dashboard', compact('usersWithPostCount'));
          }


}
