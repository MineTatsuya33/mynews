<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\History;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
     public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
      unset($form['_token']);
      $profile->fill($form);
      $profile->save();
      return redirect('admin/profile/create');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update()
    {
        $history = new History;
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
        return redirect('admin/profile/edit');
    }
}
