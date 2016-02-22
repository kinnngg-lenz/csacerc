<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;

class ApisController extends Controller
{
    public function inspire()
    {
        $quote = Inspiring::quote();
        /*$quote = ['quote' => $quote];*/
        $view = '<span class="inspire text-'. ["warning", "success", "info", "danger", "yellow", "pink", "green", "violet", "muted"][array_rand([0,1,2,3,4,5,6,7,8])].'"><span class="text-lg">&#8220;</span> '.$quote.' <span class="text-lg">&#8221;</span></span>';
        return($view);
    }
}
