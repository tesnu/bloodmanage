<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>@yield('title')</title>
</head>

<body class="bg-neutral-800 text-white">
    <div class="h-screen w-full overflow-hidden">
        <div class="h-12 w-full flex items-center shadow mb-2">
            <a href=
            @auth('admin')"/admin/dashboard" @endauth
            @auth('employee') "/employee/dashboard"
            @endauth @auth('hospital') "/hospital/dashboard" @endauth "/"
            id="logo"
            class="text-3xl pl-1 -mt-2 text-red-500"
            >Drop
            </a>
            <nav class="ml-auto mr-2 h-full flex items-center gap-1">
                @auth('admin')
                <a href="/employee/register" class="w-20 text-center hover:border-b-[1px]">Employee</a>
                <a href="/hospital/register" class="w-20 text-center hover:border-b-[1px]">Hospital</a>
                <a href="/logout" class="w-20 text-center hover:border-b-[1px]">Logout</a>
                @endauth
                @auth('hospital')
                <a href="/orders" class="w-20 text-center hover:border-b-[1px]">Orders</a>
                <a href="/logout" class="w-20 text-center hover:border-b-[1px]">Logout</a>
                @endauth
                @auth('employee')
                <a href="/donor/register" class="w-20 text-center hover:border-b-[1px]">Donor</a>
                <a href="/logout" class="w-20 text-center hover:border-b-[1px]">Logout</a>
                @endauth
                @guest
                <a href="/admin/login" class="w-20 text-center hover:border-b-[1px]">Admin</a>
                <a href="/employee/login" class="w-20 text-center hover:border-b-[1px]">Employee</a>
                <a href="/hospital/login" class="w-20 text-center hover:border-b-[1px]">Hospital</a>
                @endauth
            </nav>
        </div>
        @yield('content')
    </div>
</body>

</html>
