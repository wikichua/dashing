<?php

namespace Wikichua\Dashing\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:access-admin-panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:create-users')->only(['create', 'store']);
        $this->middleware('can:read-users')->only(['index', 'read']);
        $this->middleware('can:update-users')->only(['edit', 'update']);
        $this->middleware('can:update-users-password')->only(['editPassword', 'updatePassword']);
        $this->middleware('can:delete-users')->only('destroy');

        $this->middleware('reauth_admin')->only(['edit', 'destroy', 'editPassword']);
        if (false == app()->runningInConsole()) {
            \Breadcrumbs::for('home', function ($trail) {
                $trail->push('User Listing', route('user'));
            });
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $models = app(config('dashing.Models.User'))->query()
                ->where('id', '!=', 1)
                ->checkBrand()
                ->filter($request->get('filters', ''))
                ->sorting($request->get('sort', ''), $request->get('direction', '')) // be treated as default sorting rules
                ->with('roles')
            ;
            $paginated = $models->paginate($request->get('take', 25));
            foreach ($paginated as $model) {
                $model->actionsView = view('dashing::admin.user.actions', compact('model'))->render();
                $model->brand_name = $model->brand->name ?? '';
            }
            if ('' != $request->get('filters', '')) {
                $paginated->appends(['filters' => $request->get('filters', '')]);
            }
            if ('' != $request->get('sort', '')) {
                $paginated->appends(['sort' => $request->get('sort', ''), 'direction' => $request->get('direction', 'asc')]);
            }
            $links = $paginated->onEachSide(5)->links()->render();
            $currentUrl = $request->fullUrl();

            return compact('paginated', 'links', 'currentUrl');
        }
        $getUrl = route('user');
        $html = [
            ['title' => 'Name', 'data' => 'name', 'sortable' => true],
            ['title' => 'Email', 'data' => 'email', 'sortable' => true],
            ['title' => 'Type', 'data' => 'type', 'sortable' => true],
            ['title' => 'Brand', 'data' => 'brand_name', 'sortable' => false],
            ['title' => 'Timezone', 'data' => 'timezone', 'sortable' => true],
            ['title' => 'Roles', 'data' => 'roles_string'],
            ['title' => '', 'data' => 'actionsView'],
        ];

        return view('dashing::admin.user.index', compact('html', 'getUrl'));
    }

    public function create(Request $request)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Create User');
        });
        $roles = app(config('dashing.Models.Role'))->pluck('name', 'id')->sortBy('name');

        return view('dashing::admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
            'timezone' => 'required',
            'password_confirmation' => 'required',
            'password' => ['required', 'confirmed'],
        ]);

        $request->merge([
            'password' => bcrypt($request->get('password')),
            'roles' => array_values($request->get('roles', [])),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        $model = app(config('dashing.Models.User'))->create($request->input());
        $model->roles()->sync($request->get('roles'));

        sendAlert([
            'brand_id' => $request->input('brand_id', 0),
            'link' => null,
            'message' => 'New User Added. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-users', $request->input('brand_id', 0)),
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'User Created.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('user'),
        ]);
    }

    public function show($id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Show User');
        });
        $model = app(config('dashing.Models.User'))->query()->findOrFail($id);
        $last_activity = $model->audit()->first();
        $model->last_activity = [
            'datetime' => $last_activity->created_at ?? '',
            'message' => $last_activity->message ?? '',
            'iplocation' => $last_activity->iplocation ?? '',
        ];

        return view('dashing::admin.user.show', compact('model'));
    }

    public function edit(Request $request, $id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Edit User');
        });
        $model = app(config('dashing.Models.User'))->query()->findOrFail($id);
        $last_activity = $model->audit()->first();
        $model->last_activity = [
            'datetime' => $last_activity->created_at ?? '',
            'message' => $last_activity->message ?? '',
            'iplocation' => $last_activity->iplocation ?? '',
        ];
        $roles = app(config('dashing.Models.Role'))->pluck('name', 'id')->sortBy('name');

        return view('dashing::admin.user.edit', compact('roles', 'model'));
    }

    public function update(Request $request, $id)
    {
        $model = app(config('dashing.Models.User'))->query()->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'timezone' => 'required',
            'type' => 'required',
        ]);

        $request->merge([
            'roles' => array_values($request->get('roles', [])),
            'updated_by' => auth()->id(),
        ]);

        $model->update($request->input());
        $model->roles()->sync($request->get('roles'));

        sendAlert([
            'brand_id' => $request->input('brand_id', 0),
            'link' => null,
            'message' => 'User Updated. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-users', $request->input('brand_id', 0)),
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'User Updated.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('user.edit', [$model->id]),
        ]);
    }

    public function editPassword(Request $request, $id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Edit User Password');
        });
        $model = app(config('dashing.Models.User'))->query()->findOrFail($id);
        $last_activity = $model->audit()->first();
        $model->last_activity = [
            'datetime' => $last_activity->created_at ?? '',
            'message' => $last_activity->message ?? '',
            'iplocation' => $last_activity->iplocation ?? '',
        ];
        return view('dashing::admin.user.editPassword', compact('id', 'model'));
    }

    public function updatePassword(Request $request, $id)
    {
        $model = app(config('dashing.Models.User'))->query()->findOrFail($id);
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $request->merge([
            'password' => bcrypt($request->get('password')),
            'updated_by' => auth()->id(),
        ]);

        $model->update($request->all());

        return response()->json([
            'status' => 'success',
            'flash' => 'User Password Updated.',
            'reload' => true,
            'relist' => false,
            'redirect' => false,
        ]);
    }

    public function destroy($id)
    {
        $model = app(config('dashing.Models.User'))->query()->findOrFail($id);
        $model->roles()->sync([]);
        sendAlert([
            'brand_id' => $request->input('brand_id', 0),
            'link' => null,
            'message' => 'User Deleted. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-users', $request->input('brand_id', 0)),
            'icon' => $model->menu_icon,
        ]);
        $model->delete();

        return response()->json([
            'status' => 'success',
            'flash' => 'User Deleted.',
            'reload' => false,
            'relist' => true,
            'redirect' => false,
        ]);
    }
}
