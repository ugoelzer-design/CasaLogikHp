<?php
$pageTitle = 'Impressum';
$currentPage = '';
$baseUrl = rtrim(getenv('BASE_URL') ?: '', '/');
include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';
?>
<section class="section">
  <div class="wrap-narrow">
    <h1 style="font-size:28px;font-weight:900;color:var(--green);margin-bottom:24px">Impressum</h1>
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:28px;line-height:1.8;color:var(--soft)">
      <p><strong style="color:var(--text)">Angaben gemäß § 5 TMG</strong></p>
      <p style="margin-top:12px">Gerald Udo Gölzer<br>Friedrich-Ebert-Straße 9<br>69207 Sandhausen<br>Deutschland</p>
      <p style="margin-top:16px"><strong style="color:var(--text)">Kontakt</strong><br>
      Telefon: +49 176 55018740<br>
      E-Mail: u.goelzer@outlook.de</p>
      <p style="margin-top:16px">Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV: Gerald Udo Gölzer</p>
    </div>
  </div>
</section>
<?php include __DIR__ . '/_inc/footer.php'; ?>
