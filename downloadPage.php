<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Plainte</title>
</head>

<body>
    <h1 style="text-align:center; color: red;">Reçu de dépôt de plainte</h1>
    <div>
        <h3 style="text-align:center;">
            Informations sur la plainte
        </h3>
        <table>
            <tr>
                <th>Numéro de la plainte</th>
                <td>{{numPlainte}}</td>
            </tr>
            <tr>
                <th>Date de la plainte</th>
                <td>{{datePlainte}}</td>
            </tr>
            <tr>
                <th>Objet</th>
                <td>{{objetPlainte}}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{descriptionPlainte}}</td>
            </tr>
            <tr>
                <th>Mode d'émission</th>
                <td>{{modeEmission}}</td>
            </tr>
            <tr>
                <th>Pièces jointes</th>
                <td>{{pieceJointe}}</td>
            </tr>
        </table>
    </div>
    <div>
        <h3 style="text-align:center;">
            Informations sur le plaignant
        </h3>
        <table>
            <tr>
                <th>Numéro du plaignant</th>
                <td>{{numPlaignant}}</td>
            </tr>
            <tr>
                <th>Nom</th>
                <td>{{nomPlaignant}}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{adressePlaignant}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{emailPlaignant}}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{telPlaignant}}</td>
            </tr>
        </table>
    </div>
    <style>
        table{
            width: 60%;
        }

        table tr{
            margin: 2em;
        }

        table tr th{
            text-align: left;
        }
    </style>
</body>

</html>