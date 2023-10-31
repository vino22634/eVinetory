<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Bouteilles</title>
</head>

<body>
    <h1>Liste des Bouteilles RAW</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Image</th>
                <th>Code SAQ</th>
                <th>Pays</th>
                <th>Description</th>
                <th>Prix SAQ</th>
            </tr>
        </thead>
        <tbody> @foreach($bouteilles as $bouteille) <tr>
                <td>{{ $bouteille->id }}</td>
                <td>{{
    $bouteille->nom }}</td>
                <td>
                    @if($bouteille->image)
                        <img src="{{ $bouteille->image }}" alt="{{ $bouteille->nom }}" width="100">
                    @else
                        Pas d'image
                    @endif
                </td>
                <td>{{ $bouteille->code_saq }}</td>
                <td>{{ $bouteille->pays }}</td>
                <td>{{ $bouteille->description }}</td>
                <td>{{ $bouteille->prix_saq }} $</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
