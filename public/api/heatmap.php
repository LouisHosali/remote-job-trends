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

$bucket = []; // key "dow-h" => count
foreach ($jobs as $j) {
  // RemoteOK hat i.d.R. "date" (ISO) und "epoch"
  $ts = null;
  if (!empty($j['epoch']) && is_numeric($j['epoch'])) {
    $ts = intval($j['epoch']);
  } elseif (!empty($j['date'])) {
    $ts = strtotime($j['date']);
  }
  if (!$ts) continue;

  $dow = intval(date('w', $ts));   // 0=So … 6=Sa
  $h   = intval(date('G', $ts));   // 0…23
  $key = $dow . '-' . $h;
  $bucket[$key] = ($bucket[$key] ?? 0) + 1;
}

$out = [];
foreach ($bucket as $key => $c) {
  [$dow,$h] = array_map('intval', explode('-', $key));
  $out[] = ['dow' => $dow, 'h' => $h, 'c' => $c];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($out);