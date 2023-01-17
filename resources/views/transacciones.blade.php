<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
   
</head>
  <body>
    <div class="container mt-3">
        <h1>Lista de transacciones</h1>
        <p><a href="/usuarios">Regresar</a><br></p>

        <!-- Informacion del usuario -->
        @if($user !== null)
       
        <div class="row">
            <div class="col-12">
                <p>Tipo documento: {{ ($user->identification_type_id === 1) ? 'CC': 'TI' }}</p>
                <p>Documento: {{ $user->identification_number }}</p>
                <p>Telefono: {{ $user->mobile_number }}</p>
            </div>
        </div>
        @endif

        @if($status_trasation)
        <table id="example" class="display" style="width:100%; min-height: 456px;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Estado transación</th>
                    <th>Moneda</th>
                    <th>Año</th>
                    <th>Cantidad</th>
                    <th>Fecha creado</th>
                    <th>Fecha actualización</th>
                    
                </tr>
            </thead>
           
        
        </table>
        @else
        <div><p>El Usuario no tiene trasaciones <a href="/usuarios">Regresar</a><br></p></div>
        @endif
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        
       $(document).ready(function () {
            $('#example').DataTable({
                ajax: '{{ $url_table }}',
                columns: [
                    { data: 'id' },
                    { data: 'transaction_status_id' },
                    { data: 'transaction_currency_id' },
                    { data: 'year' },
                    { data: 'amount' },
                    { data: 'created_at' },
                    { data: 'updated_at' },
                ],
                "order": [[ 4, 'desc' ]]
            });
        });
    </script>

</body>
</html>