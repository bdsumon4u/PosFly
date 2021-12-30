<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel=icon href=/images/favicon.ico>
    <link rel="stylesheet" href="/css/master.css">

    <title>{{ config('app.name') }} | Ultimate Inventory With POS</title>
    <link rel="apple-touch-icon" href="/images/logo.png">
    <link rel="manifest" href="/manifest.json">
  </head>

  <body class="text-left">
    <noscript>
      <strong>
        We're sorry but ERP Fixer doesn't work properly without JavaScript
        enabled. Please enable it to continue.</strong
      >
    </noscript>

    <!-- built files will be auto injected -->
    <div class="loading_wrap" id="loading_wrap">
      <div class="loader_logo">
      <img src="/images/logo.png" class="" alt="logo" />

      </div>

      <div class="loading"></div>
    </div>
    <div id="app">
    </div>

    <script src="/js/main.min.js?v=3.3.2"></script>
    <script src="/service-worker.js"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/service-worker.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
  </body>
</html>
