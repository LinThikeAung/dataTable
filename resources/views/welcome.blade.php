<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    </head>
    <body>
        <div class="container">
            <div class="card my-5">
                <div class="card-header">User Tables</div>
            </div>
            <div class="card-body">
                <table class="table table-hover dataTable_id">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <!-- Datatables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('.dataTable_id').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "/user/datatables/ssr",
                    //have same database column name
                    columns: [
                        { 
                            data: 'name',
                            name: 'name' 
                        },
                        { 
                            data: 'email', 
                            name: 'email'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'country',
                            name: 'country'
                        },
                        {  //action ka database mar ma shi tot web.php mar thwar lote mal
                           //(custom database fake column pop)
                            data: 'action', 
                            name: 'action' 
                        },
                    ]
                });

                $(document).on('click','.delete',function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url : `/user/${id}/delete`,
                        type: 'GET',
                        success: function(){
                            table.ajax.reload();
                        }
                    })
                })
            });
        </script>
    </body>
</html>
