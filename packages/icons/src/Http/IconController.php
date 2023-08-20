<?php

namespace Akrbdk\Icons\Http;

use Akrbdk\Icons\Models\Icon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Spatie\Ray\Request;

class IconController extends Controller
{
    public function index(){

    }

    public function show(){

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $icon = Icon::create([
            'title' => 'titleee',
            'icon' => 'iconnn',
            'description' => 'descriptionnn',
        ]);

        return redirect(route('icons.show', $icon));
    }
}
