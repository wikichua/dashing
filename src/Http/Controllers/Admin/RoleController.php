<?php

namespace Wikichua\Dashing\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:access-admin-panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:create-roles')->only(['create', 'store']);
        $this->middleware('can:read-roles')->only(['index', 'read']);
        $this->middleware('can:update-roles')->only(['edit', 'update']);
        $this->middleware('can:delete-roles')->only('destroy');

        $this->middleware('reauth_admin')->only(['edit', 'destroy']);
        if (false == app()->runningInConsole()) {
            \Breadcrumbs::for('home', function ($trail) {
                $trail->push('Role Listing', route('role'));
            });
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $models = app(config('dashing.Models.Role'))->query()
                ->checkBrand()
                ->filter($request->get('filters', ''))
                ->sorting($request->get('sort', ''), $request->get('direction', ''))
            ;
            $paginated = $models->paginate($request->get('take', 25));
            foreach ($paginated as $model) {
                $model->actionsView = view('dashing::admin.role.actions', compact('model'))->render();
                $permissions = $model->permissions()->pluck('name')->toArray();
                $model->permissionsView = view('dashing::admin.role.permissionList', compact('permissions'))->render();
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
        $getUrl = route('role');
        $html = [
            ['title' => 'Name', 'data' => 'name', 'sortable' => true],
            ['title' => 'Is Admin', 'data' => 'isAdmin'],
            ['title' => 'Permissions', 'data' => 'permissionsView'],
            ['title' => '', 'data' => 'actionsView'],
        ];

        return view('dashing::admin.role.index', compact('html', 'getUrl'));
    }

    public function create(Request $request)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Create Role');
        });
        $permissions = app(config('dashing.Models.Permission'))->select(['id', 'name', 'group'])->get()->groupBy('group');
        $group_permissions = [];
        foreach ($permissions as $group => $perms) {
            foreach ($perms as $perm) {
                $group_permissions[$group][$perm->id] = $perm->name;
            }
        }

        return view('dashing::admin.role.create', compact('group_permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'admin' => 'required',
            'permissions' => 'required',
        ]);

        $request->merge([
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            'permissions' => array_values($request->get('permissions', [])),
        ]);

        $model = app(config('dashing.Models.Role'))->create($request->all());
        $model->permissions()->sync($request->get('permissions'));

        sendAlert([
            'brand_id' => 0,
            'link' => $model->readUrl,
            'message' => 'New Role Added. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-roles'),
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'Role Created.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('role'),
        ]);
    }

    public function show($id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Show Role');
        });
        $model = app(config('dashing.Models.Role'))->query()->findOrFail($id);

        return view('dashing::admin.role.show', compact('model'));
    }

    public function edit(Request $request, $id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Edit Role');
        });
        $model = app(config('dashing.Models.Role'))->query()->findOrFail($id);
        $permissions = app(config('dashing.Models.Permission'))->select(['id', 'name', 'group'])->get()->groupBy('group');
        $group_permissions = [];
        foreach ($permissions as $group => $perms) {
            foreach ($perms as $perm) {
                $group_permissions[$group][$perm->id] = $perm->name;
            }
        }
        $selected_permissions = $model->permissions->pluck('id')->toArray();
        return view('dashing::admin.role.edit', compact('model', 'group_permissions', 'selected_permissions'));
    }

    public function update(Request $request, $id)
    {
        $model = app(config('dashing.Models.Role'))->query()->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'admin' => 'required',
        ]);

        $request->merge([
            'updated_by' => auth()->id(),
            'permissions' => array_values($request->get('permissions', [])),
        ]);

        $model->update($request->all());
        $model->permissions()->sync($request->get('permissions'));

        sendAlert([
            'brand_id' => 0,
            'link' => $model->readUrl,
            'message' => 'Role Updated. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-roles'),
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'Role Updated.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('role.edit', [$model->id]),
        ]);
    }

    public function destroy($id)
    {
        $model = app(config('dashing.Models.Role'))->query()->findOrFail($id);
        $model->permissions()->sync([]);
        sendAlert([
            'brand_id' => 0,
            'link' => null,
            'message' => 'New Role Deleted. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-roles'),
            'icon' => $model->menu_icon,
        ]);
        $model->delete();

        return response()->json([
            'status' => 'success',
            'flash' => 'Role Deleted.',
            'reload' => false,
            'relist' => true,
            'redirect' => false,
        ]);
    }
}
