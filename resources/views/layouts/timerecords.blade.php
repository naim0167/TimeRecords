<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Time Records</title>
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    
        <!-- Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    
        <!-- DataTables and DataTables Buttons JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-mQ2YNBFdEO3tN6/ebZUnQYoRR+xgQjcDSJ5eF8wEElMOlHxI/SPVjPusFbfDA9b" crossorigin="anonymous">

    </head>
    
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="/time_records">Time Records</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/projects">Projects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/reports">Reports</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="/profile">🛠️{{ Auth::user()->name }}</a>
            </li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();" class="nav-link text-light" >
                    {{ __('Log Out') }}❌
                </x-responsive-nav-link>
            </form>
        </ul>
    </nav>
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }} </strong>
        </div>
    @endif

    @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <strong>{{ $message }} </strong>
        </div>  
    @endif

    @yield('main')
    
</body>
</html>

<script>
    function initializeDataTable(tableId, exportColumns) {
        $('#' + tableId).DataTable({
            dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'btn btn-outline-info',
                        text: '<i class="fas fa-copy"></i> Copy',
                        exportOptions: {
                            columns: exportColumns
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-outline-info',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        exportOptions: {
                            columns: exportColumns
                        }

                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-outline-success',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        exportOptions: {
                            columns: exportColumns
                        }

                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-outline-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: exportColumns
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-outline-dark',
                        text: '<i class="fas fa-print"></i> Print',
                        exportOptions: {
                            columns: exportColumns
                        }

                    },
                ],
            });
        }

    $(document).ready(function() {
        initializeDataTable('myTable', [0, 1, 2, 3, 4, 5]);
    });
    $(document).ready(function() {
        initializeDataTable('personTable', [0, 1, 2]);
    });

</script>

