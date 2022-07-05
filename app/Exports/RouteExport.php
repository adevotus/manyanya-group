<?php

namespace App\Exports;

use App\Models\Expense;
use App\Models\Route;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RouteExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
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

            return Route::query()->orderBy('date', 'desc')
                ->where('route', 'LIKE', '%' . $search . '%')
                ->orWhere('trip', 'LIKE', '%' . $search . '%')
                ->orWhere('mode', 'LIKE', '%' . $search . '%')
                ->orWhere('payment_method', 'LIKE', '%' . $search . '%')
                ->orWhere(function ($querys) use ($search) {
                    return  $querys->whereHas('driver', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('vehicle', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('cargo', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    });
                })
                ->whereBetween('date', array($fromdate, $toDate))->with('payment');
        } else if (!is_null($this->date) && (strlen($this->date) > 16) && (is_null($search))) {
            $fromdate = substr($this->date, 0, -14);
            $toDate =  substr($this->date, -10);

            return Route::query()->orderBy('date', 'desc')
                ->whereBetween('date',  array($fromdate, $toDate))->with('payment');
        } else if (!is_null($this->date) && (strlen($this->date) > 4 && strlen($this->date) < 16) && (!is_null($search))) {
            return Route::query()->orderBy('date', 'desc')
                ->where('route', 'LIKE', '%' . $search . '%')
                ->orWhere('trip', 'LIKE', '%' . $search . '%')
                ->orWhere('mode', 'LIKE', '%' . $search . '%')
                ->orWhere('payment_method', 'LIKE', '%' . $search . '%')
                ->orWhere(function ($querys) use ($search) {
                    return  $querys->whereHas('driver', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('vehicle', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('cargo', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })->with('payment');
                })
                ->whereDate('date', $this->date);
        } else if (!is_null($this->date) && (strlen($this->date) > 4 && strlen($this->date) < 16) && (is_null($search))) {
            return Route::query()->orderBy('date', 'desc')
                ->whereDate('date', $this->date)->with('payment');
        } else if (!is_null($search)) {
            return Route::query()->orderBy('date', 'desc')
                ->where('route', 'LIKE', '%' . $search . '%')
                ->orWhere('trip', 'LIKE', '%' . $search . '%')
                ->orWhere('mode', 'LIKE', '%' . $search . '%')
                ->orWhere('payment_method', 'LIKE', '%' . $search . '%')
                ->orWhere(function ($querys) use ($search) {
                    return  $querys->whereHas('driver', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('vehicle', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('cargo', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    });
                })->with('payment');
        } else {
            return Route::query()->orderBy('date', 'desc')->with('payment');
        }
    }


    public function headings(): array
    {
        return [
            'Departure Date',
            'Route Name',
            'Fuel',
            'Trip',
            'Driver Name',
            'Vehicle Name',
            'Item',
            'Tons',
            'Total',
            'Payment Mode',
            'Method',
            'Description',
            'Installment',
            'Driver Allowance',
            'Remaining',
            'Created Date',
        ];
    }

    public function map($route): array
    {
        return [
            $route->date, //a
            $route->route, //b
            $route->fuel, //c
            $route->trip,  //d
            $route->driver->name, //e
            $route->vehicle->name,  //f
            $route->cargo->name, //g
            $route->cargo->weight, //h
            $route->price, //i
            $route->mode,  //j
            $route->payment->last()->payment_method,  //k
            $route->payment->last()->description,  //l
            $route->payment->last()->installed,  //m
            $route->drive_allowance, //n
            $route->payment->last()->remaining,  //o
            Date::dateTimeToExcel($route->created_at),  //p
        ];
    }

    public function columnFormats(): array
    {
        return [
            'O' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'I' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'N' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'M' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
