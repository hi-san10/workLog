@extends('layouts/app')

@section('content')
<div>
    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif
    <form action="workReport" method="post">
        @csrf
        <label for="date">日付</label>
        <input type="date" name="date" id="date" value="{{ old('date', now()->format('Y-m-d')) }}">

        <fieldset>
            <legend>外注先</legend>
            @foreach($contractors as $contractor)
            <label>
                <input type="checkbox" name="contractors[]" value="{{ $contractor->id }}"
                    {{ in_array($contractor->id, old('contractors', [])) ? 'checked' : '' }}>
                {{ $contractor->name }}
            </label>
            @endforeach
        </fieldset>

        <select name="work_site" id="work_site">
            @foreach($work_sites as $work_site)
                <option value="{{ $work_site->id }}" {{ old('work_site') == $work_site->id ? 'selected' : '' }}>{{ $work_site->name }}</option>
            @endforeach
        </select>
        <select name="maker" id="maker">
            @foreach($makers as $maker)
                <option value="{{ $maker->id }}" {{ old('maker') == $maker->id ? 'selected' : '' }}>{{ $maker->name }}</option>
            @endforeach
        </select>
        <select name="task" id="task">
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
