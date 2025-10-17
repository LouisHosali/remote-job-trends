<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 10;
$path  = __DIR__ . '/../sql/jobs.json';
if (!is_readable($path)) {
  http_response_code(500);
  echo json_encode(['error' => 'jobs.json not readable']);
  exit;
}

$raw = json_decode(file_get_contents($path), true);
$jobs = is_array($raw) ? array_filter($raw, fn($x)=> isset($x['id'])) : ($raw['jobs'] ?? []);
$counts = [];

foreach ($jobs as $j) {
  if (!empty($j['tags']) && is_array($j['tags'])) {
    foreach ($j['tags'] as $t) {
      $tag = trim(mb_strtolower($t));
      if ($tag === '') continue;
      $counts[$tag] = ($counts[$tag] ?? 0) + 1;
    }
  }
}

arsort($counts);
$out = [];
foreach (array_slice($counts, 0, $limit, true) as $tag => $c) {
  $out[] = ['tag' => $tag, 'c' => $c];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($out);