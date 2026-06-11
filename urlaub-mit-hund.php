<?php
$pageTitle   = 'Urlaub mit Hund auf Rügen – ruhige Boddenlage | Ferienhäuser anfragen';
$pageDesc    = 'Hundefreundliche Ferienhäuser auf Rügen in ruhiger Boddenlage. Viel Platz, große Grundstücke – jetzt anfragen.';
$currentPage = 'urlaub-mit-hund.php';
$baseUrl     = rtrim(getenv('BASE_URL') ?: '', '/');
include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';
?>

<div class="hero" style="padding:56px 20px 64px">
  <div class="hero-inner wrap-narrow">
    <div class="hero-badge">🐾 Hunde willkommen</div>
    <h1>Urlaub mit Hund auf Rügen</h1>
    <p class="hero-lead">Manchmal braucht es nicht viel: frische Luft, Weite – und den Hund an der Seite.</p>
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?= $baseUrl ?>/kontakt.php" class="btn btn-primary">Verfügbarkeit anfragen</a>
      <a href="<?= $baseUrl ?>/haeuser.php" class="btn btn-outline">Zu den Villen</a>
    </div>
  </div>
</div>

<section class="section">
  <div class="wrap-narrow">
    <div class="grid-2" style="gap:20px;margin-bottom:40px">
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:28px">
        <div style="font-size:36px;margin-bottom:12px">🐶</div>
        <h3 style="font-size:18px;font-weight:800;color:var(--green);margin-bottom:8px">Alle drei Villen</h3>
        <p style="color:var(--soft);font-size:15px">Keine Ausnahme – alle Häuser sind hundefreundlich.</p>
      </div>
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:28px">
        <div style="font-size:36px;margin-bottom:12px">🌿</div>
        <h3 style="font-size:18px;font-weight:800;color:var(--green);margin-bottom:8px">Große Grundstücke</h3>
        <p style="color:var(--soft);font-size:15px">Zwischen 824 und 1.262 m² – Platz für Hund und Mensch.</p>
      </div>
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:28px">
        <div style="font-size:36px;margin-bottom:12px">🌊</div>
        <h3 style="font-size:18px;font-weight:800;color:var(--green);margin-bottom:8px">Ruhige Boddenlage</h3>
        <p style="color:var(--soft);font-size:15px">Nordwesten Rügens – weitläufig, wenig Trubel, ideal zum Spazieren.</p>
      </div>
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:28px">
        <div style="font-size:36px;margin-bottom:12px">✉️</div>
        <h3 style="font-size:18px;font-weight:800;color:var(--green);margin-bottom:8px">Anfrage statt Sofortbuchung</h3>
        <p style="color:var(--soft);font-size:15px">Anzahl Hunde, Rasse, Wünsche – wir klären das persönlich.</p>
      </div>
    </div>

    <div style="background:var(--green-light);border:1px solid var(--border);border-radius:var(--radius);padding:28px;text-align:center">
      <h2 style="font-size:22px;font-weight:800;color:var(--green);margin-bottom:10px">So einfach geht's</h2>
      <p style="color:var(--soft);margin-bottom:20px">Anreise, Abreise, Personen, Hunde angeben – wir melden uns mit freien Terminen und Preis.</p>
      <a href="<?= $baseUrl ?>/kontakt.php" class="btn btn-primary">Jetzt anfragen</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/_inc/footer.php'; ?>
