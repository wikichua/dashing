<?php

namespace Wikichua\Dashing\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:access-admin-panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:read-audit')->only(['index', 'read']);
        if (false == app()->runningInConsole()) {
            \Breadcrumbs::for('home', function ($trail) {
                $trail->push('Audit Listing', route('audit'));
            });
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $models = app(config('dashing.Models.Audit'))->query()
                ->filter($request->get('filters', ''))
                ->sorting($request->get('sort', ''), $request->get('direction', ''))
                ->with(['user'])
            ;
            $paginated = $models->paginate($request->get('take', 25));
            foreach ($paginated as $model) {
                $model->actionsView = view('dashing::admin.audit.actions', compact('model'))->render();
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
        $getUrl = route('audit');
        $html = [
            ['title' => 'Created At', 'data' => 'created_at', 'sortable' => true],
            ['title' => 'User', 'data' => 'user.name', 'sortable' => true],
            ['title' => 'Model ID', 'data' => 'model_id', 'sortable' => true],
            ['title' => 'Model', 'data' => 'model_class', 'sortable' => true],
            ['title' => 'Message', 'data' => 'message'],
            ['title' => '', 'data' => 'actionsView'],
        ];

        return view('dashing::admin.audit.index', compact('html', 'getUrl'));
    }

    public function show($id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Show Audit');
        });
        $model = app(config('dashing.Models.Audit'))->query()->findOrFail($id);

        return view('dashing::admin.audit.show', compact('model'));
    }

    public function setRead($id)
    {
        $model = app(config('dashing.Models.Alert'))->query()->findOrFail($id);
        $model->update(['status' => 'r']);

        return $model->link;
    }
}
