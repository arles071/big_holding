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
        <h1>Lista de usuarios</h1>

        <table id="example" class="display" style="width:100%; min-height: 456px;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Tipo documento</th>
                    <th>Documento</th>
                    <th>Celular</th>
                    <th>Fecha creado</th>
                    <th>Fecha actualización</th>
                    <th>Acción</th>
                </tr>
            </thead>
           
        
        </table>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        
       $(document).ready(function () {
            $('#example').DataTable({
                ajax: 'api/usuarios',
                columns: [
                    { data: 'id' },
                    { data: 'identification_type_id' },
                    { data: 'identification_number' },
                    { data: 'mobile_number' },
                    { data: 'created_at' },
                    { data: 'updated_at' },
                    { data: 'accion' },
                ],
                "order": [[ 4, 'desc' ]]
            });
        });
    </script>

</body>
</html>