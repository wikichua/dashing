<?php

namespace Wikichua\Dashing\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:access-admin-panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:create-settings')->only(['create', 'store']);
        $this->middleware('can:read-settings')->only(['index', 'read']);
        $this->middleware('can:update-settings')->only(['edit', 'update']);
        $this->middleware('can:delete-settings')->only('destroy');

        $this->middleware('reauth_admin')->only(['edit', 'destroy']);
        if (false == app()->runningInConsole()) {
            \Breadcrumbs::for('home', function ($trail) {
                $trail->push('Setting Listing', route('setting'));
            });
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $models = app(config('dashing.Models.Setting'))->query()
                ->checkBrand()
                ->filter($request->get('filters', ''))
                ->sorting($request->get('sort', ''), $request->get('direction', ''))
            ;
            $paginated = $models->paginate($request->get('take', 25));
            foreach ($paginated as $model) {
                $model->actionsView = view('dashing::admin.setting.actions', compact('model'))->render();
                $model->valueString = is_array($model->value) ? implode('<br>', $model->value) : $model->value;
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
        $getUrl = route('setting');
        $html = [
            ['title' => 'Key', 'data' => 'key', 'sortable' => true],
            ['title' => 'Value', 'data' => 'valueString', 'sortable' => true],
            ['title' => '', 'data' => 'actionsView'],
        ];

        return view('dashing::admin.setting.index', compact('html', 'getUrl'));
    }

    public function create(Request $request)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Create Setting');
        });

        return view('dashing::admin.setting.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
        ]);

        if (true == $request->get('multipleTypes', false)) {
            $request->merge(['value' => array_combine($request->get('keys', []), $request->get('values', []))]);
        }

        if (false == $request->has('protected')) {
            $request->merge(['protected' => 0]);
        }

        $model = app(config('dashing.Models.Setting'))->create($request->all());

        cache()->forget('setting-'.$model->key);

        sendAlert([
            'brand_id' => 0,
            'link' => null,
            'message' => 'New Setting Added. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-settings'),
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'Setting Created.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('setting'),
        ]);
    }

    public function show($id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Show Setting');
        });
        $model = app(config('dashing.Models.Setting'))->query()->findOrFail($id);

        return view('dashing::admin.setting.show', compact('model'));
    }

    public function edit(Request $request, $id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Edit Setting');
        });
        $model = app(config('dashing.Models.Setting'))->query()->findOrFail($id);

        return view('dashing::admin.setting.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => 'required',
        ]);

        $model = app(config('dashing.Models.Setting'))->query()->findOrFail($id);

        if (true == $request->get('multipleTypes', false)) {
            $request->merge(['value' => array_combine($request->get('keys', []), $request->get('values', []))]);
        }

        if (false == $request->has('protected')) {
            $request->merge(['protected' => 0]);
        }

        $model->update($request->all());

        cache()->forget('setting-'.$model->key);

        sendAlert([
            'brand_id' => 0,
            'link' => null,
            'message' => 'Setting Updated. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-settings'),
            'icon' => $model->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'flash' => 'Setting Updated.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('setting.edit', [$model->id]),
        ]);
    }

    public function destroy($id)
    {
        $model = app(config('dashing.Models.Setting'))->query()->findOrFail($id);
        sendAlert([
            'brand_id' => 0,
            'link' => null,
            'message' => 'Setting Deleted. ('.$model->name.')',
            'sender_id' => auth()->id(),
            'receiver_id' => permissionUserIds('read-settings'),
            'icon' => $model->menu_icon,
        ]);
        $model->delete();

        return response()->json([
            'status' => 'success',
            'flash' => 'Setting Deleted.',
            'reload' => false,
            'relist' => true,
            'redirect' => false,
        ]);
    }
}
