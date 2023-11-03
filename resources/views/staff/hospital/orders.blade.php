@extends('layout.main')
@section('title', 'Drop')
@section('content')
<div class="flex flex-col items-center">
    <div class="flex flex-col gap-0.5 sm:w-120">
        <div class="flex bg-neutral-700 gap-1">
            @if (count($orders)>0)
            <div class="w-56">Donor</div>
            <div class="w-14">Sex</div>
            <div class="w-24">Blood type</div>
            <div class="w-20">
                Status
            </div>
            @endif
        </div>
        @forelse ($orders as $order)
            <div class="flex @if($loop->index%2==1) bg-neutral-700 @endif gap-1 py-1">
                <div class="w-56">{{$order->donation->donor->name}}</div>
                <div class="w-14">{{$order->donation->donor->sex}}</div>
                <div class="w-24">{{$order->donation->donor->blood_type}}</div>
                <div class="w-20 text-sm">
                    @if ($order->completed)
                        Received
                    @else
                    <form action="/order/complete/{{$order->id}}" method="post">
                        @csrf
                        <button type="submit" class="w-20 text-sm py-0.5 bg-green-700 rounded">Received</button>
                    </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-xl text-center">No orders found</div>
        @endforelse
    </div>
</div>
@endsection
