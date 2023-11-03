<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: {
        extend: {
      screens: {
        'xs': '480px',
      },
      spacing: {
        '30': '7.5rem',
        '84': '21rem',
        '88': '22rem',
        '92': '23rem',
        '104': '26rem',
        '108': '27rem',
        '112': '28rem',
        '116': '29rem',
        '120': '30rem',
        '124': '31rem',
        '128': '32rem',
        '132': '33rem',
        '136': '34rem',
        '140': '35rem',
        '144': '36rem',
        '148': '37rem',
        '152': '38rem',
        '156': '39rem',
        '160': '40rem',
        '164': '41rem',
        '168': '42rem',
        '172': '43rem',
        '176': '44rem',
        '180': '45rem',
        '184': '46rem',
        '188': '47rem',
        '196': '48rem',
        '200': '49rem',
        '204': '50rem',
        '208': '51rem',
        '212': '52rem',
        '216': '53rem',
        '220': '54rem',
        '224': '55rem',
        '228': '56rem',
        '232': '57rem',
        '236': '58rem',
        '240': '59rem',
        '244': '60rem',
        '248': '61rem',
        '252': '62rem',
        '256': '63rem',
        '260': '64rem',
      }
    },
      }
    }
  </script>
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
