<?php
$pageTitle   = 'Ferienhaus Rügen mit Hund – ruhige Boddenlage | 3 Villen';
$pageDesc    = 'Ankommen, durchatmen, bleiben: hundefreundliche Ferienhäuser auf Rügen in ruhiger Boddenlage. 3 Villen – unverbindlich anfragen.';
$currentPage = 'index.php';
include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';
$baseUrl = rtrim(getenv('BASE_URL') ?: '', '/');
?>

<!-- Hero -->
<div class="hero">
  <div class="hero-inner wrap-narrow">
    <div class="hero-badge">🌊 Nordwesten Rügens</div>
    <h1>Urlaub, der sich leicht anfühlt.</h1>
    <p class="hero-lead">Ruhige Boddenlage im Nordwesten Rügens. Viel Platz für euch – und für deinen Hund. <strong style="color:#fff">Ohne Sofortbuchung</strong>: erst anfragen, dann in Ruhe entscheiden.</p>
    <div class="hero-tags">
      <span class="hero-tag">🐶 Hunde willkommen</span>
      <span class="hero-tag">👨‍👩‍👧‍👦 5–6 Personen</span>
      <span class="hero-tag">🌿 Große Grundstücke</span>
      <span class="hero-tag">🏡 3 Villen</span>
    </div>
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?= $baseUrl ?>/kontakt.php" class="btn btn-primary">Verfügbarkeit anfragen</a>
      <a href="<?= $baseUrl ?>/haeuser.php" class="btn btn-outline">Villen ansehen</a>
    </div>
  </div>
</div>

<!-- Villen -->
<section class="section">
  <div class="wrap">
    <div class="section-head">
      <h2>Unsere drei Villen</h2>
      <p>Kurz schauen, schnell fühlen – welche passt zu euch?</p>
    </div>
    <div class="grid-3">

      <!-- Sanddorn -->
      <div class="card">
        <?php $img = $baseUrl . '/assets/haeuser/thumbs/villa-sanddorn-boddenlage_640.jpg'; ?>
        <img src="<?= $img ?>" alt="Villa Sanddorn" class="card-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
        <div class="card-img-placeholder" style="display:none">🏡</div>
        <div class="card-body">
          <h3>Villa Sanddorn</h3>
          <div class="card-meta">
            <span class="card-meta-item">164 m²</span>
            <span class="card-meta-item">bis 6 Pers.</span>
            <span class="card-meta-item">Hunde ✓</span>
            <span class="card-meta-item">Sauna</span>
          </div>
          <p>Großzügig, mit Wintergarten – für Tage, die nach draußen riechen und drinnen warm enden.</p>
          <div class="card-actions">
            <a href="<?= $baseUrl ?>/villa-sanddorn.php" class="btn btn-green" style="font-size:14px;padding:10px 18px">Details</a>
            <a href="<?= $baseUrl ?>/kontakt.php?villa=sanddorn" class="btn" style="font-size:14px;padding:10px 18px;background:var(--accent-light);color:var(--accent);border:none">Anfragen</a>
          </div>
        </div>
      </div>

      <!-- Weißdorn -->
      <div class="card">
        <?php $img = $baseUrl . '/assets/haeuser/thumbs/villa-weissdorn-boddenlage_640.jpg'; ?>
        <img src="<?= $img ?>" alt="Villa Weißdorn" class="card-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
        <div class="card-img-placeholder" style="display:none">🏡</div>
        <div class="card-body">
          <h3>Villa Weißdorn</h3>
          <div class="card-meta">
            <span class="card-meta-item">138 m²</span>
            <span class="card-meta-item">bis 5 Pers.</span>
            <span class="card-meta-item">Hunde ✓</span>
            <span class="card-meta-item">Wintergarten</span>
          </div>
          <p>Hell und entspannt – genau richtig, wenn Urlaub sich einfach leicht anfühlen soll.</p>
          <div class="card-actions">
            <a href="<?= $baseUrl ?>/villa-weissdorn.php" class="btn btn-green" style="font-size:14px;padding:10px 18px">Details</a>
            <a href="<?= $baseUrl ?>/kontakt.php?villa=weissdorn" class="btn" style="font-size:14px;padding:10px 18px;background:var(--accent-light);color:var(--accent);border:none">Anfragen</a>
          </div>
        </div>
      </div>

      <!-- Rotdorn -->
      <div class="card">
        <?php $img = $baseUrl . '/assets/haeuser/thumbs/villa-rotdorn-boddenlage_640.jpg'; ?>
        <img src="<?= $img ?>" alt="Villa Rotdorn" class="card-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
        <div class="card-img-placeholder" style="display:none">🏡</div>
        <div class="card-body">
          <h3>Villa Rotdorn</h3>
          <div class="card-meta">
            <span class="card-meta-item">134 m²</span>
            <span class="card-meta-item">bis 6 Pers.</span>
            <span class="card-meta-item">Hunde ✓</span>
            <span class="card-meta-item">3 Bäder</span>
          </div>
          <p>Drei Bäder – null Stau. Ideal für Freunde, Familien, kleine Gruppen.</p>
          <div class="card-actions">
            <a href="<?= $baseUrl ?>/villa-rotdorn.php" class="btn btn-green" style="font-size:14px;padding:10px 18px">Details</a>
            <a href="<?= $baseUrl ?>/kontakt.php?villa=rotdorn" class="btn" style="font-size:14px;padding:10px 18px;background:var(--accent-light);color:var(--accent);border:none">Anfragen</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Warum direkt buchen -->
<section class="section-sm" style="background:var(--surface);border-top:1px solid var(--border);border-bottom:1px solid var(--border)">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;text-align:center">
      <div style="padding:20px">
        <div style="font-size:32px;margin-bottom:10px">🐾</div>
        <strong style="display:block;margin-bottom:6px;color:var(--green)">Hunde willkommen</strong>
        <p style="color:var(--soft);font-size:14px">Alle drei Villen – keine Ausnahme.</p>
      </div>
      <div style="padding:20px">
        <div style="font-size:32px;margin-bottom:10px">✉️</div>
        <strong style="display:block;margin-bottom:6px;color:var(--green)">Anfrage statt Sofortbuchung</strong>
        <p style="color:var(--soft);font-size:14px">Persönlicher Kontakt, individuelles Angebot.</p>
      </div>
      <div style="padding:20px">
        <div style="font-size:32px;margin-bottom:10px">🌿</div>
        <strong style="display:block;margin-bottom:6px;color:var(--green)">Ruhige Boddenlage</strong>
        <p style="color:var(--soft);font-size:14px">Nordwesten Rügens – große Grundstücke, wenig Trubel.</p>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/_inc/footer.php'; ?>
