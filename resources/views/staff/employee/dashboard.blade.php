@extends('layout.main')
@section('title', 'Drop')
@section('content')
<div class="flex flex-col sm:items-center">
    <form action="" class="flex items-center gap-1 my-2 justify-center">
        <input type="text" name="term" class="h-10 rouned dark:bg-neutral-700" value="{{$term}}">
        <button type="submit" class="w-20 bg-green-700 h-9">Search</button>
    </form>
    <div class="flex flex-col gap-0.5 sm:w-144">
        <div class="flex bg-neutral-700 gap-1">
            @if (count($donors)>0)
            <div class="w-48">Name</div>
            <div class="w-14">Sex</div>
            <div class="w-20">Blood type</div>
            <div class="w-24">Birth date</div>
            <div class="">Donations</div>
            @endif
        </div>
        @forelse ($donors as $donor)
            <a class="flex @if($loop->index%2==1) bg-neutral-700 @endif gap-1 py-1" href="/donor/detail/{{$donor->id}}">
                <div class="w-48">{{$donor->name}}</div>
                <div class="w-14">{{$donor->sex}}</div>
                <div class="w-20">{{$donor->blood_type}}</div>
                <div class="w-24">{{date_format(date_create($donor->birth_date), 'd-m-Y')}}</div>
                <div class="">{{count($donor->donations)}}</div>
            </a>
        @empty
            @if ($term)
            <div class="text-xl text-center">No donors found</div>
            @else
            <div class="text-xl text-center">No donors registered yet</div>
            @endif
        @endforelse
    </div>
</div>
@endsection
