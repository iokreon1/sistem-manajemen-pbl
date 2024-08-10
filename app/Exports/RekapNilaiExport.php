<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapNilaiExport
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headings
        $headings = ['No', 'NIM', 'Nama Mahasiswa', 'Nilai Harian Pengampu', 'Nilai Harian PM', 'UTS', 'UAS', 'Nilai Akhir'];
        $sheet->fromArray($headings, NULL, 'A1');

        // Add data
        $sheet->fromArray($this->data, NULL, 'A2');

        $writer = new Xlsx($spreadsheet);
        $fileName = 'rekap_nilai.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
