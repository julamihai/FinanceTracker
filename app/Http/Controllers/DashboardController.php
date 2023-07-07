<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Expenses;
use App\Models\Incomes;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    //return a view with all the data needed for the dashboard
    public function index()
    {
        //get the incomes in an array sorted by month
        $incomes = Incomes::where('user_id', auth()->user()->id)->get();
        $incomesByMonth = [];
        $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        foreach ($months as $month){
            $incomesByMonth[$month] = 0;
        }
        foreach ($incomes as $income){
            $month = date('m', strtotime($income->created_at));
            $incomesByMonth[$month] += $income->amount;
        }

        //get the expenses in an array sorted by month
        $expenses = Expenses::where('user_id', auth()->user()->id)->get();
        $expensesByMonth = [];
        foreach ($months as $month){
            $expensesByMonth[$month] = 0;
        }
        foreach ($expenses as $expense){
            $month = date('m', strtotime($expense->created_at));
            $expensesByMonth[$month] += $expense->amount;
        }

        //get the income categories
        $incomeCategories = auth()->user()->categories->where('type',Category::TYPE_INCOME);

        // get the income by category

        $incomeByCategory = [];
        foreach ($incomeCategories as $category){
            $incomeByCategory[$category->name] = 0;
        }
        foreach ($incomes as $income){
            $incomeByCategory[$income->category->name] += $income->amount;
        }

        //get the expense categories

        $expenseCategories = auth()->user()->categories->where('type',Category::TYPE_EXPENSE);

        //get the expense by category

        $expenseByCategory = [];
        foreach ($expenseCategories as $category){
            $expenseByCategory[$category->name] = 0;
        }
        foreach ($expenses as $expense){
            $expenseByCategory[$expense->category->name] += $expense->amount;
        }
        //return the view with the data
        return view('dashboard')->with([
            'incomesByMonth' => $incomesByMonth,
            'expensesByMonth' => $expensesByMonth,
            'incomeCategories' => $incomeCategories,
            'incomeByCategory' => $incomeByCategory,
            'expenseCategories' => $expenseCategories,
            'expenseByCategory' => $expenseByCategory,
        ]);
    }
}
