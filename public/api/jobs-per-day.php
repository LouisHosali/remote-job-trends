<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = __DIR__ . '/../sql/jobs.json';
if (!is_readable($path)) {
  http_response_code(500);
  echo json_encode(['error' => 'jobs.json not readable']);
  exit;
}

$raw = json_decode(file_get_contents($path), true);
$jobs = is_array($raw) ? array_filter($raw, fn($x)=> isset($x['id'])) : ($raw['jobs'] ?? []);

$bucket = []; // key = date, value = count
foreach ($jobs as $j) {
  if (!empty($j['date'])) {
    $d = substr($j['date'], 0, 10); // "YYYY-MM-DD"
  } elseif (!empty($j['epoch'])) {
    $d = date('Y-m-d', intval($j['epoch']));
  } else continue;
  
  $bucket[$d] = ($bucket[$d] ?? 0) + 1;
}

ksort($bucket);
$out = [];
foreach ($bucket as $d => $c) {
  $out[] = ['d' => $d, 'c' => $c];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($out);