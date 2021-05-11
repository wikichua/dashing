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
            'name' => 'required',
            'group' => 'required',
        ]);

        $request->merge([
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            'name' => str_slug($request->input('name')),
        ]);

        $model = app(config('dashing.Models.Permission'))->create($request->all());

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

        return view('dashing::admin.permission.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $model = app(config('dashing.Models.Permission'))->query()->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'group' => 'required',
        ]);

        $request->merge([
            'updated_by' => auth()->id(),
        ]);

        $model->update($request->all());

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
        $model->delete();

        return response()->json([
            'status' => 'success',
            'flash' => 'Permission Deleted.',
            'reload' => false,
            'relist' => true,
            'redirect' => false,
        ]);
    }
}
