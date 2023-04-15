<?php
namespace App\Traits;

use Exception;

trait FileHandling
{
    function upload($file,$path,$specialName = "") {
        try
        {
            $fileFinalName = $specialName != "" ? $specialName."_" : "";
            if ($file != "") {
                $fileFinalName .= pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) ."_". time() . rand(1111,
                        9999) . '.' . $file->getClientOriginalExtension();
                        $file->move($path, $fileFinalName);
                return $path."/".$fileFinalName;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}
