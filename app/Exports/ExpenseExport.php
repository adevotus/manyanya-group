<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExpenseExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
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

            return Expense::query()->orderBy('created_at', 'desc')
                ->where('description', 'LIKE', '%' . $search . '%')
                ->orWhere(function ($query) use ($search) {
                    return $query->whereHas('user', function ($querys) use ($search) {
                        return $querys->where('name', 'LIKE', '%' . $search . '%');
                    });
                })
                ->whereBetween('created_at',  array($fromdate, $toDate));
        } else if (!is_null($this->date) && (strlen($this->date) > 16) && (is_null($search))) {
            $fromdate = substr($this->date, 0, -14);
            $toDate =  substr($this->date, -10);

            return Expense::query()->orderBy('created_at', 'desc')
                ->whereBetween('created_at',  array($fromdate, $toDate));
        } else if (!is_null($this->date) && (strlen($this->date) > 4 && strlen($this->date) < 16) && (!is_null($search))) {
            return Expense::query()->orderBy('created_at', 'desc')
                ->where('description', 'LIKE', '%' . $search . '%')
                ->orWhere(function ($query) use ($search) {
                    return $query->whereHas('user', function ($querys) use ($search) {
                        return $querys->where('name', 'LIKE', '%' . $search . '%');
                    });
                })
                ->whereDate('created_at', $this->date);
        } else if (!is_null($this->date) && (strlen($this->date) > 4 && strlen($this->date) < 16) && (is_null($search))) {
            return Expense::query()->orderBy('created_at', 'desc')
                ->whereDate('created_at', $this->date);
        } else if (!is_null($search)) {
            return Expense::query()->orderBy('created_at', 'desc')
                ->where('description', 'LIKE', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    return $query->where('name', 'LIKE', '%' . $search . '%');
                });
        } else {
            return Expense::query();
        }
    }


    public function headings(): array
    {
        return [
            'Description',
            'Amount',
            'Created By',
            'Created Date',
        ];
    }

    public function map($expense): array
    {
        return [
            $expense->description,
            $expense->amount,
            $expense->user->name,
            Date::dateTimeToExcel($expense->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
