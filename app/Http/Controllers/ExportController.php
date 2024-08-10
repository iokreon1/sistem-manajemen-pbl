<?php

namespace App\Http\Controllers;

use App\Exports\RekapNilaiExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $data = json_decode($request->input('data'), true);

        $export = new RekapNilaiExport($data);
        return $export->export();
    }
}

