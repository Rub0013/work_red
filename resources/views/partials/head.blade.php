<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="http://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
<link rel="stylesheet" href="{{ elixir('css/theme.css') }}">
<link href="{{ elixir('css/bootstrap-editable.css') }}" rel="stylesheet">

<script src="{{ elixir('js/all.js') }}"></script>
<script src="{{ elixir('js/bootstrap-editable.js') }}"></script>
<script src="{{ elixir('js/jquery.validate.min.js') }}"></script>
<script src="{{ elixir('js/bootstrap-confirmation.min.js') }}"></script>
<script src="{{ elixir('js/bootstrap-growl.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap4.min.js"></script>


<script>$.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});
</script>