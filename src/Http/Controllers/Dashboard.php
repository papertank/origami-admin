<?php

namespace Origami\Admin\Http\Controllers;

class Dashboard extends AdminController {

    public function index()
    {
        return view('admin.dashboard.index');
    }

}
