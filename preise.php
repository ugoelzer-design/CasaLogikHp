<?php
$pageTitle   = 'Preise – Ferienhaus Rügen mit Hund';
$pageDesc    = 'Preisübersicht für unsere hundefreundlichen Ferienhäuser auf Rügen. Saisonzeiten, Nebenkosten und Hinweise transparent erklärt.';
$currentPage = 'preise.php';
$baseUrl     = rtrim(getenv('BASE_URL') ?: '', '/');
include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';
?>

<section class="section">
  <div class="wrap-narrow">
    <h1 style="font-size:clamp(26px,4vw,40px);font-weight:900;color:var(--green);margin-bottom:8px">Preise</h1>
    <p style="color:var(--soft);font-size:17px;margin-bottom:36px">
      Unsere Ferienhäuser werden bewusst <strong>nicht online gebucht</strong>.<br>
      Die Preise richten sich nach Saison, Aufenthaltsdauer und Personenzahl.
    </p>

    <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:28px;margin-bottom:20px">
      <h2 style="font-size:18px;font-weight:800;color:var(--green);margin-bottom:16px">Preisstruktur</h2>
      <div style="display:grid;gap:12px">
        <?php foreach ([
          ['💰', 'Grundpreis pro Haus und Nacht', 'Saisonabhängig – Hauptsaison, Nebensaison, Kurzurlaub.'],
          ['🧹', 'Endreinigung', 'Pauschal pro Aufenthalt – wird im Angebot ausgewiesen.'],
          ['🐾', 'Hunde-Zuschlag', 'Kleiner Aufschlag pro Hund – transparent im Angebot.'],
          ['👥', 'Personenzahl', 'Basispreis für die Mindestbelegung; Zuschlag ab Personen je nach Villa.'],
        ] as [$icon, $title, $text]): ?>
          <div style="display:flex;gap:14px;align-items:flex-start;padding:14px;background:var(--bg);border-radius:var(--radius-sm)">
            <span style="font-size:22px;flex:0 0 auto"><?= $icon ?></span>
            <div>
              <strong style="display:block;color:var(--green);margin-bottom:3px"><?= $title ?></strong>
              <span style="color:var(--soft);font-size:14px"><?= $text ?></span>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>

    <div style="background:var(--green-light);border:1px solid var(--border);border-radius:var(--radius);padding:24px;margin-bottom:32px">
      <strong style="color:var(--green)">Hinweis:</strong>
      <span style="color:var(--soft);font-size:15px"> In bestimmten Saisonzeiten gelten feste An- und Abreisetage sowie Mindestaufenthalte. Diese Details teilen wir transparent im individuellen Angebot mit.</span>
    </div>

    <div style="text-align:center">
      <p style="color:var(--soft);margin-bottom:16px">Konkreten Preis für Ihren Zeitraum anfragen:</p>
      <a href="<?= $baseUrl ?>/kontakt.php" class="btn btn-primary">Unverbindlich anfragen</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/_inc/footer.php'; ?>
