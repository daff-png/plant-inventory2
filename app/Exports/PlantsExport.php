<?php
namespace App\Exports;

use App\Models\Plant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlantsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Plant::with(['user', 'category'])->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nama Tanaman', 'Nama Latin', 'Kategori', 'Lokasi',
            'Tgl Tanam', 'Kondisi', 'Stok', 'Dicatat Oleh',
        ];
    }

    public function map($plant): array
    {
        return [
            $plant->id,
            $plant->plant_name,
            $plant->latin_name,
            $plant->category ? $plant->category->category_name : 'N/A',
            $plant->location,
            $plant->planting_date ? $plant->planting_date->format('d-m-Y') : 'N/A',
            $plant->condition,
            $plant->stock,
            $plant->user ? $plant->user->name : 'N/A',
        ];
    }
}