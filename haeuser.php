<?php
$pageTitle   = 'Unsere Ferienhäuser – Rügenurlaub mit Hund | Sanddorn, Weißdorn, Rotdorn';
$pageDesc    = 'Drei hundefreundliche Ferienhäuser in ruhiger Boddenlage im Nordwesten Rügens. Faktencheck pro Villa. Anfrage statt Sofortbuchung.';
$currentPage = 'haeuser.php';
$baseUrl     = rtrim(getenv('BASE_URL') ?: '', '/');
include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';

$villas = [
  [
    'key'     => 'sanddorn',
    'name'    => 'Villa Sanddorn',
    'thumb'   => '/assets/haeuser/thumbs/villa-sanddorn-boddenlage_640.jpg',
    'meta'    => ['164 m²', '6 Pers.', 'Hunde ✓', '1.262 m² Grundstück'],
    'desc'    => 'Großzügig, mit Wintergarten – für Tage, die nach draußen riechen und drinnen warm enden.',
    'href'    => '/villa-sanddorn.php',
  ],
  [
    'key'     => 'weissdorn',
    'name'    => 'Villa Weißdorn',
    'thumb'   => '/assets/haeuser/thumbs/villa-weissdorn-boddenlage_640.jpg',
    'meta'    => ['138 m²', '5 Pers.', 'Hunde ✓', 'Wintergarten'],
    'desc'    => 'Hell und entspannt – genau richtig, wenn Urlaub sich einfach leicht anfühlen soll.',
    'href'    => '/villa-weissdorn.php',
  ],
  [
    'key'     => 'rotdorn',
    'name'    => 'Villa Rotdorn',
    'thumb'   => '/assets/haeuser/thumbs/villa-rotdorn-boddenlage_640.jpg',
    'meta'    => ['134 m²', '6 Pers.', 'Hunde ✓', '3 Bäder'],
    'desc'    => 'Drei Bäder – null Stau. Ideal für Freunde, Familien, kleine Gruppen.',
    'href'    => '/villa-rotdorn.php',
  ],
];
?>

<section class="section">
  <div class="wrap">
    <div class="section-head">
      <h1 style="font-size:clamp(26px,3.5vw,40px);font-weight:900;letter-spacing:-.02em;color:var(--green);margin-bottom:10px">Unsere drei Villen</h1>
      <p>Kurz schauen, schnell fühlen: Welche Villa passt zu euch?</p>
    </div>
    <div class="grid-3">
      <?php foreach ($villas as $v): ?>
      <div class="card">
        <a href="<?= $baseUrl . $v['href'] ?>">
          <img src="<?= $baseUrl . $v['thumb'] ?>" alt="<?= htmlspecialchars($v['name'], ENT_QUOTES, 'UTF-8') ?>" class="card-img"
               onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
          <div class="card-img-placeholder" style="display:none">🏡</div>
        </a>
        <div class="card-body">
          <h3><?= htmlspecialchars($v['name'], ENT_QUOTES, 'UTF-8') ?></h3>
          <div class="card-meta">
            <?php foreach ($v['meta'] as $m): ?>
              <span class="card-meta-item"><?= htmlspecialchars($m, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endforeach ?>
          </div>
          <p><?= htmlspecialchars($v['desc'], ENT_QUOTES, 'UTF-8') ?></p>
          <div class="card-actions">
            <a href="<?= $baseUrl . $v['href'] ?>" class="btn btn-green" style="font-size:14px;padding:10px 18px">Details</a>
            <a href="<?= $baseUrl ?>/kontakt.php?villa=<?= urlencode($v['key']) ?>" class="btn" style="font-size:14px;padding:10px 18px;background:var(--accent-light);color:var(--accent);border:none">Anfragen</a>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/_inc/footer.php'; ?>
