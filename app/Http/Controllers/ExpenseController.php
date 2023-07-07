<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Http\Requests\IncomeRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Incomes;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
    //crud for expense model

    public function index()
    {
        $categories = auth()->user()->categories->where('type',Category::TYPE_EXPENSE);
        $expenses = \App\Models\Expenses::where('user_id', auth()->user()->id)->get();
        return view('expense.index')->with([
            'expenses' => $expenses,
            'categories' => $categories,
        ]);
    }

    public function store(IncomeRequest $request)
    {
        if (is_numeric($request->amount)){
        $expense = new \App\Models\Expenses();
        $expense->name = $request->name;
        $expense->amount = $request->amount;
        $expense->user_id = auth()->user()->id;
        $expense->category_id = $request->category_id;
        $expense->save();

        return redirect()->route('expense.index')->with('success', 'Expense added successfully');
        }
        else{
            return redirect()->route('expense.index')->with('error', 'Amount must be a number!');
        }
    }

    public function update(ExpenseRequest $request, \App\Models\Expenses $expense)
    {
        if(is_numeric($request->amount)){

            $expense->name = $request->name;
            $expense->amount = $request->amount;
            $expense->user_id = auth()->user()->id;
            $expense->category_id = $request->category_id;
            $expense->save();

            return redirect()->route('expense.index')->with('success', 'Expense updated successfully');

        }else{
            return \redirect()->route('expense.index')->with('error', 'Amount must be a number!');
        }
    }

    public function destroy(\App\Models\Expenses $expense)
    {
        $expense->delete();
        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully');
    }
}
