<?php require __DIR__.'/day.php'; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, target-densitydpi=device-dpi">
<title><?php echo preg_replace("/^[^ ]+ /", "", strip_tags(Config::getModeLibelles()[$mode])) ?><?php if(!$day->isToday()): ?> le <?php echo $day->getDateStart()->format("d/m/Y"); ?><?php endif; ?> - Suivi de l'état du trafic - RATP Status</title>
<meta name="description" content="Page de suivi et d'historisation de l'état du trafic des Ⓜ️ Métros, 🚆 RER / Transiliens et 🚈 Tramways d'Île de France">
<link rel="icon" href="/images/favicon_<?php echo $mode ?>.ico" />
<link rel="icon" type="image/png" href="/images/favicon_<?php echo $mode ?>.png" />
<link rel="stylesheet" href="/css/style.css?202405081203">
<script>
    const urlJson = '/<?php echo ($GLOBALS['isStaticResponse']) ? $day->getDateStart()->format('Ymd').".json" : "json.php?".http_build_query(['date' => $day->getDateStart()->format('Y-m-d')]) ?>';
</script>
<script defer src="/js/main.js?202405081035"></script>
</head>
<body>
<header role="banner">
    <div class="header-wrapper">
        <h1>Suivi de l'état du trafic</h1>
        <div class="day">
            <h2 class="<?php if($day->isToday()):?>today<?php endif;?>"><?php echo $day->getDateStart()->format("d/m/Y"); ?></h2>
            <a <?php if($prevDay): ?>href="<?php echo url("/".$day->getDateStartYesterday()->format('Ymd')."/".$mode.".html") ?>"<?php endif;?>>
                <span aria-hidden="true">⬅️</span>
                <span class="visually-hidden">Voir le jour précédent</span>
            </a>
            <a <?php if($nextDay): ?>href="<?php echo url("/".$day->getDateStartTomorrow()->format('Ymd')."/".$mode.".html") ?>"<?php endif;?>>
                <span aria-hidden="true">➡️</span>
                <span class="visually-hidden">Voir le jour suivant</span>
            </a>
        </div>
        <nav role="navigation"><?php foreach(Config::getLignes() as $m => $ligne): ?><a <?php if($mode == $m): ?>aria-current="page"<?php endif; ?> href="<?php echo url("/".((!$day->isToday()) ? $day->getDateStart()->format('Ymd')."/" : null).$m.".html") ?>"><?php echo Config::getModeLibelles()[$m] ?></a><?php endforeach; ?></nav>
        <aside>
            <button id="lien_infos" aria-haspopup="helpModal">
                <span aria-hidden="true">?</span>
                <span class="visually-hidden">Aide et informations</span>
            </button>
            <button id="lien_refresh" onclick="location.reload(); return false;">
                <span aria-hidden="true">🔃</span>
                <span class="visually-hidden">Rafraîchir</span>
            </button>
        </aside>
    </div>
</header>
<main role="main">
    <table class="lignes">
        <caption>
            <ul class="legend">
                <li class="ok">Rien à signaler</li>
                <li class="pb">Perturbation</li>
                <li class="bq">Blocage / Interruption</li>
                <li class="tx">Travaux</li>
                <li class="no">Service terminé ou non commencé</li>
            </ul>
        </caption>
        <thead>
            <tr>
            <th><span>Ligne</span></th>
            <?php for($i = 0; $i <= 1380; $i = $i + 2): ?>
                <th <?php if($i % 60 == 0): ?>class="hour"<?php endif; ?>><span><?php echo sprintf("%02d", (intval($i / 60) + 4) % 24) ?>h<?php if($i % 60 != 0): ?><?php echo sprintf("%02d", ($i % 60) ) ?><?php endif; ?></span></th>
            <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach(Config::getLignes()[$mode] as $ligne => $logo): ?>
            <tr>
                <th>
                    <img alt="<?php echo str_replace(['Métro ', 'Ligne ' ], ['M', 'L'], $ligne) ?>" src="<?php echo $logo ?>" width="30" height="30" />
                </th>
                <?php foreach($day->getSummary($ligne) as $summary): ?>
                <td class="<?php echo $summary["color"] ?>" colspan="<?php echo $summary["count"] ?>" style="--time-offset:<?php echo $summary["offset"] ?>">

                <time><?php echo $summary["start"] ?> - <?php echo $summary["end"] ?></time>
                <?php if($summary["info"]): ?>
                <div>
                    <?php echo $summary["info"] ?>
                </div>
                <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>
<footer role="contentinfo">
    <div class="footer-wrapper">
<p>
    Les informations présentées proviennent des données open data du portail <a href="https://prim.iledefrance-mobilites.fr/">PRIM Île-de-France mobilités</a> <small>(récupérées toutes les 2 minutes)</small>
</p>
<p>
    Projet publié sous licence libre AGPL-3.0 (<a href="https://github.com/wincelau/ratpstatus">voir les sources</a>) initié par <a href="https://piaille.fr/@winy">winy</a>
</p>
<p>Ce site n'est pas un site officiel de la <a href="https://www.ratp.fr/">RATP</a></p>
    </div>
</footer>
<dialog id="helpModal">
    <button class="dialog-close" type="button">Fermer</button>
    <h1>Aide et informations</h1>
    <p>RATPstatus.fr est une page de suivi et d'historisation de l'état du trafic des Ⓜ️&nbsp;Métros, 🚆&nbsp;RER / Transiliens et 🚈&nbsp;Tramways d'Île de France</p>
    <p>L'état du trafic est récupéré toutes les 2 minutes à partir du 23 avril 2024.</p>
    <p>Chaque bloc répresente une durée de 2 minutes, les couleurs ont la signification suivante </p>

    <ul class="legend">
        <li class="ok">Rien à signaler</li>
        <li class="pb">Perturbation</li>
        <li class="bq">Blocage / Interruption</li>
        <li class="tx">Travaux</li>
        <li class="no">Service terminé ou non commencé</li>
    </ul>

    <p>Les informations présentées proviennent des données open data du portail <a href="https://prim.iledefrance-mobilites.fr/">PRIM Île-de-France mobilités</a>.</p>
    <p>Le projet initié par <a href="https://piaille.fr/@winy">winy</a> est publié sous licence libre AGPL-3.0 : <a href="https://github.com/wincelau/ratpstatus">https://github.com/wincelau/ratpstatus</a></p>
    <p>Ce site n'est pas un site officiel de la <a href="https://www.ratp.fr/">RATP</a></p>
</dialog>
<template id="tooltip">
    <dialog><button class="dialog-close" type="button">Fermer</button></dialog>
</template>
</body>
</html>
