<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['hasAnyPermission']);
        $this->middleware(['can:read user'])->only(['index','usersTable']);
        $this->middleware(['can:create user'])->only(['store']);
        $this->middleware(['can:edit user'])->only(['update','edit']);
        $this->middleware(['can:delete user'])->only(['destroy']);
    }

    public function index()
    {
            session()->flash('done', 'تم اضافة البيانات بنجاح');
        return view('dashboard.users.index');
    }

    public function create()
    {
        return view('dashboard.users.create')->with(['roles'=>Role::where('name' , '!=', 'Super Admin')->pluck('name', 'id')]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator)
        {
            $user = User::create([
               'name'=>$request->name,
               'email'=>$request->email,
               'password'=>bcrypt($request->password),
            ]);

            if ($request->has('role'))
            {
               $user->assignRole($request->role);
            }
        }
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        if ($user->id != 1)
        {
            return view('dashboard.users.edit')->with(['user'=>$user, 'roles'=>Role::where('name' , '!=', 'Super Admin')->pluck('name', 'id')]);
        }
        return redirect()->back();
    }

    public function update(Request $request, User $user)
    {
        $validator = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles($request->role);
        if ($request->has('password') && $request->password != '')
        {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return view('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.users.index');
    }

    public function usersTable()
    {
        return DataTables::eloquent(User::query()->where('id', '>', 1))
            ->addColumn('role', function($user) {
                return  $user->getRoleNames()->first();
            })
            ->addColumn('action', function($user) {
                $action = '<a class="link-icon-edit" href="'. route("dashboard.users.edit", $user->id) .'"><i class="fe fe-edit"></i></a>';
                $action .= '<a class="link-icon-delete" data-target="#modaldemo'.$user->id.'" data-toggle="modal" href="#"><i class="las la-trash-alt"></i></a>';
                $action .= '  <div class="modal" id="modaldemo'.$user->id.'">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content tx-size-sm">
                                                <div class="modal-body tx-center pd-y-20 pd-x-20">
                                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                                                    <h4 class="tx-danger mg-b-20">'.__('dashboard.are-you-sure-to-delete-this') .'</h4>
                                                    <p class="mg-b-20 mg-x-20">'.__('dashboard.you-can-not-restore-it-again').'</p>
                                                    <a aria-label="Close" onclick="event.preventDefault(); document.getElementById('.'\'delete-form-'.$user->id.'\').submit();"  class="btn ripple btn-danger pd-x-25" data-dismiss="modal" type="button">'.__('dashboard.yes').'</a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="delete-form-'.$user->id.'" action="'.route('dashboard.users.destroy', $user->id).'" method="POST">'
                    . '<input type="text" name="_token" value="'. csrf_token() .'" />'.'
                                            <input type="text" name="_method" value="DELETE" />
                                        </form>
                                    </div>';
                return $action;


            })
            ->addIndexColumn()
            ->toJson();
    }

    public function profile()
    {
        $user = auth()->user();
        return view('dashboard.profile.index', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validator = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != '')
        {
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('mainImg')){
            $user->clearMediaCollection('avatar');
            $name = rand(1000000,15000000);
            $img = Image::make($request->file('mainImg'))->resize(128,128);
            $img = $img->save($name.'.jpg');
            $user->addMedia(public_path($name.'.jpg'))->toMediaCollection('avatar');
        }
        $user->save();
        return redirect()->back()->with('success', 'Your record has been updated successfully');
    }
}
