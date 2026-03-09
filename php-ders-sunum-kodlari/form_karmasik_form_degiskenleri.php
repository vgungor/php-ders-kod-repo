<?php
if ($_POST) {
    echo '<pre>';
    echo htmlspecialchars(print_r($_POST, true));
    echo '</pre>';
}
?>
<form action="" method="post">
    Adı:  <input type="text" name="personal[isim]" /><br />
    Eposta: <input type="text" name="personal[eposta]" /><br />
    Bira: <br />
    <select multiple name="bira[]">
        <option value="efes">Efes</option>
        <option value="tuborg">Tuborg</option>
        <option value="venus">Venüs</option>
    </select><br />
    <input type="submit" value="Gönder!" />
</form>