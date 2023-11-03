@extends('layout.main')
@section('title', 'Drop')
@section('content')
<div class="flex flex-col sm:items-center">
    <h2 class="text-xl text-center">Employees</h2>
    <div class="flex flex-col gap-0.5 sm:w-144">
        <div class="flex bg-neutral-700 gap-1">
            @if (count($employees)>0)
            <div class="w-48 text-sm">Name</div>
            <div class="w-20 text-sm">Username</div>
            <div class="w-20 text-sm">Collected</div>
            @endif
        </div>
        @forelse ($employees as $employee)
            <div class="flex @if($loop->index%2==1) bg-neutral-700 @endif gap-1 py-1">
                <div class="w-48 text-sm">{{$employee->name}}</div>
                <div class="w-20 text-sm">{{$employee->username}}</div>
                <div class="w-20 text-sm">{{count($employee->donations)}}</div>
            </div>
        @empty
            <div class="text-xl text-center">No employees found</div>
        @endforelse
    </div>
    <h2 class="text-xl mt-3 text-center">Hospitals</h2>
    <div class="flex flex-col gap-0.5 sm:w-144">
        <div class="flex bg-neutral-700 gap-1">
            @if (count($hospitals)>0)
            <div class="w-48 text-sm">Name</div>
            <div class="w-20 text-sm">Username</div>
            <div class="w-20 text-sm">Orders</div>
            @endif
        </div>
        @forelse ($hospitals as $hospital)
            <div class="flex @if($loop->index%2==1) bg-neutral-700 @endif gap-1 py-1">
                <div class="w-48 text-sm">{{$hospital->name}}</div>
                <div class="w-20 text-sm">{{$hospital->username}}</div>
                <div class="w-20 text-sm">{{count($hospital->orders)}}</div>
            </div>
        @empty
            <div class="text-xl text-center">No hospitals found</div>
        @endforelse
    </div>
</div>
@endsection
