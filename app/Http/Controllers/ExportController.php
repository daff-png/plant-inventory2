<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PlantsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportPlants()
    {
        return Excel::download(new PlantsExport, 'daftar_tanaman.xlsx');
    }
}