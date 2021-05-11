@props(['driver'])
<script src="//cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js" integrity="sha512-DjIQO7OxE8rKQrBLpVCk60Zu0mcFfNx2nVduB96yk5HS/poYZAkYu5fxpwXj3iet91Ezqq2TNN6cJh9Y5NtfWg==" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/serviceWorker.min.js" integrity="sha512-gZN7SatPzB7LiGjOd4Sree/ecjktoLPgWt22wfApKrzuCpS9KsK7uKEDB+AAGY96NHCW1sAEm1JdaHDDP4MsIQ==" crossorigin="anonymous"></script>
@if ($driver == 'pusher')
{{-- <script src="//js.pusher.com/7.0/pusher.min.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js" integrity="sha512-XVnzJolpkbYuMeISFQk6sQIkn3iYUbMX3f0STFUvT6f4+MZR6RJvlM5JFA2ritAN3hn+C0Bkckx2/+lCoJl3yg==" crossorigin="anonymous"></script>
@endif
@if ($driver == 'ably')
<script src="//cdnjs.cloudflare.com/ajax/libs/ably/1.2.9/ably.min.js" integrity="sha512-sWHn5BWive9jAnOdOUH5fGBwmDEgXPlhHN2QQ9DJKcLtMlvsg3VUQMZuFSLId7dCvcNrJxn8uo7epcMwtAmCuA==" crossorigin="anonymous"></script>
@endif
