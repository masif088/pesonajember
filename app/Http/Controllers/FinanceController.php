<?php

namespace App\Http\Controllers;

class FinanceController extends Controller
{
    public function journal()
    {
        return view('admin.finance.journal');
    }

    public function journalCreate()
    {
        return view('admin.finance.journal-create');
    }

    public function journalEdit($id)
    {

    }

    public function accountNames()
    {
        return view('admin.finance.account-names');
    }

    public function accountNamesCreate()
    {
        return view('admin.finance.account-names-create');
    }

    public function accountNamesEdit($id)
    {
        return view('admin.finance.account-names-edit', compact('id'));
    }

    public function ledger()
    {
        return view('admin.finance.ledger');
    }

    public function balanceSheet()
    {
        return view('admin.finance.balance-sheet');
    }

    public function worksheet()
    {
        return view('admin.finance.worksheet');
    }

    public function calcBalance()
    {
        return view('admin.finance.calc-balance');
    }

    public function profitAndLoss()
    {
        return view('admin.finance.profit-and-loss');
    }

    public function calcProfitAndLoss()
    {
        return view('admin.finance.calc-profit-and-loss');
    }

    public function accountOpeningBalance()
    {
        return view('admin.account-opening-balance.index');
    }

    public function accountOpeningBalanceCreate()
    {
        return view('admin.account-opening-balance.create');
    }

    public function accountOpeningBalanceEdit($id)
    {
        return view('admin.account-opening-balance.edit', compact('id'));
    }

    public function bigCash()
    {
        return view('admin.big-cash.index');
    }

    public function bigCashCreate()
    {
        return view('admin.big-cash.create');
    }

    public function bigCashEdit($id)
    {
        return view('admin.big-cash.index', compact('id'));
    }

    public function pettyCash()
    {
        return view('admin.petty-cash.index');
    }

    public function pettyCashCreate()
    {
        return view('admin.petty-cash.create');
    }

    public function pettyCashEdit($id)
    {
        return view('admin.petty-cash.index', compact('id'));
    }
}
