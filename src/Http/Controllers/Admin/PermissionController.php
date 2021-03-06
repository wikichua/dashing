<?php

namespace Wikichua\Dashing\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:access-admin-panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:create-permissions')->only(['create', 'store']);
        $this->middleware('can:read-permissions')->only(['index', 'read']);
        $this->middleware('can:update-permissions')->only(['edit', 'update']);
        $this->middleware('can:delete-permissions')->only('destroy');

        $this->middleware('reauth_admin')->only(['edit', 'destroy']);
        if (false == app()->runningInConsole()) {
            \Breadcrumbs::for('home', function ($trail) {
                $trail->push('Permission Listing', route('permission'));
            });
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $models = app(config('dashing.Models.Permission'))->query()
                ->checkBrand()
                ->select([
                    'group',
                    \DB::raw('min(`id`) as id'),
                    \DB::raw('GROUP_CONCAT(" ",`name`) as "name"'),
                ])->groupby('group')
                ->filter($request->get('filters', ''))
                ->sorting($request->get('sort', ''), $request->get('direction', ''))
            ;
            $paginated = $models->paginate($request->get('take', 25));
            foreach ($paginated as $model) {
                $model->actionsView = view('dashing::admin.permission.actions', compact('model'))->render();
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
        $getUrl = route('permission');
        $html = [
            ['title' => 'Group', 'data' => 'group', 'sortable' => true],
            ['title' => 'Name', 'data' => 'name', 'sortable' => true],
            ['title' => '', 'data' => 'actionsView'],
        ];

        return view('dashing::admin.permission.index', compact('html', 'getUrl'));
    }

    public function create(Request $request)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Create Permission');
        });

        return view('dashing::admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'at_least:1',
                'all_filled'
            ],
            'group' => 'required',
        ]);
        foreach ($request->input('name') as $value) {
            $request->merge([
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
                'name' => str_slug($value),
            ]);
            $model = app(config('dashing.Models.Permission'))->create($request->all());
        }

        sendAlert([
            'brand_id' => 0,
            'link' => $model->readUrl,
            'message' => 'New Permission Added. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => 0,
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'Permission Created.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('permission'),
        ]);
    }

    public function show($id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Show Permission');
        });
        $model = app(config('dashing.Models.Permission'))->query()->findOrFail($id);

        return view('dashing::admin.permission.show', compact('model'));
    }

    public function edit(Request $request, $id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Edit Permission');
        });
        $model = app(config('dashing.Models.Permission'))->query()->findOrFail($id);
        $permissions = app(config('dashing.Models.Permission'))->query()->where('group', $model->group)->pluck('name', 'id');
        return view('dashing::admin.permission.edit', compact('model', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                'at_least:1',
                'all_filled'
            ],
            'group' => 'required',
        ]);
        $model = app(config('dashing.Models.Permission'))->find($id);
        $permissions = app(config('dashing.Models.Permission'))->where('group', $model->group)->pluck('name')->toArray();
        $group = $request->input('group');
        $input_permissions = collect($request->input('name'))->toArray();
        // delete
        $deleted_permissions = array_diff($permissions, $input_permissions);
        app(config('dashing.Models.Permission'))->where('group', $model->group)->whereIn('name', $deleted_permissions)->delete();
        // new
        $new_permissions = array_diff($input_permissions, $permissions);
        foreach ($new_permissions as $permission) {
            app(config('dashing.Models.Permission'))->create([
                'group' => $group,
                'name' => str_slug(strtolower($permission)),
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        }
        // update
        $update_permissions = array_diff($input_permissions, array_merge($deleted_permissions, $new_permissions));
        foreach ($update_permissions as $permission) {
            app(config('dashing.Models.Permission'))->update([
                'group' => $group,
                'name' => str_slug(strtolower($permission)),
                'updated_by' => auth()->id(),
            ]);
        }

        sendAlert([
            'brand_id' => 0,
            'link' => $model->readUrl,
            'message' => 'Permission Updated. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => 0,
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'Permission Updated.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('permission.edit', [$model->id]),
        ]);
    }

    public function destroy($id)
    {
        $model = app(config('dashing.Models.Permission'))->query()->findOrFail($id);
        sendAlert([
            'brand_id' => 0,
            'link' => null,
            'message' => 'Permission Deleted. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => 0,
            'icon' => $model->menu_icon,
        ]);
        app(config('dashing.Models.Permission'))->where('group', $model->group)->delete();

        return response()->json([
            'status' => 'success',
            'flash' => 'Permission Deleted.',
            'reload' => false,
            'relist' => true,
            'redirect' => false,
        ]);
    }
}
