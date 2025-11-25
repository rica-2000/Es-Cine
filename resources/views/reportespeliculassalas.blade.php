<html>
<head>
    <title>Reporte de Películas por Salas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Películas por Salas</h1>
    <table>
        <thead>
            <tr>
                <th>ID Sala</th>
                <th>Nombre Sala</th>
                <th>ID Película</th>
                <th>Nombre Película</th>
                <th>Duración (min)</th>
                <th>Género</th>
            </tr>
        </thead>
        <tbody>
            @foreach($funciones as $funcion)
                <tr>
                    <td>{{ $funcion->sala->id }}</td>
                    <td>{{ $funcion->sala->nombre }}</td>
                    <td>{{ $funcion->pelicula->id }}</td>
                    <td>{{ $funcion->pelicula->nombre }}</td>
                    <td>{{ $funcion->pelicula->duracion }}</td>
                    <td>{{ $funcion->pelicula->genero }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>