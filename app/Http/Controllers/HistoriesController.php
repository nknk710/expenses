<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\History;
use App\Models\Category;

class HistoriesController extends Controller
{
    public function index()
    {
        
    }
    
    public function add(Request $request)
    {
        // Varidationを行う
        $this->validate($request, History::$rules);
        
        $id = Auth::id();

        $history = new History;
        $form = $request->all();
        $form['user_id'] = $id;

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $history->fill($form)->save();
    
        return view('record_completed');
    }
    
    public function edit(Request $request)
    {
        
        return view('record_completed');
    }
    
    public function delete(Request $request)
    {
        
        return view('record_completed');
    }
}
