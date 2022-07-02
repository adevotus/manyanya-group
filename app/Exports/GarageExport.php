<?php

namespace App\Exports;

use App\Models\Garage;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GarageExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    public function __construct($search, $date)
    {
        $this->search = $search;
        $this->date = $date;
    }

    public function query()
    {
        $search = $this->search;

        if (!is_null($this->date) && (strlen($this->date) > 16) && (!is_null($search))) {
            $fromdate = substr($this->date, 0, -14);
            $toDate =  substr($this->date, -10);

            return Garage::query()->orderBy('created_at', 'desc')
                ->where('tool_name', 'LIKE', '%' . $search . '%')
                ->orWhere('condition', $search)
                ->whereBetween('created_at',  array($fromdate, $toDate));
        } else if (!is_null($this->date) && (strlen($this->date) > 16) && (is_null($search))) {
            $fromdate = substr($this->date, 0, -14);
            $toDate =  substr($this->date, -10);

            return Garage::query()->orderBy('created_at', 'desc')
                ->whereBetween('created_at',  array($fromdate, $toDate));
        } else if (!is_null($this->date) && (strlen($this->date) > 4 && strlen($this->date) < 16) && (!is_null($search))) {
            return Garage::query()->orderBy('created_at', 'desc')
                ->where('tool_name', 'LIKE', '%' . $search . '%')
                ->orWhere('condition', $search)
                ->whereDate('created_at', $this->date);
        } else if (!is_null($this->date) && (strlen($this->date) > 4 && strlen($this->date) < 16) && (is_null($search))) {
            return Garage::query()->orderBy('created_at', 'desc')
                ->whereDate('created_at', $this->date);
        } else if (!is_null($search)) {
            return Garage::query()->orderBy('created_at', 'desc')
                ->where('tool_name', 'LIKE', '%' . $search . '%')
                ->orWhere('condition', $search);
        } else {
            return Garage::query();
        }
    }


    public function headings(): array
    {
        return [
            'Tool Name',
            'Tool Number',
            'Tool Price',
            'Tool Condition',
            'Created Date',
        ];
    }

    public function map($Garage): array
    {
        return [
            $Garage->tool_name,
            $Garage->tool_no,
            $Garage->amount,
            $Garage->condition,
            Date::dateTimeToExcel($Garage->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
