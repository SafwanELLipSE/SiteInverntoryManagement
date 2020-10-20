<?php

namespace App\Exports;

use App\Stock;
use App\Stock_record;

use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class Stock_record_export implements FromCollection,WithHeadings,WithMapping,WithColumnFormatting
{
  use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        return Stock_record::where('stock_id',$this->id)->select(['stock_id', 'current_amount', 'current_quantity', 'withdraw_amount', 'withdraw_quantity',  'restock_quantity', 'status', 'created_by', 'created_at', 'updated_at'])->get();
    }
    public function headings(): array
     {
        return [
          'Product Name',
          'Current Amount',
          'Current Quantity',
          'Withdraw Amount',
          'Withdraw Quantity',
          'ReStock Quantity',
          'Status',
          'Created By',
          'Created At',
          'Updated At'
         ];
      }
   public function map($stock_record): array
   {
       return [
           $stock_record->stock->product->name,
           $stock_record->current_quantity,
           $stock_record->current_amount,
           $stock_record->withdraw_quantity,
           $stock_record->withdraw_amount,
           $stock_record->restock_quantity,
           $stock_record->status,
           Auth::user($stock_record->created_by)->name,
           Date::dateTimeToExcel($stock_record->created_at),
           Date::dateTimeToExcel($stock_record->updated_at),
       ];
   }
   public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
