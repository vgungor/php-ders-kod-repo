<?php
$kategoriler = [
    [
        "Continue Watching",
        [
            ["Ayak İşleri", "images/ayak.jpg", false],
            ["Christmas Chronicles", "images/christmas.jpg", false],
            ["Klaus", "images/klaus.jpg", false]
        ]
    ],
    [
        "Because you watched The Christmas Chronicles",
        [
            ["In Your Dreams", "images/dreams.jpg", false],
            ["The Croods", "images/croods.jpg", false],
            ["Pet 2", "images/pet2.jpg", false]
        ]
    ],
    [
        "Today's Top Picks for You",
        [
            ["CMXXIV", "images/cmxxiv.jpg", true],
            ["The Town", "images/town.jpg", true],
            ["Land of Sin", "images/landofsin.jpg", true]
        ]
    ],
    [
        "My List",
        [
            ["Movie 1", "images/movie1.jpg", false],
            ["Movie 2", "images/movie2.jpg", false]
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Netflix Benzeri Liste</title>
    <style>
        body {
            background: #111;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .kategori {
            margin-bottom: 30px;
        }

        .kategori h2 {
            margin-bottom: 12px;
            font-size: 24px;
        }

        .film-listesi {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .film-kart {
            position: relative;
            width: 220px;
        }

        .film-kart img {
            width: 220px;
            height: 125px;
            object-fit: cover;
            border-radius: 6px;
            display: block;
        }

        .film-adi {
            margin-top: 6px;
            font-size: 14px;
        }

        .badge {
            position: absolute;
            left: 8px;
            bottom: 32px;
            background: red;
            color: white;
            font-size: 11px;
            padding: 4px 6px;
            border-radius: 3px;
        }
    </style>
</head>
<body>

<?php
for ($i = 0; $i < count($kategoriler); $i++) {
    echo "<div class='kategori'>";
    echo "<h2>" . $kategoriler[$i][0] . "</h2>";
    echo "<div class='film-listesi'>";

    for ($j = 0; $j < count($kategoriler[$i][1]); $j++) {
        echo "<div class='film-kart'>";
        echo "<img src='" . $kategoriler[$i][1][$j][1] . "' alt='" . $kategoriler[$i][1][$j][0] . "'>";
        
        if ($kategoriler[$i][1][$j][2] == true) {
            echo "<div class='badge'>Recently Added</div>";
        }

        echo "<div class='film-adi'>" . $kategoriler[$i][1][$j][0] . "</div>";
        echo "</div>";
    }

    echo "</div>";
    echo "</div>";
}
?>

</body>
</html>