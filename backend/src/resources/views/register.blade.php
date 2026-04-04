@extends('layouts/app')

@section('content')
<h1>登録画面</h1>
<div>
    <form action="contractor" method="post">
        @csrf
        <p>外注先</p>
        <label for="contractorName">氏名</label>
        <input type="text" name="name" id="contractorName">
        <label for="contractorBirth">生年月日</label>
        <input type="date" name="date_of_birth" id="contractorBirth">
        <label for="contractorAddress">住所</label>
        <input type="text" name="address" id="contractorAddress">
        <input type="submit">
    </form>
    <form action="maker" method="post">
        @csrf
        <label for="maker">メーカー</label>
        <input type="text" name="maker" id="maker">
        <input type="submit">
    </form>
    <form action="task" method="post">
        @csrf
        <label for="task">作業内容</label>
        <input type="text" name="task" id="task">
        <input type="submit">
    </form>
</div>
@endsection
