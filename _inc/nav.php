<?php
$currentPage = $currentPage ?? '';
$navItems = [
  'haeuser.php'        => 'Häuser',
  'urlaub-mit-hund.php'=> 'Urlaub mit Hund',
  'preise.php'         => 'Preise',
  'kontakt.php'        => 'Anfragen',
];
$baseUrl = rtrim(getenv('BASE_URL') ?: '', '/');
?>
<nav class="nav">
  <div class="nav-inner">
    <a href="<?= $baseUrl ?>/" class="nav-brand">
      Ferienhaus Rügen mit Hund
      <span>Ruhige Boddenlage im Nordwesten Rügens</span>
    </a>
    <button class="nav-hamburger" aria-label="Menü">☰</button>
    <ul class="nav-links">
      <?php foreach ($navItems as $href => $label):
        $isActive = ($currentPage === $href) ? ' active' : '';
        $isCta    = ($href === 'kontakt.php') ? ' nav-cta' : '';
      ?>
        <li><a href="<?= $baseUrl ?>/<?= $href ?>" class="<?= trim($isActive . $isCta) ?>"><?= $label ?></a></li>
      <?php endforeach ?>
    </ul>
  </div>
</nav>
