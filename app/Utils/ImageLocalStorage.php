<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Utils;

use App\Interfaces\ImageStorage;
use Illuminate\Http\Request;

class ImageLocalStorage implements ImageStorage
{
    public function store(Request $request): string
    {
        $image = $request->file('image');

        $imageName = time().'_'.$image->getClientOriginalName();

        $image->move(public_path('images/products'), $imageName);

        return $imageName;
    }
}
