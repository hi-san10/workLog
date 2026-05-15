@extends('layouts/app')

@section('content')
<div>
    @if ('session')
    <p>{{ session('success') }}</p>
    @endif
    <form action="workReport" method="post">
        @csrf
        <label for="">日付</label>
        <input type="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}">
        <select name="contractor" id="">
            @foreach($contractors as $contractor)
                <option value="{{ $contractor->id }}" {{ old('contractor') == $contractor->id ? 'selected' : '' }}>{{ $contractor->name }}</option>
            @endforeach
        </select>
        <select name="work_site" id="">
            @foreach($work_sites as $work_site)
                <option value="{{ $work_site->id }}" {{ old('work_site') == $work_site->id ? 'selected' : '' }}>{{ $work_site->name }}</option>
            @endforeach
        </select>
        <select name="maker" id="">
            @foreach($makers as $maker)
                <option value="{{ $maker->id }}" {{ old('maker') == $maker->id ? 'selected' : '' }}>{{ $maker->name }}</option>
            @endforeach
        </select>
        <select name="task" id="">
            @foreach($tasks as $task)
                <option value="{{ $task->id }}" {{ old('task') == $task->id ? 'selected' : '' }}>{{ $task->name }}{{ $task->unit }}</option>
            @endforeach
        </select>
        <label for="quantity">数量</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}">
        <input type="submit">
    </form>
</div>
@endsection
