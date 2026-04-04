@extends('layouts/app')

@section('content')
<div>
    <form action="workReport" method="post">
        @csrf
        <label for="">日付</label>
        <input type="date" name="date">
        <select name="contractor" id="">
            @foreach($contractors as $contractor)
                <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
            @endforeach
        </select>
        <select name="work_site" id="">
            @foreach($work_sites as $work_site)
                <option value="{{ $work_site->id }}">{{ $work_site->name }}</option>
            @endforeach
        </select>
        <select name="maker" id="">
            @foreach($makers as $maker)
                <option value="{{ $maker->id }}">{{ $maker->name }}</option>
            @endforeach
        </select>
        <select name="task" id="">
            @foreach($tasks as $task)
                <option value="{{ $task->id }}">{{ $task->name }}{{ $task->unit }}</option>
            @endforeach
        </select>
        <label for="quantity">数量</label>
        <input type="number" name="quantity" id="quantity">
        <input type="submit">
    </form>
</div>
@endsection
