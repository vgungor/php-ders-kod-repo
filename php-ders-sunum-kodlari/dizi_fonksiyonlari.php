
<!DOCTYPE html>
<html>
<head>
    <style>
        ol li::marker {
            font-weight: bold;
            font-style: italic;
        }
        ol li h3 {
            color: blue;
        }
    </style>
</head>
<body>
    <ol>
        <li>
            <h3> count() – Dizi Eleman Sayısını Bulma </h3>
            <?php   
            $meyveler = ["Elma", "Armut", "Muz", "Kiraz"];
            echo "Dizi boyutu: " . count($meyveler);
            ?>
        </li>
        <li>
            <h3> array_push() – Dizi Sonuna Eleman Ekleme </h3>
            <?php   
            $meyveler = ["Elma", "Armut", "Muz", "Kiraz"];
            array_push($meyveler, "Ceviz");
            echo "Yeni dizi boyutu: " . count($meyveler);
            ?>
            <pre>
            <?php
            print_r($meyveler);
            ?>
            </pre>
        </li>
        <li>
            <h3> array_pop() – Dizi Sonundan Eleman Çıkarma </h3>
            <?php   
            $meyveler = ["Elma", "Armut", "Muz", "Kiraz"];
            $sonEleman = array_pop($meyveler);
            echo "Çıkarılan eleman: " . $sonEleman;
            ?>
            <pre>
            <?php
            print_r($meyveler);
            ?>
            </pre>
        </li>
         <li>
            <h3> array_shift() – Dizi Başından Eleman Çıkarma </h3>
            <?php   
            $meyveler = ["Elma", "Armut", "Muz", "Kiraz"];
            $ilkEleman = array_shift($meyveler);
            echo "Çıkarılan eleman: " . $ilkEleman;
            ?>
            <pre>
            <?php
            print_r($meyveler);
            ?>
            </pre>
        </li>
         <li>
            <h3> array_unshift() – Dizi Başına Eleman Ekleme </h3>
            <?php   
            $meyveler = ["Elma", "Armut", "Muz", "Kiraz"];
            array_unshift($meyveler, "Çilek");
            echo "Yeni dizi boyutu: " . count($meyveler);
            ?>
            <pre>
            <?php
            print_r($meyveler);
            ?>
            </pre>  
        </li>
        <li>
            <h3> array_merge() – İki veya Daha Fazla Diziyi Birleştirme </h3>
            <?php   
            $meyveler1 = ["Elma", "Armut"];
            $meyveler2 = ["Muz", "Kiraz"];
            $birlesikDizi = array_merge($meyveler1, $meyveler2);
            echo "Birleşik dizi boyutu: " . count($birlesikDizi);
            ?>
            <pre>
            <?php
            print_r($birlesikDizi);
            ?>
            </pre>
        </li>
         
    </ol>


</body>
</html>