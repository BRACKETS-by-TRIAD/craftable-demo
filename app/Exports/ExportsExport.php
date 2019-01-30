<?php namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Export;

class ExportsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Export::all();
    }

    public function headings(): array
    {
        return [
            trans('admin.export.columns.id'),
            trans('admin.export.columns.title'),
            trans('admin.export.columns.perex'),
            trans('admin.export.columns.published_at'),
            trans('admin.export.columns.enabled'),
        ];
    }

    /**
     * @param Export $export
     * @return array
     *
     */
    public function map($export): array
    {
        return [
            $export->id,
            $export->title,
            $export->perex,
            $export->published_at,
            $export->enabled,
        ];
    }
}
