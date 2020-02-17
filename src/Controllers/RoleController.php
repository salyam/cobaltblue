<?php

namespace Salyam\CobaltBlue\Controllers;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return view('salyam.cobaltblue.roles.index', ['roles' => \Salyam\CobaltBlue\Models\Role::all()]);
    }

    public function store()
    {
        $fields = request()->validate([
            'name' => 'required',
            'label' => 'required',
        ]);

        \Salyam\CobaltBlue\Models\Role::create($fields);

        return redirect('/roles');
    }

    // TODO: handle when not found
    public function update($id)
    {
        $fields = request()->validate([
            'name' => 'required',
            'label' => 'required',
        ]);

        $role = \Salyam\CobaltBlue\Models\Role::find($id);

        $role->name = $fields['name'];
        $role->label = $fields['label'];
        $role->save();

        return redirect('/roles');
    }

    public function destroy(\Salyam\CobaltBlue\Models\Role $role)
    {
        $role->delete();
        return redirect('/roles');
    }
}