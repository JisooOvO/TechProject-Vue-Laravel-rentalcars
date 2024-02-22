<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
  </head>
  <body>
    <header class="w-full h-20 border-b px-4 mb-10 flex flex-col justify-center ">
      <h1 class="flex justify-between items-center">
        <a class="text-xl font-serif hover:opacity-80" href="{{ route('list') }}">AMUZ RENTER</a>
        <div class="py-2 px-4 hover:cursor-pointer hover:opacity-80 text-white font-bold bg-blue-500 border rounded-md shadow-md">
          <a href="{{ route('create') }}">차량 등록</a>
        </div>
      </h1>
    </header>
    <div class="mx-4">
      @inertia
    </div>
    <div class="h-12"></div>
  </body>
</html>