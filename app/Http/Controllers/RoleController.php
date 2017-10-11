<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        return view('role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.tambah');
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
        $tambah = new Role();
        $tambah->name = $request['name'];
        $tambah->display_name = $request['display_name'];
        $tambah->description = $request['description'];
        $tambah->save();
        \Session::flash('message','Data telah berhasil ditambah.');
        return redirect()->to('/role');
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
        $show = Role::find($id);
        return view('role.detail',compact('show'));
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
        $update = Role::find($id);
        $update->name = $request['name'];
        $update->display_name = $request['display_name'];
        $update->description = $request['description'];
        $update->update();
        \Session::flash('message','Data telah berhasil diubah.');
        return redirect()->to('/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id); // Pull back a given role

        // Regular Delete
        $role->delete(); // This will work no matter what

        // Force Delete
        //$role->users()->sync([]); // Delete relationship data
        //$role->perms()->sync([]); // Delete relationship data

        //$role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
       \Session::flash('message','Data telah berhasil dihapus.');
        return redirect()->to('/role');
    }
}
