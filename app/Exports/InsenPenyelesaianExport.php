<?php

namespace App\Exports;

use App\Models\InsAO;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class InsenPenyelesaianExport implements FromView, WithColumnFormatting
{
    protected $insen;

    public function __construct($insen)
    {
        $this->insen = $insen;
    }

    public function view(): View
    {
        return view('Page-Insentif-Penyelesaian.export-excel', ['insen' => $this->insen]);
    }

    public function columnFormats(): array
    {
        return [
            'K' => '#,##0.00',
        ];
    }
}
