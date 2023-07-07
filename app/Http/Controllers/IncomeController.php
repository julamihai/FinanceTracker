<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Incomes;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IncomeController extends Controller
{
    //crud for income model
    public function index()
    {
        $categories = auth()->user()->categories->where('type',Category::TYPE_INCOME);
        $incomes = Incomes::where('user_id', auth()->user()->id)->get();
        return view('income.index')->with([
            'incomes' => $incomes,
            'categories' => $categories,
        ]);
    }

    public function store(IncomeRequest $request)
    {
        if (is_numeric($request->amount)){
        $income = new Incomes();
        $income->name = $request->name;
        $income->amount = $request->amount;
        $income->user_id = auth()->user()->id;
        $income->category_id = $request->category_id;
        $income->save();

        return redirect()->route('income.index')->with('success', 'Income added successfully');
        }
        else{
            return redirect()->route('income.index')->with('error', 'Amount must be a number!');
        }
    }

    public function update(IncomeRequest $request, Incomes $income)
    {
        if(is_numeric($request->amount)){

            $income->name = $request->name;
            $income->amount = $request->amount;
            $income->user_id = auth()->user()->id;
            $income->category_id = $request->category_id;
            $income->save();

            return redirect()->route('income.index')->with('success', 'Income updated successfully');

        }else{
            return \redirect()->route('income.index')->with('error', 'Amount must be a number!');
        }
    }

    public function destroy(Incomes $income)
    {;
        $income->delete();

        return redirect()->route('income.index')->with('success', 'Income deleted successfully');
    }

}
