<?php

namespace App\Http\Controllers;

use App\Permission;
use App\PermissionRole;
use App\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $perms = Permission::orderBy('display_name', 'ASC')->paginate(10);
        return view('permission.index', compact('perms', 'roles'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $roles = Role::all();
        $perms = Permission::where('display_name', 'LIKE', '%' . $query . '%')->paginate(10);
        return view('permission.search', compact('perms', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.tambah');
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
            'name' => 'required|min:3',
            'display_name' => 'required|min:3',
            'description' => 'required|min:3',
        ]);
        $tambah = new Permission();
        $tambah->name = $request['name'];
        $tambah->display_name = $request['display_name'];
        $tambah->description = $request['description'];
        $tambah->save();
        \Session::flash('message','Data telah berhasil ditambahkan.');
        return redirect()->to('/permission');
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
        $show = Permission::find($id);
        return view('permission.detail',compact('show'));
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
            'name' => 'required|min:3',
            'display_name' => 'required|min:3',
            'description' => 'required|min:3',
        ]);
        $update = Permission::find($id);
        $update->name = $request['name'];
        $update->display_name = $request['display_name'];
        $update->description = $request['description'];
        $update->update();
        \Session::flash('message','Data telah berhasil diubah.');
        return redirect()->to('/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Permission::find($id);
        $hapus->delete();
        \Session::flash('message','Data telah berhasil dihapus.');
        return redirect()->to('/permission');
    }

    public function makePermiRole($perm, $role)
    {
        $pr = new PermissionRole();
        $pr->permission_id = $perm;
        $pr->role_id = $role;
        $pr->save();
    }

    public function delePermiRole($perm, $role)
    {
        $pr = PermissionRole::where([
            ['permission_id', '=', $perm],
            ['role_id', '=', $role]]);
        $pr->delete();
    }
}
