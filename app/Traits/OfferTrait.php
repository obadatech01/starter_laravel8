<?php

namespace App\Traits;

Trait OfferTrait {
    function saveImage($photo, $folder) {
        // save photo in folder
        $file_extinsion = $photo->getClientOriginalExtension();
        $file_name = time().'.'.$file_extinsion;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }
}

?>
