<?php

namespace Origami\Admin\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class AdminController extends Controller {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
