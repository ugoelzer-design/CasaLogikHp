<?php $baseUrl = rtrim(getenv('BASE_URL') ?: '', '/'); ?>
<footer class="footer">
  <div>© 2026 Gerald Udo Gölzer</div>
  <div class="footer-links">
    <a href="<?= $baseUrl ?>/impressum.php">Impressum</a>
    <a href="<?= $baseUrl ?>/datenschutz.php">Datenschutz</a>
  </div>
</footer>

<!-- Cookie Banner -->
<div id="cookie-banner">
  <p><strong>Cookies</strong><br>Wir nutzen Google Analytics nur nach deiner Zustimmung. Ohne Zustimmung wird nicht getrackt.</p>
  <div class="cookie-actions">
    <button class="cookie-btn cookie-accept" id="cookie-accept">Zustimmen</button>
    <button class="cookie-btn cookie-decline" id="cookie-decline">Ablehnen</button>
  </div>
</div>

<script src="<?= $baseUrl ?>/assets/js/main.js"></script>
</body>
</html>
