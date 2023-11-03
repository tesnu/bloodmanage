@extends('layout.main')
@section('title', 'Register')
@section('content')
<div class="flex items-center justify-center">
    <form action="" method="POST"
        class="flex flex-col gap-3 px-2 mt-6 xs:w-108 w-full relative">
        @csrf
        <div class="text-xl text-center">Register a new employee</div>
        <div class="flex flex-col relative pb-3">
            <label for="name" class="mb-[1px] text-[16px]">Name</label>
            <input type="text" id="name" name="name" class="rounded h-12 text-lg dark:bg-neutral-700"
                placeholder="Name" value={{ old('name') }}>
            @error('name')
                <p class="text-red-500 absolute -bottom-2 text-sm pl-[1px]">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-col relative pb-3">
            <label for="username" class="mb-[1px] text-[16px]">Username</label>
            <input type="text" id="username" name="username" class="rounded h-12 text-lg dark:bg-neutral-700"
                placeholder="Username" value={{ old('username') }}>
            @error('username')
                <p class="text-red-500 absolute -bottom-2 text-sm pl-[1px]">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-col relative pb-3">
            <label for="password" class="mb-[1px] text-[16px]">Password</label>
            <input type="password" id="password" name="password" class="rounded h-12 text-lg dark:bg-neutral-700 pr-10"
                placeholder="Password">
            @error('password')
                <p class="text-red-500 absolute -bottom-2 text-sm pl-[1px]">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex justify-center">
            <button class="py-1.5 w-40 bg-green-700 rounded text-white">
                Register
            </button>
        </div>
    </form>
</div>
@endsection
