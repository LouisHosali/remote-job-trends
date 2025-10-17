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

$roles = ['dev' => 0, 'design' => 0, 'data' => 0, 'pm' => 0, 'other' => 0];
foreach ($jobs as $j) {
  $title = strtolower($j['position'] ?? '');
  if (str_contains($title, 'developer') || str_contains($title, 'engineer') || str_contains($title, 'frontend') || str_contains($title, 'backend')) {
    $roles['dev']++;
  } elseif (str_contains($title, 'design')) {
    $roles['design']++;
  } elseif (str_contains($title, 'data') || str_contains($title, 'analyst') || str_contains($title, 'ai')) {
    $roles['data']++;
  } elseif (str_contains($title, 'manager') || str_contains($title, 'product')) {
    $roles['pm']++;
  } else {
    $roles['other']++;
  }
}

$out = [];
foreach ($roles as $role => $c) {
  $out[] = ['role' => $role, 'c' => $c];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($out);