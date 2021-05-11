<?php

namespace Wikichua\Dashing\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use App\Http\Controllers\Controller;

class UserPersonalAccessTokenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:access-admin-panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:create-personal-access-token')->only(['create', 'store']);
        $this->middleware('can:read-personal-access-token')->only(['index', 'read']);
        $this->middleware('can:delete-personal-access-token')->only('destroy');

        $this->middleware('reauth_admin')->only(['edit', 'destroy']);
        if (false == app()->runningInConsole()) {
            \Breadcrumbs::for('user_home', function ($trail) {
                $trail->push('User Listing', route('user'));
            });
            \Breadcrumbs::for('home', function ($trail) {
                $trail->parent('user_home');
                $trail->push('User Access Token Listing', route('pat', [request()->route()->parameter('user')]));
            });
        }
    }

    public function index(Request $request, $user_id)
    {
        if ($request->ajax()) {
            $models = app(Sanctum::$personalAccessTokenModel)->query()
                // ->checkBrand()
                ->where('tokenable_id', $user_id)
            ;
            $paginated = $models->paginate($request->get('take', 25));
            $links = $paginated->onEachSide(5)->links()->render();
            $currentUrl = $request->fullUrl();

            return compact('paginated', 'links', 'currentUrl');
        }
        $getUrl = route('pat', [$user_id]);
        $html = [
            ['title' => 'Name', 'data' => 'name', 'sortable' => true],
            ['title' => 'Token', 'data' => 'plain_text_token', 'sortable' => true],
            ['title' => 'Abilities', 'data' => 'abilities', 'sortable' => true],
            ['title' => 'Last Actived', 'data' => 'last_used_at', 'sortable' => true],
        ];
        $user = app(config('dashing.Models.User'))->query()->find($user_id);

        return view('dashing::admin.pat.index', compact('html', 'getUrl', 'user', 'user_id'));
    }

    public function create(Request $request, $user_id)
    {
        \Breadcrumbs::for('breadcrumb', function ($trail) {
            $trail->parent('home');
            $trail->push('Create User Access Token');
        });
        $user = app(config('dashing.Models.User'))->query()->find($user_id);

        return view('dashing::admin.pat.create', compact('user', 'user_id'));
    }

    public function store(Request $request, $user_id)
    {
        $user = app(config('dashing.Models.User'))->query()->find($user_id);
        $permissions = $user->roles->contains('admin', true) ? ['*'] : $user->flatPermissions()->toArray();
        $tokenResult = $user->createToken($request->input('name', 'authToken'), $permissions)->plainTextToken;
        $tokenResult = explode('|', $tokenResult);
        $model = app(Sanctum::$personalAccessTokenModel)->query()
            ->find($tokenResult[0])
        ;
        $model->plain_text_token = $tokenResult[1];
        $model->save();

        audit('Created Personal Access Token: '.$model->id, $request->input(), $model);

        return response()->json([
            'status' => 'success',
            'flash' => 'Personal Access Token Created.',
            'reload' => false,
            'relist' => false,
            'redirect' => route('pat', [$user_id]),
        ]);
    }

    public function destroy($user_id, $id)
    {
        $model = app(Sanctum::$personalAccessTokenModel)->query()->findOrFail($id);
        $model->delete();

        audit('Deleted Personal Access Token: '.$model->id, [], $model);

        return response()->json([
            'status' => 'success',
            'flash' => 'Personal Access Token Deleted.',
            'reload' => false,
            'relist' => true,
            'redirect' => false,
        ]);
    }
}
