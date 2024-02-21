<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
  </head>
  <body>
    <h1 class="text-blue-500">템플릿이니?</h1>
    <div>
      <a href="{{ route('list') }}">메인 페이지</a>
      <a href="{{ route('create') }}">차량 등록 페이지</a>
    </div>
    @inertia
  </body>
</html>