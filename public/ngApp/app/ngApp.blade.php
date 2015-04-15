<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>Market Trade Processor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <base href="{{ URL::to('/') }}" token="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::to('/') }}/ngApp/app/styles/main.css">
    <link rel="icon" type="image/ico" href="{{ URL::to('/') }}/favicon.ico">
  </head>

  <body ng-app="ngAppApp">

    <div ng-include="'ngApp/app/views/commons/header.tpl.html'"></div>

    <div class="container">
        <div ng-view=""></div>
    </div>

    <div ng-include="'ngApp/app/views/commons/footer.tpl.html'"></div>

    @include('views/commons/scripts')

</body>
</html>
