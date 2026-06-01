<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Global Leave Calculator' ?></title>
    
    <?php if (isset($metaDescription)): ?>
    <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <?php else: ?>
    <meta name="description" content="Calculate your annual leave entitlements globally. Free online calculator for Australia, USA, Canada and more.">
    <?php endif; ?>
    
    <?php 
        // Determine canonical URL
        $baseUrl = 'https://globalleavecalculator.com';
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Remove trailing slash if not root
        $currentPath = ($currentPath !== '/') ? rtrim($currentPath, '/') : '/';
        $canonicalUrl = $baseUrl . $currentPath;
        
        $ogTitle = isset($pageTitle) ? $pageTitle : 'Global Leave Calculator';
        $ogDescription = isset($metaDescription) ? $metaDescription : 'Calculate your annual leave entitlements globally. Free online calculator for Australia, USA, Canada and more.';
        $ogImage = $baseUrl . '/assets/og-image.jpg'; // Placeholder for future social banner
    ?>
    
    <!-- SEO: Canonical Tag -->
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>" />

    <!-- Open Graph / Social Media Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>" />
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>" />
    <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>" />
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle) ?>" />
    <meta name="twitter:description" content="<?= htmlspecialchars($ogDescription) ?>" />
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>" />
    
    <!-- Favicon & App Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], },
                    colors: { brand: { 50: '#f0f9ff', 100: '#e0f2fe', 500: '#0ea5e9', 600: '#0284c7', 900: '#0c4a6e', } }
                }
            }
        }
    </script>
    
    <style>
        input[type=range] { -webkit-appearance: none; width: 100%; background: transparent; }
        input[type=range]::-webkit-slider-thumb { -webkit-appearance: none; height: 20px; width: 20px; border-radius: 50%; background: #0ea5e9; cursor: pointer; margin-top: -8px; box-shadow: 0 0 10px rgba(14, 165, 233, 0.5); transition: transform 0.1s; }
        input[type=range]::-webkit-slider-thumb:hover { transform: scale(1.1); }
        input[type=range]::-webkit-slider-runnable-track { width: 100%; height: 6px; cursor: pointer; background: #e2e8f0; border-radius: 3px; }
        .dark input[type=range]::-webkit-slider-runnable-track { background: #334155; }
        input[type=range]:focus { outline: none; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script>
        /* Dark mode toggler script */
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
        
        // On load, apply saved theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <?php if (isset($faqs) && is_array($faqs) && count($faqs) > 0): ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        <?php 
        $faqItems = [];
        foreach ($faqs as $faq) {
            $faqItems[] = '{
              "@type": "Question",
              "name": ' . json_encode($faq['question']) . ',
              "acceptedAnswer": {
                "@type": "Answer",
                "text": ' . json_encode($faq['answer']) . '
              }
            }';
        }
        echo implode(",\n", $faqItems);
        ?>
      ]
    }
    </script>
    <?php endif; ?>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col selection:bg-brand-500 selection:text-white transition-colors duration-200">
    
    <nav class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 sticky top-0 z-50 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xl">L</div>
                        <span class="font-bold text-xl tracking-tight text-slate-900 dark:text-white">Global<span class="text-brand-600 dark:text-brand-400">Leave</span></span>
                    </a>
                </div>

                <div class="flex items-center space-x-6 relative" id="desktopNav">
                    
                    <!-- Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()" class="p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 focus:outline-none transition-colors">
                        <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                        <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    </button>

                    <!-- Navigation Menu -->
                    <div class="group relative hidden md:block">
                        <button class="flex items-center gap-1 text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 font-medium py-2">
                            Country
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Level 1 Dropdown - Using right-0 so it doesn't overflow left -->
                        <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            
                            <!-- Australia -->
                            <div class="group/sub relative px-2 py-2">
                                <button class="w-full flex items-center justify-between px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700 rounded-md">
                                    Australia
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                                <!-- Level 2 Dropdown (States) - Positioned rightwards -->
                                <div class="absolute right-full top-0 mr-1 w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-200 z-50 py-2">
                                    <a href="/country/australia/leave-calculator-for-queensland" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Queensland</a>
                                    <a href="/country/australia/leave-calculator-for-new-south-wales" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">New South Wales</a>
                                    <a href="/country/australia/leave-calculator-for-victoria" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Victoria</a>
                                    <a href="/country/australia/leave-calculator-for-tasmania" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Tasmania</a>
                                    <a href="/country/australia/leave-calculator-for-south-australia" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">South Australia</a>
                                    <a href="/country/australia/leave-calculator-for-western-australia" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Western Australia</a>
                                </div>
                            </div>
                            
                            <!-- USA -->
                            <div class="group/sub relative px-2 py-2">
                                <button class="w-full flex items-center justify-between px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700 rounded-md">
                                    USA
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                                <!-- Level 2 Dropdown (USA States) - Max Height and scroll for 50 items -->
                                <div class="absolute right-full top-0 mr-1 w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-200 z-50 py-2 max-h-96 overflow-y-auto custom-scrollbar">
                                    <a href="/country/usa/leave-calculator-for-alabama" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Alabama</a>
                                    <a href="/country/usa/leave-calculator-for-alaska" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Alaska</a>
                                    <a href="/country/usa/leave-calculator-for-arizona" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Arizona</a>
                                    <a href="/country/usa/leave-calculator-for-arkansas" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Arkansas</a>
                                    <a href="/country/usa/leave-calculator-for-california" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">California</a>
                                    <a href="/country/usa/leave-calculator-for-colorado" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Colorado</a>
                                    <a href="/country/usa/leave-calculator-for-connecticut" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Connecticut</a>
                                    <a href="/country/usa/leave-calculator-for-delaware" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Delaware</a>
                                    <a href="/country/usa/leave-calculator-for-florida" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Florida</a>
                                    <a href="/country/usa/leave-calculator-for-georgia" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Georgia</a>
                                    <a href="/country/usa/leave-calculator-for-hawaii" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Hawaii</a>
                                    <a href="/country/usa/leave-calculator-for-idaho" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Idaho</a>
                                    <a href="/country/usa/leave-calculator-for-illinois" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Illinois</a>
                                    <a href="/country/usa/leave-calculator-for-indiana" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Indiana</a>
                                    <a href="/country/usa/leave-calculator-for-iowa" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Iowa</a>
                                    <a href="/country/usa/leave-calculator-for-kansas" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Kansas</a>
                                    <a href="/country/usa/leave-calculator-for-kentucky" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Kentucky</a>
                                    <a href="/country/usa/leave-calculator-for-louisiana" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Louisiana</a>
                                    <a href="/country/usa/leave-calculator-for-maine" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Maine</a>
                                    <a href="/country/usa/leave-calculator-for-maryland" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Maryland</a>
                                    <a href="/country/usa/leave-calculator-for-massachusetts" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Massachusetts</a>
                                    <a href="/country/usa/leave-calculator-for-michigan" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Michigan</a>
                                    <a href="/country/usa/leave-calculator-for-minnesota" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Minnesota</a>
                                    <a href="/country/usa/leave-calculator-for-mississippi" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Mississippi</a>
                                    <a href="/country/usa/leave-calculator-for-missouri" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Missouri</a>
                                    <a href="/country/usa/leave-calculator-for-montana" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Montana</a>
                                    <a href="/country/usa/leave-calculator-for-nebraska" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Nebraska</a>
                                    <a href="/country/usa/leave-calculator-for-nevada" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Nevada</a>
                                    <a href="/country/usa/leave-calculator-for-new-hampshire" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">New Hampshire</a>
                                    <a href="/country/usa/leave-calculator-for-new-jersey" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">New Jersey</a>
                                    <a href="/country/usa/leave-calculator-for-new-mexico" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">New Mexico</a>
                                    <a href="/country/usa/leave-calculator-for-new-york" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">New York</a>
                                    <a href="/country/usa/leave-calculator-for-north-carolina" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">North Carolina</a>
                                    <a href="/country/usa/leave-calculator-for-north-dakota" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">North Dakota</a>
                                    <a href="/country/usa/leave-calculator-for-ohio" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Ohio</a>
                                    <a href="/country/usa/leave-calculator-for-oklahoma" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Oklahoma</a>
                                    <a href="/country/usa/leave-calculator-for-oregon" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Oregon</a>
                                    <a href="/country/usa/leave-calculator-for-pennsylvania" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Pennsylvania</a>
                                    <a href="/country/usa/leave-calculator-for-rhode-island" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Rhode Island</a>
                                    <a href="/country/usa/leave-calculator-for-south-carolina" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">South Carolina</a>
                                    <a href="/country/usa/leave-calculator-for-south-dakota" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">South Dakota</a>
                                    <a href="/country/usa/leave-calculator-for-tennessee" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Tennessee</a>
                                    <a href="/country/usa/leave-calculator-for-texas" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Texas</a>
                                    <a href="/country/usa/leave-calculator-for-utah" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Utah</a>
                                    <a href="/country/usa/leave-calculator-for-vermont" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Vermont</a>
                                    <a href="/country/usa/leave-calculator-for-virginia" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Virginia</a>
                                    <a href="/country/usa/leave-calculator-for-washington" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Washington</a>
                                    <a href="/country/usa/leave-calculator-for-west-virginia" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">West Virginia</a>
                                    <a href="/country/usa/leave-calculator-for-wisconsin" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Wisconsin</a>
                                    <a href="/country/usa/leave-calculator-for-wyoming" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Wyoming</a>
                                </div>
                            </div>
                            
                            <!-- Canada -->
                            <div class="group/sub relative px-2 py-2 pb-3">
                                <button class="w-full flex items-center justify-between px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700 rounded-md">
                                    Canada
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                                <!-- Level 2 Dropdown (Canada Provinces) -->
                                <div class="absolute right-full top-0 mr-1 w-64 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-200 z-50 py-2">
                                    <a href="/country/canada/leave-calculator-for-alberta" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Alberta</a>
                                    <a href="/country/canada/leave-calculator-for-british-columbia" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">British Columbia</a>
                                    <a href="/country/canada/leave-calculator-for-manitoba" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Manitoba</a>
                                    <a href="/country/canada/leave-calculator-for-new-brunswick" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">New Brunswick</a>
                                    <a href="/country/canada/leave-calculator-for-newfoundland-and-labrador" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Newfoundland and Labrador</a>
                                    <a href="/country/canada/leave-calculator-for-nova-scotia" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Nova Scotia</a>
                                    <a href="/country/canada/leave-calculator-for-ontario" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Ontario</a>
                                    <a href="/country/canada/leave-calculator-for-prince-edward-island" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Prince Edward Island</a>
                                    <a href="/country/canada/leave-calculator-for-quebec" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Quebec</a>
                                    <a href="/country/canada/leave-calculator-for-saskatchewan" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">Saskatchewan</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #475569; }
    </style>
    
    <main class="flex-grow relative transition-colors duration-200">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-brand-100 dark:bg-brand-900/30 mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70"></div>
            <div class="absolute top-20 -left-20 w-72 h-72 rounded-full bg-indigo-100 dark:bg-indigo-900/30 mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
