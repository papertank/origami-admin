<?php

namespace Origami\Admin\Http\Controllers;

class Dashboard extends AdminController {

    public function __invoke()
    {
        return view('admin.dashboard.index');
    }

}
