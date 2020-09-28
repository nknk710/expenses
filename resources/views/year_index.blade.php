@extends('layouts.app')

@section('title', '一覧')

@section('page_css')
<link rel="stylesheet" href="{{ secure_asset('css/year_index.css') }}" type="text/css" />

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-content">
                
                <form action="{{ route('year_index') }}" method="get">
                @csrf
                    <label for="year">
                        <select class="" for="year" name="year" id="" size="1" >
                        @for ($i = 2020; $i < 2050; $i++)
                            <option value="{{ $i }}" {{ $year == "$i" ? "selected" : "" }}>{{ $i }}年</option>
                        @endfor
                        </select>
                    </label>
                    <button class="search-btn">絞り込む</button>
                </form>
            </div>  
            <div class="main-content">
                <div class="category-total">
                    <h3 class="content-title">{{ $year }}年のカテゴリー別支出一覧</h3>
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

            </div>
            
            <div>
                <div class="month-total">
                    <h3 class="content-title">{{ $year }}年の月ごとの支出金額</h3>
                    @foreach ($month_total as $total)
                        <div>
                            <p class="month-cost">{{ $loop->index + 1 }}月　：　¥ {{ $total }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection