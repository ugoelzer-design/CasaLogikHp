<?php
/**
 * Angebot-Landingpage
 * URL: /angebot.php?villa=rotdorn&anreise=2026-07-05&abreise=2026-07-12&personen=2&hunde=1
 */

$baseUrl = rtrim(getenv('BASE_URL') ?: '', '/');

// ── URL-Parameter ────────────────────────────────────────────────
$villaKey  = preg_replace('/[^a-z]/', '', strtolower($_GET['villa']   ?? ''));
$anreise   = $_GET['anreise']  ?? '';
$abreise   = $_GET['abreise']  ?? '';
$personen  = max(1, (int)($_GET['personen'] ?? 2));
$hunde     = max(0, (int)($_GET['hunde']    ?? 0));

// ── Villa-Daten ──────────────────────────────────────────────────
$villas = [
  'sanddorn' => [
    'name'       => 'Villa Sanddorn',
    'tagline'    => 'Groß, warm, mit Kaminofen – für Tage, die nach draußen riechen.',
    'image'      => '/assets/haeuser/villa-sanddorn-main.jpg',
    'color'      => '#b45309',
    'gradient'   => 'linear-gradient(135deg,#b45309,#d97706)',
    'qm'         => '164 m²',
    'personen'   => 'bis 6 Pers.',
    'badge'      => 'Infrarotsauna · Kaminofen · Wintergarten',
    'highlights' => [
      '🌡️ Infrarotsauna im Haus',
      '🔥 Kaminofen im Wohnzimmer',
      '🌿 Wintergarten',
      '🚗 E-Auto-Wallbox (11 kW)',
      '🐾 Eingezäunter Garten',
      '🚲 2 E-Bikes kostenlos',
      '🛏 3 Schlafzimmer',
      '🚿 2 Bäder',
      '📶 WLAN',
    ],
    'usp' => [
      ['icon'=>'🌡️', 'title'=>'Infrarotsauna', 'text'=>'Im Haus, direkt verfügbar – ideal nach einem langen Strandtag.'],
      ['icon'=>'🔥', 'title'=>'Kaminofen',     'text'=>'Abends zusammen sitzen, das Feuer knistert – dafür kommt man nach Rügen.'],
      ['icon'=>'🐾', 'title'=>'Hunde & Garten', 'text'=>'Eingezäuntes Grundstück (1.262 m²) – dein Hund rennt frei, du entspannst.'],
    ],
    'why' => 'Sanddorn ist das Haus für alle, die Urlaub mit allen Sinnen mögen: Sauna, Kamin, großer Garten. Wenn abends das Feuer knistert, willst du nirgendwo anders sein.',
  ],
  'weissdorn' => [
    'name'       => 'Villa Weißdorn',
    'tagline'    => 'Hell, ruhig, entspannt – Urlaub der sich einfach leicht anfühlt.',
    'image'      => '/assets/haeuser/villa-weissdorn-main.jpg',
    'color'      => '#0f766e',
    'gradient'   => 'linear-gradient(135deg,#0f766e,#0d9488)',
    'qm'         => '138 m²',
    'personen'   => 'bis 5 Pers.',
    'badge'      => 'Wintergarten · PV-Laden kostenlos · E-Bikes',
    'highlights' => [
      '🌿 Wintergarten',
      '☀️ PV-Laden kostenlos (bei Sonnenschein)',
      '🚲 2 E-Bikes kostenlos',
      '🛏 2 Schlafzimmer',
      '🚿 2 Bäder (ebenerdig)',
      '🐾 Hunde willkommen',
      '📶 WLAN',
      '📏 Grundstück 844 m²',
    ],
    'usp' => [
      ['icon'=>'🌿', 'title'=>'Wintergarten',    'text'=>'Frühstücken mit Blick ins Grüne – auch wenn es draußen regnet.'],
      ['icon'=>'☀️', 'title'=>'Kostenlos laden', 'text'=>'E-Auto kostenlos laden (bei Sonnenschein) – nachhaltig ankommen.'],
      ['icon'=>'🚲', 'title'=>'E-Bikes',         'text'=>'Zwei E-Bikes inklusive – Rügen lässt sich am besten auf zwei Rädern erkunden.'],
    ],
    'why' => 'Weißdorn ist ideal für Paare oder kleine Familien, die einfach ankommen wollen. Kein Schnickschnack – nur Ruhe, Licht und das Gefühl, endlich Urlaub zu haben.',
  ],
  'rotdorn' => [
    'name'       => 'Villa Rotdorn',
    'tagline'    => 'Komfort-Plus: drei Bäder – damit der Tag entspannt startet.',
    'image'      => '/assets/haeuser/villa-rotdorn-main.jpg',
    'color'      => '#881337',
    'gradient'   => 'linear-gradient(135deg,#881337,#be123c)',
    'qm'         => '134 m²',
    'personen'   => 'bis 6 Pers.',
    'badge'      => '3 Bäder · PV-Laden kostenlos · E-Bikes',
    'highlights' => [
      '🚿 3 vollwertige Bäder',
      '☀️ PV-Laden kostenlos (bei Sonnenschein)',
      '🚲 2 E-Bikes kostenlos',
      '🛏 3 Schlafzimmer',
      '👥 bis 6 Gäste',
      '🐾 Hunde willkommen',
      '📶 WLAN',
      '📏 Grundstück 824 m²',
    ],
    'usp' => [
      ['icon'=>'🚿', 'title'=>'3 Bäder',        'text'=>'Kein Morgen-Stau. Jedes Zimmer fast mit eigenem Bad – Urlaub ohne Kompromisse.'],
      ['icon'=>'👨‍👩‍👧‍👦', 'title'=>'Ideal für Gruppen', 'text'=>'3 Schlafzimmer, 3 Bäder, Platz für 6 – perfekt für Familien oder Freundesgruppen.'],
      ['icon'=>'🐾', 'title'=>'Hund willkommen', 'text'=>'Außendusche, Teileinzäunung, hundefreundlich durch und durch.'],
    ],
    'why' => 'Rotdorn ist für Gäste, die Komfort mögen: drei Bäder, kurze Wege, entspannter Start in den Tag – unkompliziert mit Hund.',
  ],
];

$v = $villas[$villaKey] ?? null;

// ── Nächte berechnen ─────────────────────────────────────────────
$naechte = 0;
$anreiseFormatted = $anreise;
$abreiseFormatted = $abreise;
if ($anreise && $abreise) {
    try {
        $d1 = new DateTime($anreise);
        $d2 = new DateTime($abreise);
        $naechte = max(0, (int)$d1->diff($d2)->days);
        $anreiseFormatted = $d1->format('d.m.Y');
        $abreiseFormatted = $d2->format('d.m.Y');
    } catch (\Throwable) {}
}

// ── Kontakt-URL ──────────────────────────────────────────────────
$ctaParams = http_build_query(array_filter([
    'villa'   => $villaKey,
    'anreise' => $anreise,
    'abreise' => $abreise,
    'personen'=> $personen ?: null,
    'hunde'   => $hunde    ?: null,
]));
$ctaUrl = $baseUrl . '/kontakt.php?' . $ctaParams;

$pageTitle = ($v ? $v['name'] : 'Ihr Ferienhaus') . ' – Ferienhaus Rügen mit Hund';
$pageDesc  = $v ? $v['tagline'] : 'Ferienhaus auf Rügen anfragen.';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDesc, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="robots" content="noindex">
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/style.css">
  <style>
    /* Angebot-spezifische Overrides */
    body { background: var(--bg); }

    .angebot-hero {
      position: relative;
      min-height: 420px;
      display: flex;
      align-items: flex-end;
      overflow: hidden;
    }
    .angebot-hero-img {
      position: absolute; inset: 0;
      width: 100%; height: 100%;
      object-fit: cover;
    }
    .angebot-hero-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(0,0,0,.72) 0%, rgba(0,0,0,.2) 60%, transparent 100%);
    }
    .angebot-hero-content {
      position: relative; z-index: 2;
      width: 100%; padding: 40px 20px 36px;
      max-width: 760px; margin: 0 auto;
    }
    .angebot-hero-content h1 {
      font-size: clamp(28px, 5vw, 52px);
      font-weight: 900; color: #fff;
      margin-bottom: 10px; line-height: 1.15;
    }
    .angebot-hero-content p {
      font-size: clamp(15px, 2vw, 19px);
      color: rgba(255,255,255,.85); max-width: 520px;
    }

    .anfrage-card {
      background: #fff;
      border: 2px solid var(--accent);
      border-radius: var(--radius);
      padding: 24px 28px;
      position: sticky;
      top: 20px;
    }
    .anfrage-card .anfrage-zeile {
      display: flex; justify-content: space-between;
      align-items: center; gap: 8px;
      padding: 8px 0; border-bottom: 1px solid var(--border);
      font-size: 14px;
    }
    .anfrage-card .anfrage-zeile:last-of-type { border-bottom: none; }
    .anfrage-card .anfrage-label { color: var(--muted); }
    .anfrage-card .anfrage-val   { font-weight: 700; color: var(--text); }

    .usp-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px; margin: 32px 0;
    }
    .usp-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 20px;
    }
    .usp-card .usp-icon { font-size: 28px; margin-bottom: 10px; display: block; }
    .usp-card h3 { font-size: 16px; font-weight: 800; color: var(--green); margin-bottom: 6px; }
    .usp-card p  { font-size: 14px; color: var(--soft); line-height: 1.6; }

    .two-col {
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 40px; align-items: start;
    }
    @media(max-width: 768px) {
      .two-col { grid-template-columns: 1fr; }
      .anfrage-card { position: static; }
    }

    .mini-nav {
      background: var(--green);
      padding: 14px 20px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .mini-nav a { color: #fff; text-decoration: none; font-size: 14px; opacity: .8; }
    .mini-nav a:hover { opacity: 1; }
    .mini-nav .brand { font-weight: 800; font-size: 16px; color: #fff; opacity: 1; }
  </style>
</head>
<body>

<!-- Minimale Nav (kein Ablenkungsmenü) -->
<nav class="mini-nav">
  <a href="<?= $baseUrl ?>/" class="brand">Ferienhaus Rügen mit Hund</a>
  <a href="<?= $baseUrl ?>/haeuser.php">← Alle Villen</a>
</nav>

<?php if (!$v): ?>
<section class="section">
  <div class="wrap-narrow" style="text-align:center">
    <p style="color:var(--soft)">Villa nicht gefunden. <a href="<?= $baseUrl ?>/haeuser.php">Alle Villen ansehen</a></p>
  </div>
</section>
<?php else: ?>

<!-- Hero -->
<div class="angebot-hero">
  <?php if (file_exists(__DIR__ . $v['image'])): ?>
    <img src="<?= htmlspecialchars($baseUrl . $v['image'], ENT_QUOTES, 'UTF-8') ?>"
         alt="<?= htmlspecialchars($v['name'], ENT_QUOTES, 'UTF-8') ?>"
         class="angebot-hero-img">
  <?php else: ?>
    <div class="angebot-hero-img" style="background:<?= htmlspecialchars($v['gradient'], ENT_QUOTES, 'UTF-8') ?>"></div>
  <?php endif ?>
  <div class="angebot-hero-overlay"></div>
  <div class="angebot-hero-content">
    <h1><?= htmlspecialchars($v['name'], ENT_QUOTES, 'UTF-8') ?></h1>
    <p><?= htmlspecialchars($v['tagline'], ENT_QUOTES, 'UTF-8') ?></p>
  </div>
</div>

<section class="section">
  <div class="wrap" style="max-width:1100px;margin:0 auto;padding:0 20px">
    <div class="two-col">

      <!-- Linke Spalte: Inhalte -->
      <div>

        <!-- Badge -->
        <p style="color:var(--accent);font-weight:700;font-size:14px;margin-bottom:16px;letter-spacing:.04em">
          <?= htmlspecialchars($v['qm'], ENT_QUOTES, 'UTF-8') ?> &nbsp;·&nbsp;
          <?= htmlspecialchars($v['personen'], ENT_QUOTES, 'UTF-8') ?> &nbsp;·&nbsp;
          <?= htmlspecialchars($v['badge'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <!-- Warum dieses Haus -->
        <h2 style="font-size:clamp(20px,3vw,28px);font-weight:900;color:var(--green);margin-bottom:12px">
          Warum genau dieses Haus?
        </h2>
        <p style="font-size:17px;line-height:1.75;color:#374151;margin-bottom:28px">
          <?= htmlspecialchars($v['why'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <!-- USP-Cards -->
        <div class="usp-grid">
          <?php foreach ($v['usp'] as $usp): ?>
          <div class="usp-card">
            <span class="usp-icon"><?= $usp['icon'] ?></span>
            <h3><?= htmlspecialchars($usp['title'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p><?= htmlspecialchars($usp['text'], ENT_QUOTES, 'UTF-8') ?></p>
          </div>
          <?php endforeach ?>
        </div>

        <!-- Highlights -->
        <h3 style="font-size:16px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:12px">Ausstattung auf einen Blick</h3>
        <div class="features-wrap" style="margin-bottom:32px">
          <?php foreach ($v['highlights'] as $h): ?>
            <span class="chip"><?= htmlspecialchars($h, ENT_QUOTES, 'UTF-8') ?></span>
          <?php endforeach ?>
        </div>

        <!-- Vertrauens-Abschnitt -->
        <div style="background:var(--green-light);border:1px solid var(--border);border-radius:var(--radius);padding:20px 24px;margin-bottom:16px">
          <strong style="color:var(--green);display:block;margin-bottom:6px">Persönliche Vermietung – kein Konzern</strong>
          <p style="color:var(--soft);font-size:14px;line-height:1.6;margin:0">
            Wir vermieten unsere eigenen Häuser. Ihr schreibt uns direkt, bekommt ein ehrliches Angebot
            und habt während des Urlaubs eine echte Ansprechperson – keine anonyme Plattform.
          </p>
        </div>

      </div>

      <!-- Rechte Spalte: Anfrage-Card (sticky) -->
      <div>
        <div class="anfrage-card">
          <h3 style="font-size:18px;font-weight:900;color:var(--green);margin-bottom:16px">
            Dein Zeitraum
          </h3>

          <?php if ($anreise && $abreise): ?>
          <div class="anfrage-zeile">
            <span class="anfrage-label">Anreise</span>
            <span class="anfrage-val"><?= htmlspecialchars($anreiseFormatted, ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="anfrage-zeile">
            <span class="anfrage-label">Abreise</span>
            <span class="anfrage-val"><?= htmlspecialchars($abreiseFormatted, ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <?php if ($naechte > 0): ?>
          <div class="anfrage-zeile">
            <span class="anfrage-label">Nächte</span>
            <span class="anfrage-val"><?= $naechte ?></span>
          </div>
          <?php endif ?>
          <?php else: ?>
          <p style="font-size:14px;color:var(--muted);margin-bottom:12px">Noch kein Zeitraum gewählt – einfach im Anfrage-Formular eintragen.</p>
          <?php endif ?>

          <div class="anfrage-zeile">
            <span class="anfrage-label">Personen</span>
            <span class="anfrage-val"><?= $personen ?></span>
          </div>
          <?php if ($hunde > 0): ?>
          <div class="anfrage-zeile">
            <span class="anfrage-label">Hunde</span>
            <span class="anfrage-val"><?= $hunde ?></span>
          </div>
          <?php endif ?>

          <a href="<?= htmlspecialchars($ctaUrl, ENT_QUOTES, 'UTF-8') ?>"
             class="btn btn-primary"
             style="width:100%;text-align:center;margin-top:20px;font-size:16px;padding:14px">
            Jetzt unverbindlich anfragen
          </a>
          <p style="font-size:12px;color:var(--muted);text-align:center;margin-top:10px">
            Keine Sofortbuchung · Kein Risiko · Persönliche Antwort
          </p>
        </div>

        <!-- Social Proof -->
        <div style="margin-top:16px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:16px 18px">
          <p style="font-size:13px;color:var(--soft);line-height:1.6;margin:0">
            <strong style="color:var(--text)">🌟 Immer wieder gebucht</strong><br>
            Viele unserer Gäste kommen jedes Jahr wieder – das sagt mehr als jede Beschreibung.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php endif ?>

<footer style="background:var(--green);color:rgba(255,255,255,.7);text-align:center;padding:20px;font-size:13px;margin-top:40px">
  <a href="<?= $baseUrl ?>/impressum.php" style="color:rgba(255,255,255,.7);margin-right:16px">Impressum</a>
  <a href="<?= $baseUrl ?>/datenschutz.php" style="color:rgba(255,255,255,.7)">Datenschutz</a>
  <span style="display:block;margin-top:6px;font-size:12px">© <?= date('Y') ?> Ferienhaus Rügen mit Hund</span>
</footer>

</body>
</html>
