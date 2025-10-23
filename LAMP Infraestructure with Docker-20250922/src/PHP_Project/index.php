<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Urban Music Awards</title>
    <link rel="stylesheet" href="style.css" />
    <style>

    </style>
</head>


<body>
    <?php

     ?>
    <header>
        <img src="Utils/icono.png" alt="icono">
    </header>
    <main>
        <table id="artistsTable">
            <thead>
                <tr>
                    <th>Artist</th>
                    <th>Last Song</th>
                    <th>Votes</th>
                </tr>
            </thead>
            <tbody id="artistList">
                <?php
                        require_once "OperationsDB.php";
                        require_once("Utils/Artist.php");
                        require_once("Utils/Vote.php");
        try {
            $oper = new Operations();
            $artists = $oper->getAllArtists();
            foreach ($artists as $a) {
                echo "<tr>
                        <td>".htmlspecialchars($a->getName())."</td>
                        <td>".htmlspecialchars($a->getLastSong())."</td>
                        <td>".htmlspecialchars($oper->getNumberVotes($a->getId()))."</td>
                        
                    </tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='5' style='color:red;'>DB Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2025 Urban Music Awards | All rights reserved</p>
    </footer>
</body>

</html>