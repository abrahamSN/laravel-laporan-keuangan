<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('name', 'ASC')->paginate(10);
        $roles = Role::all();
        return view('user.index', compact('user', 'roles'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $roles = Role::all();
        $user = User::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
        return view('user.search', compact('user', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:2',
            'email' => 'required|email|min:2',
            'password' => 'required|confirmed',
        ]);
        $tambah = new User();
        $tambah->name = $request['nama'];
        $tambah->email = $request['email'];
        $tambah->password = bcrypt($request['password']);
        $tambah->save();
        \Session::flash('message','Data telah berhasil ditambahkan.');
        return redirect()->to('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = User::find($id);
        $roles = Role::all();
        return view('user.detail',compact('show', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|min:2',
            'email' => 'required|email|min:2',
        ]);
        $update = User::where('id', $id)->first();
        $update->name = $request['nama'];
        $update->email = $request['email'];
        $update->update();
        \Session::flash('message','Data telah berhasil diubah.');
        return redirect()->to('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = User::find($id);
        $hapus->delete();
        \Session::flash('message','Data telah berhasil dihapus.');
        return redirect()->to('/user');
    }
    
    public function makeUserRole($user, $role)
    {
        $ru = new RoleUser();
        $ru->user_id = $user;
        $ru->role_id = $role;
        $ru->save();
    }

    public function deleUserRole($user, $role)
    {
        $ru = RoleUser::where([
            ['user_id', '=', $user],
            ['role_id', '=', $role]]);
        $ru->delete();
    }
}
