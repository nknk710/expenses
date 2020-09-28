@extends('layouts.app')

@section('title', '一覧')

@section('page_css')
<link rel="stylesheet" href="{{ secure_asset('css/index.css') }}" type="text/css" />

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-content">
                
                <form action="{{ route('month_index') }}" method="get">
                @csrf
                    <label for="year">
                        <select class="" for="year" name="year" id="" size="1" >
                        @for ($i = 2020; $i < 2050; $i++)
                            <option value="{{ $i }}" {{ $year == "$i" ? "selected" : "" }}>{{ $i }}年</option>
                        @endfor
                        </select>
                    </label>
                    <label for="month">
                        <select class="" for="month" name="month" id="" size="1" >
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $month == "$i" ? "selected" : "" }}>{{ $i }}月</option>
                        @endfor
                        </select>
                    </label>
                    <button class="search-btn">検 索</button>
                </form>
            </div>  
            <div class="main-content">
                <div class="category-total">
                    <h3 class="content-title">{{ $year }}年{{ $month }}月のカテゴリー別支出一覧</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="14%">{{ $categories[0] }}</th>
                                <th width="14%">{{ $categories[1] }}</th>
                                <th width="14%">{{ $categories[2] }}</th>
                                <th width="14%">{{ $categories[3] }}</th>
                                <th width="14%">{{ $categories[4] }}</th>
                                <th width="14%">{{ $categories[5] }}</th>
                                <th width="14%">{{ $categories[6] }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>¥ {{ $category_total[0] }}</th>
                                <th>¥ {{ $category_total[1] }}</th>
                                <th>¥ {{ $category_total[2] }}</th>
                                <th>¥ {{ $category_total[3] }}</th>
                                <th>¥ {{ $category_total[4] }}</th>
                                <th>¥ {{ $category_total[5] }}</th>
                                <th>¥ {{ $category_total[6] }}</th>
                            </tr>
                        </tbody>
                    </table>
                    <p class="total-cost">TOTAL ¥ {{ array_sum($category_total)}}</p>
                </div>
                
                <div class="all-history">
                    <h3 class="content-title">{{ $year }}年{{ $month }}月の支出詳細一覧</h3>
                <form action="{{ route('month_index') }}" method="get">
                @csrf
                    <input type="hidden" name="year" value="{{ $year }}">
                    <input type="hidden" name="month" value="{{ $month }}">
                    <select for="sort" name="sort" size="1" >
                        <option value="asc" {{ $sort == "asc" ? "selected" : "" }}>昇順</option>
                        <option value="desc"{{ $sort == "desc" ? "selected" : "" }}>降順</option>
                    </select>
                    <button class="sort-btn">並び替え</button>
                </form>
                
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">日時</th>
                                <th width="20%">カテゴリー</th>
                                <th width="30%">メモ</th>
                                <th width="20%">金額</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <th>{{ $record->date }}</th>
                                    <td>{{ $record->category }}</td>
                                    <td>{{ str_limit($record->content, 100) }}</td>
                                    <td>¥{{ $record->cost }}</td>
                                    <td>
                                        <div class="form">
                                            <form action="{{ route('edit')}}" method="POST">
                                            @csrf
                                                <input type="hidden" name="id" value="{{ $record->id }}">
                                                <input type="submit" value="編集" class="btn btn-primary btn-sm">
                                            </form>
                                        </div>
                                        <div class="form">
                                            <form action="{{ route('delete')}}" method="GET">
                                            @csrf
                                                <input type="hidden" name="id" value="{{ $record->id }}">
                                                <input type="hidden" name="year" value="{{ $year }}">
                                                <input type="hidden" name="month" value="{{ $month }}">
                                                <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
                    @if (count($records) <= 0)
                        <p>記録がありません</p>
                    @endif
                
                </div>
                
            </div>
            
        </div>
    </div>
</div>
@endsection
