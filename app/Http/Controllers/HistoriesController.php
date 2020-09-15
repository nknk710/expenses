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
    
    public function index(Request $request)
    {
        $id = Auth::id();
        $year = $request->year;
        $month = $request->month;
        $categories = Category::pluck('category');
        $record = History::where('user_id', $id);
        if ($request->sort) {
            if ($request->sort == 'desc') {
                $sort = $request->sort;
                $records = $record->whereYear('date', 2020)
                           ->whereMonth('date', $month)
                           ->orderBy('date', 'desc')
                           ->get();
            } else {
                $sort = $request->sort;
                $records = $record->whereYear('date', 2020)
                           ->whereMonth('date', $month)
                           ->orderBy('date', 'asc')
                           ->get();
            } 
        } else {
            $sort = 'asc';
            $records = $record->whereYear('date', 2020)
                           ->whereMonth('date', $month)
                           ->orderBy('date', 'asc')
                           ->get();
        }

        for ($i = 0; $i < count($categories); $i++) {
            $category_total[] = $records->where('category', $categories[$i])
                         ->sum('cost');
        }

        return view('index', ['records' => $records, 'year' => $year, 'month' => $month, 'sort' => $sort, 'categories' => $categories, 'category_total' => $category_total]);
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
      
        $record->delete();
        return redirect('index');
    }
}
