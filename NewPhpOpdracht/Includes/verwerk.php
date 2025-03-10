<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Naam validatie (verplicht, minimaal 3 tekens)
    if (empty($_POST["Name"]) || strlen(trim($_POST["Name"])) < 3) {
        $errors[] = "Naam is verplicht en moet minimaal 3 tekens lang zijn.";
    } else {
        $naam = htmlspecialchars(trim($_POST["Name"]));
    }

    // E-mail validatie (verplicht, geldig e-mailadres)
    if (empty($_POST["mail"]) || !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Een geldig e-mailadres is verplicht.";
    } else {
        $email = htmlspecialchars(trim($_POST["mail"]));
    }

    // Leeftijd validatie (verplicht, moet een getal zijn)
    if (empty($_POST["age"]) || !is_numeric($_POST["age"]) || $_POST["age"] < 1) {
        $errors[] = "Leeftijd is verplicht en moet een geldig getal zijn.";
    } else {
        $leeftijd = intval($_POST["age"]);
    }

    // Wachtwoord validatie (verplicht, minimaal 6 tekens)
    if (empty($_POST["Password"]) || strlen($_POST["Password"]) < 6) {
        $errors[] = "Wachtwoord is verplicht en moet minimaal 6 tekens lang zijn.";
    } else {
        $wachtwoord = password_hash($_POST["Password"], PASSWORD_DEFAULT); // Veilig opslaan
    }

    // Controleer of er fouten zijn
    if (!empty($errors)) {
        echo "<h2>Fouten gevonden:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo '<a href="../index.html">Terug naar het formulier</a>';
    } else {
        // Als alles correct is, toon succesbericht
        echo "<h2>Formulier succesvol verwerkt!</h2>";
        echo "<p><strong>Naam:</strong> " . $naam . "</p>";
        echo "<p><strong>E-mail:</strong> " . $email . "</p>";
        echo "<p><strong>Leeftijd:</strong> " . $leeftijd . "</p>";
        echo "<p>Je wachtwoord is opgeslagen (versleuteld).</p>";
    }
}
?>