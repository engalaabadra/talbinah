<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        $availableLanguages = Config::get('languages');
        if (array_key_exists($lang, $availableLanguages)) {
            Storage::put('applocale', $lang);
            app()->setLocale($lang);
            return customResponse(200, localLang());
        }
    
        return customResponse(400, trans('messages.invalid_language')); // Return an error response if the language is not valid
    }
 
    public function defaultLang(){
        return customResponse(200, localLang());
    }
    
    public function getAllLangs(){
        $getAllLangs=Config::get('languages');
        return customResponse(200, $getAllLangs);
     }
   
}
    