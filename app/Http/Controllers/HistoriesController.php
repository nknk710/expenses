<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\History;
use App\Models\Category;

class HistoriesController extends Controller
{
    public function home()
    {
        $categories = Category::pluck('category');
        return view('home', ['categories' => $categories]);
    }
    
    public function month_index(Request $request)
    {
        $id = Auth::id();
        $year = $request->year;
        $month = $request->month;
        $categories = Category::pluck('category');
        $record = History::where('user_id', $id);
        if ($request->sort) {
            if ($request->sort == 'desc') {
                $sort = $request->sort;
                $records = $record->whereYear('date', $year)
                           ->whereMonth('date', $month)
                           ->orderBy('date', 'desc')
                           ->get();
            } else {
                $sort = $request->sort;
                $records = $record->whereYear('date', $year)
                           ->whereMonth('date', $month)
                           ->orderBy('date', 'asc')
                           ->get();
            } 
        } else {
            $sort = 'asc';
            $records = $record->whereYear('date', $year)
                           ->whereMonth('date', $month)
                           ->orderBy('date', 'asc')
                           ->get();
        }

        for ($i = 0; $i < count($categories); $i++) {
            $category_total[] = $records->where('category', $categories[$i])
                         ->sum('cost');
        }

        return view('month_index', ['records' => $records, 'year' => $year, 'month' => $month, 'sort' => $sort, 'categories' => $categories, 'category_total' => $category_total]);
    }
    
    public function year_index(Request $request)
    {
        $id = Auth::id();
        $year = $request->year;
        $categories = Category::pluck('category');
        $record = History::where('user_id', $id);
        $records = $record->whereYear('date', $year)
                          ->get();

        for ($i = 0; $i < count($categories); $i++) {
            $category_total[] = $records->where('category', $categories[$i])
                                        ->sum('cost');
        }

        for ($j = 1; $j <= 12; $j++) {
            $month_total[] = History::where('user_id', $id)->whereYear('date', $year)
                                                           ->whereMonth('date', $j)
                                                           ->sum('cost');
        }
        
        return view('year_index', ['year' => $year, 'categories' => $categories, 'category_total' => $category_total, 'month_total' => $month_total]);
    }
    
    public function add(Request $request)
    {
        // Varidationを行う
        $this->validate($request, History::$rules);
        
        $id = Auth::id();

        $history = new History;
        $form = $request->all();
        $form['user_id'] = $id;

        unset($form['_token']);

        $history->fill($form)->save();
    
        return view('record_completed');
    }
    
    public function edit(Request $request)
    {
        $record = History::find($request->id);
        $categories = Category::pluck('category');
        if (empty($record)) {
            abort(404);    
        }
        return view('edit', ['record' => $record, 'categories' => $categories]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, History::$rules);
        $history = History::find($request->id);
        $history_form = $request->all();
        unset($history_form['_token']);
        
        $history->fill($history_form)->save();
        return view('update_completed');
    }
    
    public function delete(Request $request)
    {
        $record = History::find($request->id);
        $year = $request->year;
        $month = $request->month;
      
        $record->delete();
        return redirect('month_index', ['year' => $year, 'month' => $month]);
    }
    
    public function category_add(Request $request)
    {
        $form = $request->all();
        $category = new Category;
        unset($form['_token']);
        
        $category->fill($form)->save();
    
        return view('home');
    }
}
