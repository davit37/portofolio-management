<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use Carbon\Carbon;
use DB;
class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','getData']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(){
        return view("role.index");
    }

    public function getData(Request $req){
        $query = Role::all();

        return DataTables::of($query)
                ->editColumn("id",function($query){
                    $edit = "<a class='btn-approve text-primary' onclick='editRole($query->id)' href='#' role='button' style='font-size:25px'><i class='mdi mdi-eyedropper-variant'></i></a>";
                    $permission = "<a class='btn-approve text-primary' onclick='permission($query->id)' href='#' role='button' style='font-size:25px'><i class='mdi mdi-key'></i></a>";
                   
                    return $edit.$permission;
                })
                ->rawColumns(['id', 'action'])
                ->addIndexColumn()
                ->toJson();
    }
}
