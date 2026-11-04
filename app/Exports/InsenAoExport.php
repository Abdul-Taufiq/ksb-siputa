<?php

namespace App\Exports;

use App\Models\MasterInsentif\InsAO;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

class InsenAoExport implements FromView, WithColumnFormatting
{
    protected $insen;

    public function __construct($insen)
    {
        $this->insen = $insen;
    }

    public function view(): View
    {
        return view('Page-Insentif-AO.export-excel', ['insen' => $this->insen]);
    }

    public function columnFormats(): array
    {
        return [
            'K' => '#,##0.00',
        ];
    }
}
