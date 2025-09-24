<?php
// Script PHP pour générer des pages avec les bonnes métadonnées OpenGraph

$appMetadata = [
    'oldtaskmanager' => [
        'title' => 'OldTaskManager',
        'description' => 'Application capture l\'essence du système de tâches Palm Pilot : priorités claires, catégories simples, et zéro superflu.',
        'image' => 'https://is1-ssl.mzstatic.com/image/thumb/Purple221/v4/1d/43/c7/1d43c7f0-b2c9-d188-f29d-e86abcf7be40/AppIcon-0-0-1x_U007emarketing-0-8-0-85-220.png/512x512bb.jpg'
    ],
    'r3spir3' => [
        'title' => 'R3SPIR3',
        'description' => 'Votre coach de respiration personnel avec des exercices scientifiquement prouvés pour réduire le stress et améliorer la concentration.',
        'image' => 'https://is1-ssl.mzstatic.com/image/thumb/Purple211/v4/7e/bc/8c/7ebc8c8f-311d-3945-be43-cae8d6c7f5dc/AppIcon-0-0-1x_U007epad-0-1-85-220.png/460x0w.webp'
    ],
    'atgc' => [
        'title' => 'ATGC',
        'description' => 'Explorateur de fichiers VCF pour l\'analyse génétique. Visualisez et analysez vos données de séquençage génomique avec une interface intuitive.',
        'image' => 'https://is1-ssl.mzstatic.com/image/thumb/Purple211/v4/a1/7c/f1/a17cf19e-efb5-b910-bcb9-08bff90a7e6b/AppIcon-0-0-1x_U007emarketing-0-8-0-85-220.png/460x0w.webp'
    ]
];

// Récupérer le paramètre app
$appParam = isset($_GET['app']) ? strtolower(trim($_GET['app'])) : null;

// Définir les métadonnées par défaut
$metaTitle = "Nos Applications - Our Applications";
$metaDescription = "Découvrez nos applications iOS innovantes : OldTaskManager, R3SPIR3 et ATGC. Applications de productivité, santé et science.";
$metaImage = "";

// Si un paramètre app est spécifié et existe dans notre liste
if ($appParam && isset($appMetadata[$appParam])) {
    $appData = $appMetadata[$appParam];
    $metaTitle = $appData['title'];
    $metaDescription = $appData['description'];
    $metaImage = $appData['image'];
}

$currentUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- OpenGraph metadata for social media -->
    <meta property="og:title" content="<?php echo htmlspecialchars($metaTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($currentUrl); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($metaImage); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="1O1IN Apps">

    <!-- Twitter Card metadata -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($metaTitle); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($metaImage); ?>">

    <!-- LinkedIn specific -->
    <meta name="author" content="1O1IN">

    <!-- Standard metadata -->
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="keywords" content="iOS, applications, OldTaskManager, R3SPIR3, ATGC, productivité, santé, génétique">

    <title><?php echo htmlspecialchars($metaTitle); ?></title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        h1 {
            color: #333;
            font-size: 3em;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        .language-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .language-switcher:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        .language-switcher span {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .language-switcher span.active {
            background: #007AFF;
            color: white;
        }

        .apps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .app-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
        }

        .app-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .app-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .app-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .app-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            margin-right: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .app-info h2 {
            color: #333;
            margin-bottom: 5px;
            font-size: 1.5em;
        }

        .app-developer {
            color: #666;
            font-size: 0.9em;
        }

        .app-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .app-features {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .app-features h3 {
            color: #444;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        .app-features ul {
            list-style: none;
            padding-left: 0;
        }

        .app-features li {
            padding: 5px 0;
            color: #555;
        }

        .app-features li:before {
            content: "✓ ";
            color: #007AFF;
            font-weight: bold;
            margin-right: 5px;
        }

        .download-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            padding: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .download-btn:hover {
            transform: translateY(-3px);
            filter: brightness(1.1);
        }

        .download-btn img {
            height: 50px;
            width: auto;
        }

        .support-notice {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            color: #555;
            margin-top: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .support-notice h3 {
            color: #007AFF;
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            color: #666;
            margin-top: 50px;
            padding: 20px;
        }

        footer a {
            color: #007AFF;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .support-link {
            color: #007AFF;
            text-decoration: none;
            font-weight: 500;
        }

        .support-link:hover {
            text-decoration: underline;
        }

        .lang-en {
            display: none;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            .language-switcher {
                position: static;
                margin: 20px auto;
                display: inline-block;
            }

            .apps-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>
                <span class="lang-fr">Nos Applications</span>
                <span class="lang-en">Our Applications</span>
            </h1>
            <div class="language-switcher">
                <span class="fr-btn active">FR</span>
                <span class="en-btn">EN</span>
            </div>
        </header>

        <div class="apps-grid">
            <?php if (!$appParam || $appParam === 'oldtaskmanager'): ?>
            <div class="app-card" data-app="OldTaskManager">
                <div class="app-header">
                    <img src="https://is1-ssl.mzstatic.com/image/thumb/Purple221/v4/1d/43/c7/1d43c7f0-b2c9-d188-f29d-e86abcf7be40/AppIcon-0-0-1x_U007emarketing-0-8-0-85-220.png/512x512bb.jpg" alt="OldTaskManager" class="app-icon">
                    <div class="app-info">
                        <h2>OldTaskManager</h2>
                        <p class="app-developer">
                            <span class="lang-fr">Par 1O1IN</span>
                            <span class="lang-en">By 1O1IN</span>
                        </p>
                    </div>
                </div>

                <div class="app-description">
                    <p class="lang-fr">
                        Notre application capture l'essence de ce qui rendait le système de tâches Palm Pilot si efficace : des priorités claires, des catégories simples, et zéro superflu.
                    </p>
                    <p class="lang-en">
                        Our app captures the essence of what made the Palm Pilot task system so effective: clear priorities, simple categories, and zero fluff.
                    </p>
                </div>

                <div class="app-features">
                    <h3>
                        <span class="lang-fr">Caractéristiques</span>
                        <span class="lang-en">Features</span>
                    </h3>
                    <ul>
                        <li>
                            <span class="lang-fr">Gestion de tâches simplifiée</span>
                            <span class="lang-en">Simplified task management</span>
                        </li>
                        <li>
                            <span class="lang-fr">Priorités claires</span>
                            <span class="lang-en">Clear priorities</span>
                        </li>
                        <li>
                            <span class="lang-fr">Catégories personnalisables</span>
                            <span class="lang-en">Customizable categories</span>
                        </li>
                        <li>
                            <span class="lang-fr">Interface épurée</span>
                            <span class="lang-en">Clean interface</span>
                        </li>
                    </ul>
                </div>

                <a href="https://apps.apple.com/fr/app/oldtaskmanager/id6752569914" target="_blank" class="download-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/40/Download_on_the_App_Store_Badge_FRCA_RGB_blk.svg" alt="Download on App Store" style="width: 100%; max-width: 200px;">
                </a>
            </div>
            <?php endif; ?>

            <?php if (!$appParam || $appParam === 'r3spir3'): ?>
            <div class="app-card" data-app="R3SPIR3">
                <div class="app-header">
                    <img src="https://is1-ssl.mzstatic.com/image/thumb/Purple211/v4/7e/bc/8c/7ebc8c8f-311d-3945-be43-cae8d6c7f5dc/AppIcon-0-0-1x_U007epad-0-1-85-220.png/460x0w.webp" alt="R3SPIR3" class="app-icon">
                    <div class="app-info">
                        <h2>R3SPIR3</h2>
                        <p class="app-developer">
                            <span class="lang-fr">Par 1O1IN</span>
                            <span class="lang-en">By 1O1IN</span>
                        </p>
                    </div>
                </div>

                <div class="app-description">
                    <p class="lang-fr">
                        Votre coach de respiration personnel avec des exercices de respiration scientifiquement prouvés pour réduire le stress, améliorer la concentration et trouver le calme intérieur.
                    </p>
                    <p class="lang-en">
                        Your personal breathing coach with scientifically proven breathing exercises to reduce stress, improve concentration, and find inner calm.
                    </p>
                </div>

                <div class="app-features">
                    <h3>
                        <span class="lang-fr">Caractéristiques</span>
                        <span class="lang-en">Features</span>
                    </h3>
                    <ul>
                        <li>
                            <span class="lang-fr">Animation de respiration triangulaire intuitive</span>
                            <span class="lang-en">Intuitive triangular breathing animation</span>
                        </li>
                        <li>
                            <span class="lang-fr">3 niveaux de difficulté</span>
                            <span class="lang-en">3 difficulty levels</span>
                        </li>
                        <li>
                            <span class="lang-fr">Musique d'ambiance optionnelle</span>
                            <span class="lang-en">Optional ambient music</span>
                        </li>
                        <li>
                            <span class="lang-fr">Intégration avec l'app Santé</span>
                            <span class="lang-en">Health app integration</span>
                        </li>
                        <li>
                            <span class="lang-fr">Sans publicités ni abonnements</span>
                            <span class="lang-en">No ads or subscriptions</span>
                        </li>
                    </ul>
                </div>

                <a href="https://apps.apple.com/fr/app/r3spir3/id6752522814" target="_blank" class="download-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/40/Download_on_the_App_Store_Badge_FRCA_RGB_blk.svg" alt="Download on App Store" style="width: 100%; max-width: 200px;">
                </a>
            </div>
            <?php endif; ?>

            <?php if (!$appParam || $appParam === 'atgc'): ?>
            <div class="app-card" data-app="ATGC">
                <div class="app-header">
                    <img src="https://is1-ssl.mzstatic.com/image/thumb/Purple211/v4/a1/7c/f1/a17cf19e-efb5-b910-bcb9-08bff90a7e6b/AppIcon-0-0-1x_U007emarketing-0-8-0-85-220.png/460x0w.webp" alt="ATGC" class="app-icon">
                    <div class="app-info">
                        <h2>ATGC</h2>
                        <p class="app-developer">
                            <span class="lang-fr">Par 1O1IN</span>
                            <span class="lang-en">By 1O1IN</span>
                        </p>
                    </div>
                </div>

                <div class="app-description">
                    <p class="lang-fr">
                        Explorateur de fichiers VCF pour l'analyse génétique. Visualisez et analysez vos données de séquençage génomique avec une interface intuitive et des outils d'analyse avancés.
                    </p>
                    <p class="lang-en">
                        VCF file explorer for genetic analysis. Visualize and analyze your genomic sequencing data with an intuitive interface and advanced analysis tools.
                    </p>
                </div>

                <div class="app-features">
                    <h3>
                        <span class="lang-fr">Caractéristiques</span>
                        <span class="lang-en">Features</span>
                    </h3>
                    <ul>
                        <li>
                            <span class="lang-fr">Exploration de fichiers VCF</span>
                            <span class="lang-en">VCF file exploration</span>
                        </li>
                        <li>
                            <span class="lang-fr">Visualisation des variants génétiques</span>
                            <span class="lang-en">Genetic variant visualization</span>
                        </li>
                        <li>
                            <span class="lang-fr">Filtrage et recherche avancés</span>
                            <span class="lang-en">Advanced filtering and search</span>
                        </li>
                        <li>
                            <span class="lang-fr">Export de données</span>
                            <span class="lang-en">Data export</span>
                        </li>
                    </ul>
                </div>

                <a href="https://apps.apple.com/fr/app/atgc-vcf-explorer/id6752802061" target="_blank" class="download-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/40/Download_on_the_App_Store_Badge_FRCA_RGB_blk.svg" alt="Download on App Store" style="width: 100%; max-width: 200px;">
                </a>
            </div>
            <?php endif; ?>
        </div>

        <div class="support-notice">
            <h3>
                <span class="lang-fr">Support & Communauté</span>
                <span class="lang-en">Support & Community</span>
            </h3>
            <p>
                <span class="lang-fr">
                    L'assistance et le forum permettent aux utilisateurs de poser des questions et de partager leurs expériences avec notre communauté.
                </span>
                <span class="lang-en">
                    Support and forum allow users to ask questions and share experiences with our community.
                </span>
            </p>
            <p style="margin-top: 15px;">
                <a href="https://github.com/l0d0v1c/dev/issues" target="_blank" class="support-link">
                    <span class="lang-fr">Accéder à l'assistance →</span>
                    <span class="lang-en">Access support →</span>
                </a>
            </p>
        </div>

        <footer>
            <p>
                <span class="lang-fr">© 2024 Toutes les applications. Tous droits réservés.</span>
                <span class="lang-en">© 2024 All Applications. All rights reserved.</span>
            </p>
            <p>
                <a href="privacy.html">
                    <span class="lang-fr">Engagement de confidentialité</span>
                    <span class="lang-en">Privacy Policy</span>
                </a>
            </p>
        </footer>
    </div>

    <script>
        $(document).ready(function() {
            // Animation des cartes au chargement
            $('.app-card').each(function(index) {
                var card = $(this);
                setTimeout(function() {
                    card.addClass('visible');
                }, 200 * index);
            });

            // Changement de langue
            $('.fr-btn').click(function() {
                switchLanguage('fr');
            });

            $('.en-btn').click(function() {
                switchLanguage('en');
            });

            function switchLanguage(lang) {
                if (lang === 'fr') {
                    $('.lang-fr').show();
                    $('.lang-en').hide();
                    $('.fr-btn').addClass('active');
                    $('.en-btn').removeClass('active');
                    $('html').attr('lang', 'fr');
                } else {
                    $('.lang-en').show();
                    $('.lang-fr').hide();
                    $('.en-btn').addClass('active');
                    $('.fr-btn').removeClass('active');
                    $('html').attr('lang', 'en');
                }
            }

            // Animation au survol des cartes
            $('.app-card').hover(
                function() {
                    $(this).find('.app-icon').css('animation-play-state', 'paused');
                },
                function() {
                    $(this).find('.app-icon').css('animation-play-state', 'running');
                }
            );

            // Animation du bouton de téléchargement
            $('.download-btn').hover(
                function() {
                    $(this).animate({
                        'padding-left': '40px',
                        'padding-right': '40px'
                    }, 200);
                },
                function() {
                    $(this).animate({
                        'padding-left': '30px',
                        'padding-right': '30px'
                    }, 200);
                }
            );

            // Animation de parallaxe légère
            $(window).scroll(function() {
                var scrolled = $(window).scrollTop();
                $('h1').css('transform', 'translateY(' + (scrolled * 0.2) + 'px)');
                $('.app-card').each(function() {
                    var offset = $(this).offset().top;
                    var diff = offset - scrolled - $(window).height();
                    if (diff < 0) {
                        $(this).css('transform', 'translateY(' + (diff * 0.05) + 'px)');
                    }
                });
            });

            // Animation du switch de langue
            $('.language-switcher').click(function() {
                $(this).animate({ rotate: '360deg' }, 500, function() {
                    $(this).css('transform', 'rotate(0deg)');
                });
            });
        });
    </script>
</body>
</html>