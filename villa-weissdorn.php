<?php
$pageTitle   = 'Villa Weißdorn – Ferienhaus auf Rügen';
$pageDesc    = 'Villa Weißdorn: hell, entspannt, hundefreundlich – ruhige Boddenlage, Wintergarten, bis 5 Gäste.';
$currentPage = 'haeuser.php';

$villa = [
  'key'        => 'weissdorn',
  'name'       => 'Villa Weißdorn',
  'tagline'    => 'Ein Haus, das dich runterholt: Licht, Ruhe, Boddenluft. Du kommst an – und der Rest darf warten.',
  'image'      => '/assets/haeuser/villa-weissdorn-main.jpg',
  'color_from' => '#0f766e',
  'color_to'   => '#0d9488',
  'features'   => [
    '🌊 Ruhige Boddenlage',
    '📐 138 m²',
    '👥 bis 5 Gäste',
    '🛏 2 Schlafzimmer',
    '🚿 2 Bäder',
    '🌱 Wintergarten',
    '📶 WLAN',
    '🐾 Hunde willkommen',
    '🚲 2 E-Bikes kostenlos',
    '🌿 Teileinzäunung',
    '☀️ PV Laden kostenlos (bei Sonnenschein)',
    '📏 Grundstück 844 m²',
  ],
  'why' => 'Villa Weißdorn ist ideal für 2–5 Personen: ruhig gelegen, viel Licht, Wintergarten – und unkompliziert mit Hund.',
];

include __DIR__ . '/_inc/villa-template.php';
