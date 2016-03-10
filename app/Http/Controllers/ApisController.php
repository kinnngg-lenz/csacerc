<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApisController extends Controller
{
    public function inspire()
    {
        $quote = Quote::quote();
        /*$quote = ['quote' => $quote];*/
        $view = '<span class="inspire text-'. ["warning", "success", "info", "danger", "yellow", "pink", "green", "violet", "muted"][array_rand([0,1,2,3,4,5,6,7,8])].'"><span class="text-lg">&#8220;</span> '.$quote.' <span class="text-lg">&#8221;</span></span>';
        return($view);
    }

    public function inspireAPI()
    {
        $inspire = Quote::quote();
        $data = [
            'inspire' => $inspire
        ];
        return $data;
    }

   public function didyouknow()
   {
       $urls = ['http://numbersapi.com/random/','http://numbersapi.com/random/year/','http://numbersapi.com/random/date'];

       try
       {
           $didyouknow = file_get_contents($urls[array_rand($urls)]);
       }
       catch(\Exception $e)
       {
           $didyouknow = "This website is hosted on a VPS with 1GB of RAM and is developed using PHP as backend, MySQL & Redis for database storage, and Sockets for real time events.";
       }

       return $didyouknow;
   }

    /**
     * @return string
     */
    public function didyouknowAPI()
    {

        $urls = ['http://numbersapi.com/random/','http://numbersapi.com/random/year/','http://numbersapi.com/random/date'];
        try
        {
            $didyouknow = file_get_contents($urls[array_rand($urls)]);
        }
        catch(\Exception $e)
        {
            $didyouknow = "This website is hosted on a VPS with 1GB of RAM and is developed using PHP as backend, MySQL & Redis for database storage, and Sockets for real time events.";
        }

        $data = [
            'didyouknow' => $didyouknow
        ];
        return $data;
    }
}