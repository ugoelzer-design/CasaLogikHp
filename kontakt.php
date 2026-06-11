<?php
declare(strict_types=1);

$pageTitle   = 'Verfügbarkeit anfragen – Ferienhaus Rügen mit Hund';
$pageDesc    = 'Unverbindliche Anfrage: Zeitraum, Personen, Hunde. Wir melden uns mit freien Terminen & Angebot.';
$currentPage = 'kontakt.php';
$baseUrl     = rtrim(getenv('BASE_URL') ?: '', '/');

/* ── Konfiguration (via Env-Vars) ── */
$notifyEmail = getenv('NOTIFY_EMAIL') ?: 'u.goelzer@gmx.de';
$smtpHost    = getenv('SMTP_HOST')    ?: '';
$smtpUser    = getenv('SMTP_USER')    ?: '';
$smtpPass    = getenv('SMTP_PASS')    ?: '';
$smtpPort    = (int)(getenv('SMTP_PORT') ?: 587);
$fromEmail   = getenv('FROM_EMAIL')   ?: $notifyEmail;
$fromName    = getenv('FROM_NAME')    ?: 'Ferienhaus Rügen mit Hund';

$villas = [
  'sanddorn'  => 'Villa Sanddorn',
  'weissdorn' => 'Villa Weißdorn',
  'rotdorn'   => 'Villa Rotdorn',
];

$success = false;
$errors  = [];
$values  = [];

/* ── POST-Verarbeitung ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Rate-Limit: 3 Anfragen pro Session pro 10 Min
  session_start();
  $now     = time();
  $limit   = 3;
  $window  = 600;
  $history = array_filter($_SESSION['send_times'] ?? [], fn($t) => $t > $now - $window);
  if (count($history) >= $limit) {
    $errors[] = 'Zu viele Anfragen. Bitte warten Sie einige Minuten.';
  } else {
    $villa    = array_key_exists($_POST['villa'] ?? '', $villas) ? trim($_POST['villa']) : '';
    $anreise  = trim(preg_replace('/[^\d.\-]/', '', (string)($_POST['anreise']  ?? '')));
    $abreise  = trim(preg_replace('/[^\d.\-]/', '', (string)($_POST['abreise']  ?? '')));
    $personen = max(1, min(20, (int)($_POST['personen'] ?? 2)));
    $hunde    = max(0, min(5,  (int)($_POST['hunde']    ?? 0)));
    $anrede   = in_array($_POST['anrede'] ?? '', ['Herr', 'Frau', 'Divers'], true) ? $_POST['anrede'] : '';
    $vorname  = trim(substr((string)($_POST['vorname']  ?? ''), 0, 80));
    $nachname = trim(substr((string)($_POST['nachname'] ?? ''), 0, 80));
    $email    = strtolower(trim(substr((string)($_POST['email'] ?? ''), 0, 120)));
    $telefon  = trim(substr((string)($_POST['telefon']  ?? ''), 0, 40));
    $nachricht= trim(substr((string)($_POST['nachricht']?? ''), 0, 1000));
    $privacy  = !empty($_POST['privacy_ack']);

    $values = compact('villa','anreise','abreise','personen','hunde','anrede','vorname','nachname','email','telefon','nachricht');

    if (!$villa)                              $errors[] = 'Bitte eine Villa wählen.';
    if (!$anreise || !$abreise)               $errors[] = 'Bitte Anreise und Abreise angeben.';
    if (!$vorname || !$nachname)              $errors[] = 'Bitte Vor- und Nachname angeben.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Bitte eine gültige E-Mail-Adresse eingeben.';
    if (!$privacy)                            $errors[] = 'Bitte die Datenschutzhinweise bestätigen.';

    if (empty($errors)) {
      $villaLabel = $villas[$villa] ?? $villa;
      $subject    = "Neue Anfrage: $villaLabel – $vorname $nachname";
      $body = "Neue Buchungsanfrage\n\n"
            . "Villa:    $villaLabel\n"
            . "Anreise:  $anreise\n"
            . "Abreise:  $abreise\n"
            . "Personen: $personen\n"
            . "Hunde:    $hunde\n\n"
            . "Kontakt:\n"
            . "$anrede $vorname $nachname\n"
            . "E-Mail:   $email\n"
            . "Telefon:  $telefon\n\n"
            . ($nachricht !== '' ? "Nachricht:\n$nachricht\n" : '');

      $sent = hp_send_mail($notifyEmail, $subject, $body, $email, "$vorname $nachname", $smtpHost, $smtpUser, $smtpPass, $smtpPort, $fromEmail, $fromName);

      if ($sent) {
        $history[] = $now;
        $_SESSION['send_times'] = array_values($history);
        $success = true;
        $values  = [];
      } else {
        $errors[] = 'Versand fehlgeschlagen. Bitte versuchen Sie es später nochmal oder kontaktieren Sie uns per Telefon.';
      }
    }
  }
}

/* ── Mailer ── */
function hp_send_mail(string $to, string $subject, string $body, string $replyTo, string $replyName, string $smtpHost, string $smtpUser, string $smtpPass, int $smtpPort, string $fromEmail, string $fromName): bool {
  if ($smtpHost !== '' && $smtpUser !== '') {
    // PHPMailer (falls verfügbar)
    if (class_exists('\PHPMailer\PHPMailer\PHPMailer')) {
      $m = new \PHPMailer\PHPMailer\PHPMailer(true);
      try {
        $m->isSMTP();
        $m->Host       = $smtpHost;
        $m->SMTPAuth   = true;
        $m->Username   = $smtpUser;
        $m->Password   = $smtpPass;
        $m->SMTPSecure = $smtpPort === 465 ? 'ssl' : 'tls';
        $m->Port       = $smtpPort;
        $m->CharSet    = 'UTF-8';
        $m->setFrom($fromEmail, $fromName);
        $m->addAddress($to);
        $m->addReplyTo($replyTo, $replyName);
        $m->Subject = $subject;
        $m->Body    = $body;
        $m->send();
        return true;
      } catch (\Throwable $e) {
        error_log('[hp_send_mail] PHPMailer: ' . $e->getMessage());
        return false;
      }
    }
  }
  // Fallback: PHP mail()
  $headers  = "From: $fromName <$fromEmail>\r\n";
  $headers .= "Reply-To: $replyName <$replyTo>\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
  return mail($to, $subject, $body, $headers);
}

