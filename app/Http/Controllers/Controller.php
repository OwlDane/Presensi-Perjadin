<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use Authorizable, ValidatesRequests;
}
