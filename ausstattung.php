<?php
$pageTitle   = 'Ausstattung – Ferienhaus Rügen mit Hund';
$pageDesc    = 'Detaillierte Ausstattung aller drei Villen: Sanddorn, Weißdorn und Rotdorn.';
$currentPage = 'haeuser.php';
$baseUrl     = rtrim(getenv('BASE_URL') ?: '', '/');
include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';

$villas = [
  'sanddorn' => [
    'name'  => 'Villa Sanddorn',
    'color' => '#b45309',
    'items' => [
      'Wohnen'      => ['Offene Wohnküche', 'Kaminofen', 'Wintergarten', 'Esstisch für 6–8 Personen', 'SAT-TV', 'WLAN'],
      'Schlafen'    => ['3 Schlafzimmer', 'Doppelbett (Kingsize) im HZ', '2 × Einzelbetten in SZ 2/3'],
      'Bad'         => ['2 vollwertige Bäder', 'Dusche + Badewanne im HZ-Bad', 'Fußbodenheizung'],
      'Wellness'    => ['Infrarotsauna', 'Terrasse mit Loungemöbeln'],
      'Außen'       => ['Eingezäunter Gartenbereich', '1.262 m² Grundstück', '2 E-Bikes kostenlos', 'Carport', 'Wallbox (11 kW)'],
      'Küche'       => ['Vollausgestattete Küche', 'Geschirrspüler', 'Kaffeemaschine', 'Nespresso'],
      'Hund'        => ['Hunde willkommen', 'Hundebox vorhanden', 'Außendusche'],
    ],
  ],
  'weissdorn' => [
    'name'  => 'Villa Weißdorn',
    'color' => '#0f766e',
    'items' => [
      'Wohnen'      => ['Offene Wohnküche', 'Wintergarten', 'Esstisch für 5–6 Personen', 'SAT-TV', 'WLAN'],
      'Schlafen'    => ['2 Schlafzimmer', 'Doppelbett (Kingsize) im HZ', '2 Einzelbetten in SZ 2'],
      'Bad'         => ['2 vollwertige Bäder', 'Ebenerdige Dusche im HZ-Bad', 'Fußbodenheizung'],
      'Außen'       => ['Teileinzäuntes Grundstück', '844 m² Grundstück', '2 E-Bikes kostenlos', 'PV-Laden kostenlos (bei Sonnenschein)'],
      'Küche'       => ['Vollausgestattete Küche', 'Geschirrspüler', 'Kaffeemaschine'],
      'Hund'        => ['Hunde willkommen', 'Außendusche'],
    ],
  ],
  'rotdorn' => [
    'name'  => 'Villa Rotdorn',
    'color' => '#881337',
    'items' => [
      'Wohnen'      => ['Offene Wohnküche', 'Esstisch für 6–8 Personen', 'SAT-TV', 'WLAN'],
      'Schlafen'    => ['3 Schlafzimmer', 'Doppelbett (Kingsize) im HZ', '4 Einzelbetten in SZ 2/3'],
      'Bad'         => ['3 vollwertige Bäder', 'Ebenerdige Dusche in allen Bädern', 'Fußbodenheizung'],
      'Außen'       => ['Teileinzäuntes Grundstück', '824 m² Grundstück', '2 E-Bikes kostenlos', 'PV-Laden kostenlos (bei Sonnenschein)'],
      'Küche'       => ['Vollausgestattete Küche', 'Geschirrspüler', 'Kaffeemaschine'],
      'Hund'        => ['Hunde willkommen', 'Außendusche'],
    ],
  ],
];
?>

<section class="section">
  <div class="wrap-narrow">
    <h1 style="font-size:clamp(26px,4vw,40px);font-weight:900;color:var(--green);margin-bottom:8px">Ausstattung im Detail</h1>
    <p style="color:var(--soft);margin-bottom:40px">Alle drei Villen auf einen Blick.</p>

    <?php foreach ($villas as $key => $v): ?>
    <div id="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>" style="margin-bottom:40px;scroll-margin-top:80px">
      <h2 style="font-size:22px;font-weight:900;color:<?= htmlspecialchars($v['color'], ENT_QUOTES, 'UTF-8') ?>;border-left:4px solid <?= htmlspecialchars($v['color'], ENT_QUOTES, 'UTF-8') ?>;padding-left:14px;margin-bottom:20px">
        <?= htmlspecialchars($v['name'], ENT_QUOTES, 'UTF-8') ?>
      </h2>
      <div style="display:grid;gap:12px">
        <?php foreach ($v['items'] as $cat => $features): ?>
          <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-sm);padding:16px 18px">
            <strong style="display:block;font-size:13px;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:10px"><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></strong>
            <div style="display:flex;flex-wrap:wrap;gap:7px">
              <?php foreach ($features as $f): ?>
                <span class="chip"><?= htmlspecialchars($f, ENT_QUOTES, 'UTF-8') ?></span>
              <?php endforeach ?>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <div style="margin-top:16px">
        <a href="<?= $baseUrl ?>/kontakt.php?villa=<?= urlencode($key) ?>" class="btn btn-green" style="font-size:14px;padding:10px 20px"><?= htmlspecialchars($v['name'], ENT_QUOTES, 'UTF-8') ?> anfragen</a>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</section>

<?php include __DIR__ . '/_inc/footer.php'; ?>
