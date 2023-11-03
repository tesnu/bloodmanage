@extends('layout.main')
@section('title', 'Register')
@section('content')
<div class="flex items-center justify-center">
    <form action="" method="POST"
        class="flex flex-col gap-3 px-2 mt-6 xs:w-108 w-full relative">
        @csrf
        <div class="text-xl text-center">Register a new donor</div>
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
        <div class="flex flex-col relative pb-3 mb-2">
            <label for="blood_type" class="mb-[1px] text-[16px]">Blood type</label>
            <select name="blood_type" id="blood_type"
                class="dark:bg-neutral-700 @error('blood_type') border-red-600 @enderror rounded">
                <option disabled selected>Blood type</option>
                @foreach ($blood_types as $blood_type)
                    <option value="{{ $blood_type }}">{{ $blood_type }}</option>
                @endforeach
            </select>
            @error('blood_type')
                <p class="text-red-500 absolute -bottom-2 text-sm pl-[1px]">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-col relative pb-3 mb-2">
            <label for="sex" class="mb-[1px] text-[16px]">Sex</label>
            <select name="sex" id="sex"
                class="dark:bg-neutral-700 @error('sex') border-red-600 @enderror rounded">
                <option disabled selected>Sex</option>
                <option value="female">Female</option>
                <option value="male">Male</option>
            </select>
            @error('sex')
                <p class="text-red-500 absolute -bottom-2 text-sm pl-[1px]">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-col relative pb-3">
            <label for="birth_date" class="mb-[1px] text-[16px]">Birth date</label>
            <input type="text" id="birth_date" name="birth_date" class="rounded h-12 text-lg dark:bg-neutral-700 pr-10"
                placeholder="YYYY-MM-DD">
            @error('birth_date')
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