function h(mixed $s): string { return htmlspecialchars((string)$s, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }
function val(string $k, array $v): string { return h($v[$k] ?? ''); }

include __DIR__ . '/_inc/head.php';
include __DIR__ . '/_inc/nav.php';
?>

<div class="wrap-narrow" style="padding-top:36px;padding-bottom:60px">

  <a href="<?= $baseUrl ?>/" class="back-link">← Zurück</a>

  <h1 style="font-size:clamp(26px,4vw,38px);font-weight:900;color:var(--green);margin:16px 0 6px">Verfügbarkeit anfragen</h1>
  <p style="color:var(--soft);margin-bottom:32px">Unverbindlich – wir melden uns in der Regel innerhalb von 12 Stunden.</p>

  <?php if ($success): ?>
    <div class="alert alert-success" style="font-size:16px">
      <strong>✅ Anfrage eingegangen!</strong><br>
      Vielen Dank. Wir melden uns so schnell wie möglich bei Ihnen. Bitte prüfen Sie auch Ihren Spam-Ordner.
    </div>
    <a href="<?= $baseUrl ?>/" class="btn btn-green">Zurück zur Startseite</a>

  <?php else: ?>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error"><?= implode('<br>', array_map('h', $errors)) ?></div>
    <?php endif ?>

    <form method="post" style="display:grid;gap:20px">

      <!-- Villa -->
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px">
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:16px">🏡 Wunschvilla</h2>
        <div class="form-row">
          <label>Villa <span class="form-required">*</span></label>
          <select name="villa" id="f-villa" required>
            <option value="">Bitte wählen…</option>
            <?php foreach ($villas as $key => $label): ?>
              <option value="<?= h($key) ?>"<?= val('villa', $values) === $key ? ' selected' : '' ?>><?= h($label) ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>

      <!-- Zeitraum -->
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px">
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:16px">📅 Reisezeitraum</h2>
        <div class="form-grid form-2col" style="margin-bottom:14px">
          <div class="form-row">
            <label>Anreise <span class="form-required">*</span></label>
            <input type="date" name="anreise" id="f-anreise" required min="<?= date('Y-m-d') ?>" value="<?= h(isset($values['anreise']) ? (function($d){ $m=null; if(preg_match('/^(\d{2})\.(\d{2})\.(\d{4})$/',$d,$m)) return "{$m[3]}-{$m[2]}-{$m[1]}"; return $d; })($values['anreise']) : '') ?>">
          </div>
          <div class="form-row">
            <label>Abreise <span class="form-required">*</span></label>
            <input type="date" name="abreise" id="f-abreise" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>" value="<?= h(isset($values['abreise']) ? (function($d){ $m=null; if(preg_match('/^(\d{2})\.(\d{2})\.(\d{4})$/',$d,$m)) return "{$m[3]}-{$m[2]}-{$m[1]}"; return $d; })($values['abreise']) : '') ?>">
          </div>
        </div>
        <div id="f-avail" style="margin-bottom:10px"></div>
        <div id="f-nights" style="font-size:13px;color:var(--soft)"></div>
        <div class="form-grid form-2col" style="margin-top:14px">
          <div class="form-row">
            <label>Personen <span class="form-required">*</span></label>
            <select name="personen" id="f-personen">
              <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?= $i ?>"<?= (val('personen',$values)===(string)$i||($values===[]&&$i===2))?' selected':'' ?>><?= $i ?> Person<?= $i>1?'en':'' ?></option>
              <?php endfor ?>
            </select>
          </div>
          <div class="form-row">
            <label>Hunde</label>
            <select name="hunde" id="f-hunde">
              <?php for ($i = 0; $i <= 3; $i++): ?>
                <option value="<?= $i ?>"<?= val('hunde',$values)===(string)$i?' selected':'' ?>><?= $i===0?'Kein Hund':$i.' Hund'.($i>1?'e':'') ?></option>
              <?php endfor ?>
            </select>
          </div>
        </div>
      </div>

      <!-- Kontakt -->
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px">
        <h2 style="font-size:16px;font-weight:800;color:var(--green);margin-bottom:16px">👤 Ihre Kontaktdaten</h2>
        <div class="form-grid" style="gap:14px">
          <div class="form-row">
            <label>Anrede</label>
            <select name="anrede">
              <option value="">–</option>
              <option value="Herr"<?= val('anrede',$values)==='Herr'?' selected':'' ?>>Herr</option>
              <option value="Frau"<?= val('anrede',$values)==='Frau'?' selected':'' ?>>Frau</option>
              <option value="Divers"<?= val('anrede',$values)==='Divers'?' selected':'' ?>>Divers</option>
            </select>
          </div>
          <div class="form-grid form-2col">
            <div class="form-row">
              <label>Vorname <span class="form-required">*</span></label>
              <input type="text" name="vorname" required placeholder="Maria" value="<?= val('vorname',$values) ?>">
            </div>
            <div class="form-row">
              <label>Nachname <span class="form-required">*</span></label>
              <input type="text" name="nachname" required placeholder="Müller" value="<?= val('nachname',$values) ?>">
            </div>
          </div>
          <div class="form-row">
            <label>E-Mail <span class="form-required">*</span></label>
            <input type="email" name="email" required placeholder="maria@beispiel.de" value="<?= val('email',$values) ?>">
          </div>
          <div class="form-row">
            <label>Telefon</label>
            <input type="tel" name="telefon" placeholder="+49 170 …" value="<?= val('telefon',$values) ?>">
          </div>
          <div class="form-row">
            <label>Nachricht</label>
            <textarea name="nachricht" placeholder="Besondere Wünsche, Fragen, …"><?= val('nachricht',$values) ?></textarea>
          </div>
          <label style="display:flex;gap:10px;align-items:flex-start;font-size:13px;color:var(--soft);line-height:1.5">
            <input type="checkbox" name="privacy_ack" value="1" style="margin-top:2px;flex:0 0 auto" required>
            <span>Ich habe die <a href="<?= $baseUrl ?>/datenschutz.php" target="_blank" style="color:var(--green);font-weight:700">Datenschutzhinweise</a> zur Kenntnis genommen.</span>
          </label>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="border-radius:var(--radius-sm);font-size:16px;padding:15px 24px;border:none">
        Anfrage absenden →
      </button>
      <p style="text-align:center;font-size:13px;color:var(--soft)">Unverbindlich – keine Kosten ohne Bestätigung</p>

    </form>
  <?php endif ?>
</div>

<?php include __DIR__ . '/_inc/footer.php'; ?>
