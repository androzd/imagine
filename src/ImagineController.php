<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 3/29/16
 * Time: 9:28 PM
 */

namespace Androzd\Imagine;

use App\Http\Controllers\Controller;

class ImagineController extends Controller
{

    public function index($rule, $file)
    {
        $config = config('imagine.rules.'.$rule, false);
        if (!$config) {
            throw new \Exception(sprintf('Imagine rule "%s" not exists', $rule));
        }
        $route = public_path(substr(route('cache.imagine', func_get_args(), false), 1));
        if (\File::exists($route)) {
            return \Image::make(public_path($route))->response();
        }
        if (!\File::exists($dir = \File::dirname($route))) {
            \File::makeDirectory($dir, 0777, true);
        }
        $image = \Image::make(public_path($file));
        $imagine = new ImagineProcess($image);
        $imagine->call($config);

        return $image->save($route)->response();
    }

}