<?php

namespace XRA\Backend\Controllers\Admin;

use App\Http\Controllers\Controller;

class MenufullController extends Controller
{
    public function delete()
    {
        $this->rrdir(base_path('packages/Enteweb'));
        $output = '_menufull.xml cancellati con successo!';
        return view('Backend::admin.index')->with('output', $output)->with('id_dashboard', 1);
    }

    public function rrdir($start_folder)
    {
        if (is_dir($start_folder)) {
            $objects = scandir($start_folder);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($start_folder . "/" . $object)) {
                        $this->rrdir($start_folder . "/" . $object);
                    } elseif ($object == '_menufull.xml') {
                        unlink($start_folder . "/" . $object);
                    }
                }
            }
        }
    }
}
