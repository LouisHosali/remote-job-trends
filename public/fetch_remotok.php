<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<h2>DEBUG: fetch_remotok.php</h2>";

$url = "https://remoteok.com/api";
$targetFile = __DIR__ . '/sql/jobs.json';

echo "<p>📡 API URL: $url</p>";
echo "<p>📁 Ziel-Datei: $targetFile</p>";

// cURL starten
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

// Zeig an, was passiert ist
if ($err) {
    echo "<p style='color:red;'>❌ cURL Fehler: $err</p>";
    exit;
}

if (!$response) {
    echo "<p style='color:red;'>⚠️ Keine Antwort von RemoteOK erhalten (response leer)</p>";
    exit;
}

echo "<p style='color:green;'>✅ API hat geantwortet! Länge: " . strlen($response) . " Bytes</p>";

$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "<p style='color:red;'>❌ JSON Fehler: " . json_last_error_msg() . "</p>";
    exit;
}

$result = @file_put_contents($targetFile, json_encode($data, JSON_PRETTY_PRINT));
if ($result === false) {
    echo "<p style='color:red;'>❌ Datei konnte nicht gespeichert werden! Prüfe Schreibrechte für /sql/</p>";
    exit;
}

echo "<p style='color:green;'>✅ Erfolg! JSON gespeichert unter: $targetFile</p>";
?>