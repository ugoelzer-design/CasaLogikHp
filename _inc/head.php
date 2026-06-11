<?php
// Shared head include
// Usage: include __DIR__ . '/_inc/head.php';
// Set $pageTitle, $pageDesc, $gaId before including
$pageTitle = $pageTitle ?? 'Ferienhaus Rügen mit Hund';
$pageDesc  = $pageDesc  ?? 'Hundefreundliche Ferienhäuser in ruhiger Boddenlage im Nordwesten Rügens.';
$gaId      = $gaId      ?? getenv('GA_ID') ?: '';
$baseUrl   = rtrim(getenv('BASE_URL') ?: '', '/');
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDesc, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($gaId): ?><meta name="ga-id" content="<?= htmlspecialchars($gaId, ENT_QUOTES, 'UTF-8') ?>"><?php endif ?>
<link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/style.css">
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏡</text></svg>">
</head>
<body>
