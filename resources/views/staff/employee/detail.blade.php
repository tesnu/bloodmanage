@extends('layout.main')
@section('title', 'Drop')
@section('content')
    <div class="w-full flex justify-center p-3 sm:p-0">
        <div class="w-full sm:w-144 flex flex-col justify-center">
            <div class="flex flex-col px-4">
                <div class="text-lg">Employee id: {{$employee->id}}</div>
                <div class="text-lg">Full name: {{$employee->name}}</div>
                <div class="text-lg">Username: {{$employee->username}}</div>
            </div>
            <div class="border-t-[1px] mt-1 pt-1">
                @forelse ($employee->donations as $donation)

                @empty
                    <div class="text-xl">No donations collected by this employee</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
