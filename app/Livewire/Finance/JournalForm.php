<?php

namespace App\Livewire\Finance;

use App\Models\AccountJournal;
use App\Models\AccountJournalDetail;
use App\Models\AccountName;
use Carbon\Carbon;
use Livewire\Component;

class JournalForm extends Component
{
    public $optionAccountNames;

    public $number = 1;

    public $date;

    public $journalTemplate = [
        'account_name_id' => null, 'debit' => 0, 'credit' => 0, 'note' => '',
    ];

    public $journal = [
        ['account_name_id' => null, 'debit' => 0, 'credit' => 0, 'note' => ''],
    ];

    public function getRules()
    {
        return [
            'date' => 'required',
        ];
    }

    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->optionAccountNames = [];
        foreach (AccountName::get() as $an) {
            $this->optionAccountNames[] = [
                'value' => $an->id, 'title' => "$an->code - $an->title",
            ];
        }
        $this->dispatch('select2dispatch');
    }

    public function setNumber()
    {
        $this->dispatch('select2dispatch');
        $this->journal[] = $this->journalTemplate;
    }

    public function create()
    {
        $this->validate();
        $ac = AccountJournal::create([
            'user_id' => auth()->id(),
            'journal_date' => $this->date,
        ]);
        foreach ($this->journal as $item) {
            if (isset($item['account_name_id'][0]) ) {
                if ($item['account_name_id'][0] != null) {
                    AccountJournalDetail::create([
                        'account_journal_id' => $ac->id,
                        'account_name_id' => $item['account_name_id'][0],
                        'debit' => $item['debit'],
                        'credit' => $item['credit'],
                        'note' => $item['note'],
                    ]);
                }
            }
        }
        $this->redirect(route('finance.journal'));

    }

    public function render()
    {
        return view('livewire.finance.journal-form');
    }
}
