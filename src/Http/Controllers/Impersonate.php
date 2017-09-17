<?php

namespace Origami\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Lab404\Impersonate\Services\ImpersonateManager;

class Impersonate extends AdminController
{
    /**
     * @var ImpersonateManager
     */
    protected $manager;

    /**
     * ImpersonateController constructor.
     *
     * @param \Lab404\Impersonate\Services\ImpersonateManager $manager
     */
    public function __construct(ImpersonateManager $manager)
    {
        $this->manager = $manager;
    }

    public function take(Request $request)
    {
        if ( ! $request->user('admin') ) {
            abort(403);
        }

        $admin = $request->user('admin');

        $user = $this->getUser($request);

        if ( ! $user ) {
            abort(404);
        }

        // Cannot impersonate yourself
        if ($user->is($admin)) {
            abort(403);
        }

        if ($this->manager->isImpersonating()) {
            abort(403);
        }

        if (!$admin->canImpersonate()) {
            abort(403);
        }

        if ($user->canBeImpersonated()) {
            if ($this->manager->take($admin, $user)) {
                return redirect()->to('');
            }
        }

        return redirect()->back();
    }

    /*
     * @return RedirectResponse
     */
    public function leave()
    {
        if (!$this->manager->isImpersonating()) {
            abort(403);
        }

        $this->manager->leave();

        return admin_redirect('');
    }

    protected function getUser(Request $request)
    {
        $id = $request->input('user');

        if ( ! $id ) {
            return false;
        }

        $model = config('auth.providers.users.model');

        return call_user_func([
            $model,
            'findOrFail'
        ], $id);
    }

}
