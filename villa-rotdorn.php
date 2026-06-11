<?php
$pageTitle   = 'Villa Rotdorn – Ferienhaus auf Rügen';
$pageDesc    = 'Villa Rotdorn: Komfort-Plus mit drei Bädern, ruhige Boddenlage, hundefreundlich, bis 6 Gäste.';
$currentPage = 'haeuser.php';

$villa = [
  'key'        => 'rotdorn',
  'name'       => 'Villa Rotdorn',
  'tagline'    => 'Komfort-Plus: drei Bäder – damit der Tag entspannt startet.',
  'image'      => '/assets/haeuser/villa-rotdorn-main.jpg',
  'color_from' => '#881337',
  'color_to'   => '#be123c',
  'features'   => [
    '🌊 Ruhige Boddenlage',
    '📐 134 m²',
    '👥 bis 6 Gäste',
    '🛏 3 Schlafzimmer',
    '🚿 3 Bäder',
    '📶 WLAN',
    '🐾 Hunde willkommen',
    '🚲 2 E-Bikes kostenlos',
    '🌿 Teileinzäunung',
    '☀️ PV Laden kostenlos (bei Sonnenschein)',
    '📏 Grundstück 824 m²',
  ],
  'why' => 'Villa Rotdorn ist für Gäste gedacht, die Komfort mögen: drei Bäder, kurze Wege, entspannter Start in den Tag – und unkompliziert mit Hund.',
];

include __DIR__ . '/_inc/villa-template.php';
