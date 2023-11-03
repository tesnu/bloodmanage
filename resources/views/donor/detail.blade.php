@extends('layout.main')
@section('title', 'Drop')
@section('content')
    <div class="w-full flex justify-center p-3 sm:p-0">
        <div class="w-full sm:w-144 flex flex-col justify-center">
            <div class="flex flex-col px-4">
                <div class="text-lg">Donor id: {{$donor->id}}</div>
                <div class="text-lg">Full name: {{$donor->name}}</div>
                <div class="text-lg">Blood type: {{$donor->blood_type}}</div>
                <div class="text-lg">Sex: {{$donor->sex}}</div>
                <div class="text-lg">Birth date: {{$donor->birth_date}}</div>
            </div>
            @if (auth('employee')->check())
            <form action="/donate/{{$donor->id}}" class="flex w-full" method="POST">
                @csrf
                <button type="submit" class="ml-auto w-20 py-1 bg-green-700 rounded-sm">Donate</button>
            </form>
            @endif
            <div class="border-t-[1px] mt-1 pt-1 flex flex-col gap-0.5">
                @if (count($donor->donations) > 0)
                <div class="flex gap-1 w-full bg-neutral-700">
                    <div class="w-24">Date</div>
                    <div class="w-28">Status</div>
                    @if (auth('hospital')->check())
                    <div class="w-20">Action</div>
                    @endif
                </div>
                @endif
                @forelse ($donor->donations as $donation)
                    <div class="@if ($loop->index % 2 == 1) bg-neutral-700 @endif flex py-0.5">
                        <div class="w-24">{{date_format($donation->created_at, 'd-m-Y')}}</div>
                        <div class="w-28">
                            @if ($donation->order)
                            @if ($donation->order->completed)
                            Consumed
                            @else
                            In Transit
                            @endif
                            @else
                            In storage
                            @endif
                        </div>
                        @if (auth('hospital')->check())
                        <div class="w-20">
                            @if (!$donation->order)
                            <form action="/order/{{$donation->id}}" method="POST">
                                @csrf
                                <button type="submit" class="ml-auto w-20 py-0.5 text-sm bg-green-700 rounded-sm">Order</button>
                            </form>
                            @else
                            <p class="text-gray-300">Unavialable</p>
                            @endif
                        </div>
                        @endif
                    </div>
                @empty
                    <div class="text-xl">No donations are made by this donor</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
