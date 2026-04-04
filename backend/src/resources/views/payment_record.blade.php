@extends('layouts/app')

@section('content')
<h1>支払い記録</h1>
<div>
    <form action="payment/store" method="post">
        @csrf
        <select name="contractor" id="">外注先
        @foreach($contractors as $contractor)
            <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
        @endforeach
        </select>
        <label for="date">対象年月</label>
        <input type="date" name="target_date" id="date">
        <label for="amount">支払い金額</label>
        <input type="number" name="amount" id="amount">
        <label for="payment_method">支払い方法</label>
        <select name="payment_method" id="">
            @foreach($payment_method as $method)
            <option value="{{ $method }}">{{ $method }}</option>
            @endforeach
        </select>
        <input type="submit">
    </form>
</div>
@endsection
