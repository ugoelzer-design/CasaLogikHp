<?php
$pageTitle   = 'Villa Sanddorn – Ferienhaus auf Rügen';
$pageDesc    = 'Villa Sanddorn: ruhiges, hochwertiges Ferienhaus auf Rügen – ideal mit Hund. Infrarotsauna, Wintergarten, bis 6 Gäste.';
$currentPage = 'haeuser.php';

$villa = [
  'key'        => 'sanddorn',
  'name'       => 'Villa Sanddorn',
  'tagline'    => 'Ruhig. Hochwertig. Ideal für entspannte Tage mit Hund – ohne Kompromisse.',
  'image'      => '/assets/haeuser/villa-sanddorn-main.jpg',
  'color_from' => '#b45309',
  'color_to'   => '#d97706',
  'features'   => [
    '🏡 Ruhige Lage am Naturschutzgebiet',
    '📐 164 m²',
    '👥 bis 6 Gäste',
    '🛏 3 Schlafzimmer',
    '🚿 2 Bäder',
    '🧖 Infrarotsauna',
    '🌱 Wintergarten',
    '📶 WLAN',
    '🐾 Hunde willkommen',
    '🚲 2 E-Bikes kostenlos',
    '🌿 Teileinzäunung',
    '⚡ Wallbox',
    '🚗 Carport',
    '📏 Grundstück 1.262 m²',
  ],
  'why' => 'Villa Sanddorn ist für Gäste gedacht, die schnell wissen wollen: passt es – ja oder nein. Viel Licht, ruhige Atmosphäre, hochwertige Ausstattung und ein unkomplizierter Alltag mit Hund.',
];

include __DIR__ . '/_inc/villa-template.php';
