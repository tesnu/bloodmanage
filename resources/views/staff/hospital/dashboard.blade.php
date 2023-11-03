@extends('layout.main')
@section('title', 'Drop')
@section('content')
<div class="flex flex-col sm:items-center">
    <form action="" class="flex items-center gap-1 my-2 justify-center">
        <select name="blood_type" id="blood_type"
                class="dark:bg-neutral-700 rounded">
                <option disabled selected>Blood type</option>
                @foreach ($blood_types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        <button type="submit" class="w-20 bg-green-700 h-9">Find</button>
    </form>
    <div class="flex flex-col gap-0.5 sm:w-144">
        <div class="flex bg-neutral-700 gap-1">
            @if (count($donors)>0)
            <div class="w-48">Name</div>
            <div class="w-14">Sex</div>
            <div class="w-20">Blood type</div>
            <div class="w-24">Birth date</div>
            <div class="">Available</div>
            @endif
        </div>
        @forelse ($donors as $donor)
            <a class="flex @if($loop->index%2==1) bg-neutral-700 @endif gap-1 py-1" href="/donor/detail/{{$donor->id}}">
                <div class="w-48">{{$donor->name}}</div>
                <div class="w-14">{{$donor->sex}}</div>
                <div class="w-20">{{$donor->blood_type}}</div>
                <div class="w-24">{{date_format(date_create($donor->birth_date), 'd-m-Y')}}</div>
                <div class="">
                    @php
                        $count = 0;
                        foreach ($donor->donations as $donation) {
                            if (!$donation->order) {
                                $count+=1;
                            }
                        }
                        echo $count;
                    @endphp
                </div>
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
