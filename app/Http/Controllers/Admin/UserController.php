<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $user = User::all();

        return view('admin.user.index', [
            'item' => $user
        ]);
    }

    public function createPage() {
        return view('admin.user.create');
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:225',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ],[
            'name.required' => 'Nama user belum diisi',
            'email.required' => 'Email belum diisi',
            'email.email' => 'Mohon masukan email yang benar',
            'email.unique' => 'Email sudah dimiliki',
            'password.required' => 'Password belum diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user-create-page')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();
            DB::commit();

            return redirect()->route('admin.user');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.user.create')->withErrors($e->getMessage());
        }
    }

    public function updatePage($id) {

        $user = User::where('id', $id)->first();

        return view('admin.user.update', compact('user'));
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:225',
            'email' => 'required|email|unique:users',
        ],[
            'name.required' => 'Nama belum diisi',
            'email.required' => 'Email belum diisi',
            'email.email' => 'Mohon masukan email yang benar',
            'email.unique' => 'Email sudah dimiliki',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.update', $id)->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // dd($user);

            DB::commit();
            return redirect()->route('admin.user');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.user-create-page')->withErrors($e->getMessage());
        }
    }

    public function delete(Request $request) {
        $user = User::findOrFail($request->id);
        $user->delete();

        return redirect()->route('admin.user');
    }
}
