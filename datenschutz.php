<?php
$pageTitle = 'Datenschutzerklärung';
$currentPage = '';
$baseUrl = rtrim(getenv('BASE_URL') ?: '', '/');
include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';
?>
<section class="section">
  <div class="wrap-narrow">
    <h1 style="font-size:28px;font-weight:900;color:var(--green);margin-bottom:6px">Datenschutzerklärung</h1>
    <p style="color:var(--muted);font-size:13px;margin-bottom:28px">Stand: 2026-01-08</p>
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:28px;line-height:1.8;color:var(--soft);display:grid;gap:20px">
      <div>
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:6px">1. Verantwortlicher</h2>
        <p>Gerald Udo Gölzer, Friedrich-Ebert-Straße 9, 69207 Sandhausen<br>E-Mail: u.goelzer@outlook.de</p>
      </div>
      <div>
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:6px">2. Hosting</h2>
        <p>Zum Betrieb der Website verarbeitet unser Hosting-Anbieter Server-Logfiles (z. B. IP-Adresse, Zeit, Seite). Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO.</p>
      </div>
      <div>
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:6px">3. Anfrageformular</h2>
        <p>Wir verarbeiten deine Angaben zur Bearbeitung der Anfrage (Art. 6 Abs. 1 lit. b DSGVO). Daten werden nicht an Dritte weitergegeben.</p>
      </div>
      <div>
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:6px">4. Google Analytics 4 – nur nach Einwilligung</h2>
        <p>GA4 wird erst nach Zustimmung im Cookie-Banner geladen (Art. 6 Abs. 1 lit. a DSGVO). Ohne Zustimmung findet kein Tracking statt. IP-Anonymisierung ist aktiviert.</p>
      </div>
      <div>
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:6px">5. Rechte</h2>
        <p>Auskunft, Berichtigung, Löschung, Einschränkung, Datenübertragbarkeit, Widerspruch sowie Beschwerde bei einer Aufsichtsbehörde.</p>
      </div>
    </div>
  </div>
</section>
<?php include __DIR__ . '/_inc/footer.php'; ?>
