<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplFileObject;

class UpDownController extends Controller
{
    public function index()
    {
        return view('csvexport.index');
    }

    public function download(Request $request)
    {
        $request->validate([
            'upfile' => ['required', 'mimes:csv,txt'],
        ]);

        $path = $request->file('upfile')->getPathname();

        $file = new SplFileObject($path);
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        $download = function () use ($file) {
            $fp = fopen('php://output', 'w');

            foreach ($file as $i => $row) {
                $data = [];

                foreach ($row as $item) {
                    $data[] = $item;
                }

                fputcsv($fp, $data);
            }

            fclose($fp);
        };

        return response()->streamDownload(
            $download,
            'download.csv',
            ['Content-Type' => 'text/csv']
        );
    }
}
