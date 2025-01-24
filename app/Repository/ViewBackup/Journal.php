<?php

namespace App\Repository\ViewBackup;

use App\Repository\ViewBackup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Journal extends \App\Models\AccountJournal implements View
{
    protected $table = 'account_journals';

    public static function tableSearch($params = null): Builder
    {
        $query = $params['query'];
        $param1 = intval($params['param1']);
        $param2 = $params['param2'];

        return empty($query) ? static::query()->whereMonth('journal_date','=',$param1) :
            static::query();
    }

    public static function tableView(): array
    {
        return [
            'searchable' => true,
        ];
    }

    public static function tableField(): array
    {
        return [
            ['label' => 'Tanggal',],
            ['label' => 'Kode'],
            ['label' => 'Akun'],
            ['label' => 'Keterangan'],
            ['label' => 'Debet'],
            ['label' => 'Kredit'],
            ['label' => ''],
        ];
    }

    public static function tableData($data = null): array
    {

        $acdCode ="";
        $account ="";
        $note ="";
        $debit ="";
        $credit ="";
        foreach ($data->accountJournalDetails as $acd){
            $acdCode.= $acd->accountName->code. "<br> <br>";
            $account.= '<b>'.$acd->accountName->title. "</b><br>".$acd->accountName->accountCategory->title .'<br>';
            $note.= $acd->note. "<br><br>";
            if ($acd->debit!=0){
                $debit.= 'Rp.'.thousand_format($acd->debit) . "<br> <br>";
            }else{
                $debit.= "<br> <br>";
            }
            if ($acd->credit!=0){
                $credit.= 'Rp.'.thousand_format($acd->credit) . "<br> <br>";
            }else{
                $credit.= "<br> <br> ";
            }
        }
        $link = route('finance.journal.edit',$data->id);
        return [
            ['type' => 'string', 'data' => Carbon::parse($data->journal_date)->format('d-M-y')],
            ['type' => 'raw_html','vertical-align'=>'top', 'data' => "<div>$acdCode</div>"],
            ['type' => 'raw_html','vertical-align'=>'top', 'data' => "<div>$account</div>"],
            ['type' => 'raw_html','vertical-align'=>'top', 'data' => "<div>$note</div>"],
            ['type' => 'raw_html','vertical-align'=>'top', 'data' => "<div>$debit</div>"],
            ['type' => 'raw_html','vertical-align'=>'top', 'data' => "<div>$credit</div>"],
            ['type' => 'raw_html', 'data' => "
            <a href='$link' class='p-2 text-center'><i class='ti ti-pencil text-2xl text-wishka-500 '></i></a>
            <a href='#'><i class='ti ti-trash text-2xl text-wishka-500 p-2 text-center'></i></a>
            "],
        ];
    }
}
