<?php
/**
 * Shared villa detail template
 * Set before including: $villa (array with all data)
 */
$baseUrl = rtrim(getenv('BASE_URL') ?: '', '/');

function vt_h(mixed $s): string { return htmlspecialchars((string)$s, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }
include __DIR__ . '/head.php';
include __DIR__ . '/nav.php';
?>

<div class="wrap-narrow" style="padding-top:20px">
  <a href="<?= $baseUrl ?>/haeuser.php" class="back-link">← Alle Villen</a>
</div>

<!-- Villa-Hero -->
<div class="villa-hero" style="min-height:360px">
  <?php if (!empty($villa['image'])): ?>
    <img src="<?= vt_h($baseUrl . $villa['image']) ?>" alt="<?= vt_h($villa['name']) ?>" class="villa-hero-img">
  <?php else: ?>
    <div class="villa-hero-img" style="background:linear-gradient(135deg,<?= vt_h($villa['color_from'] ?? '#1a3a2a') ?>,<?= vt_h($villa['color_to'] ?? '#3d7a58') ?>)"></div>
  <?php endif ?>
  <div class="villa-hero-overlay"></div>
  <div class="villa-hero-content">
    <div class="wrap-narrow">
      <h1><?= vt_h($villa['name']) ?></h1>
      <p><?= vt_h($villa['tagline']) ?></p>
    </div>
  </div>
</div>

<div class="section">
  <div class="wrap-narrow">

    <!-- Facts -->
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px;margin-bottom:28px">
      <h2 style="font-size:15px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:14px">Faktencheck</h2>
      <div class="features-wrap">
        <?php foreach ($villa['features'] as $f): ?>
          <span class="chip"><?= vt_h($f) ?></span>
        <?php endforeach ?>
      </div>
    </div>

    <!-- Warum -->
    <div style="margin-bottom:28px">
      <h2 style="font-size:22px;font-weight:800;color:var(--green);margin-bottom:12px">Warum genau dieses Haus?</h2>
      <p style="font-size:17px;line-height:1.7;color:#374151"><?= vt_h($villa['why']) ?></p>
    </div>

    <!-- CTA -->
    <div style="background:var(--green-light);border:1px solid var(--border);border-radius:var(--radius);padding:28px;text-align:center">
      <p style="font-size:16px;color:var(--soft);margin-bottom:18px">Klingt gut? Einfach unverbindlich anfragen.</p>
      <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
        <a href="<?= $baseUrl ?>/kontakt.php?villa=<?= urlencode($villa['key']) ?>" class="btn btn-primary">Unverbindlich anfragen</a>
        <a href="<?= $baseUrl ?>/ausstattung.php#<?= urlencode($villa['key']) ?>" class="btn" style="background:var(--white);border:1.5px solid var(--border);color:var(--text)">Ausstattung im Detail</a>
      </div>
    </div>

  </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
