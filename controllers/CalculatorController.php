<?php

require_once __DIR__ . '/../models/LeaveRule.php';
require_once __DIR__ . '/../utils/SeoHelper.php';

class CalculatorController {

    public function showCalculator($country, $stateQuery, $isHome = false) {
        $countrySlug = strtolower(trim($country));
        
        // Extract state slug. E.g., "leave calculator for california" -> "california"
        // Also handle standard slugs like "california" or "new-york"
        $stateSlug = strtolower(trim(urldecode($stateQuery)));
        
        // Remove "leave calculator for " or "leave-calculator-for-" prefix if it exists
        $stateSlug = preg_replace('/^leave[\s-]calculator[\s-]for[\s-]/', '', $stateSlug);

        // Convert any remaining spaces to dashes for slug matching in DB
        $stateSlug = str_replace(' ', '-', $stateSlug);
        
        $rule = LeaveRule::getRuleByCountryAndState($countrySlug, $stateSlug);
        
        if (!$rule) {
            // Provide a fallback or 404. For now, a fallback rule so UI still works.
            $rule = [
                'country_slug' => $countrySlug,
                'state_slug' => $stateSlug,
                'state_name' => ucwords(str_replace('-', ' ', $stateSlug)),
                'annual_leave_weeks' => 4.00,
                'accrual_rate_per_week' => 0.07692,
                'leave_loading_percentage' => 0.00,
                'working_hours_per_week' => 40.00,
                'notes' => 'Using default fallback rules.'
            ];
        }

        $stateName = htmlspecialchars($rule['state_name']);
        $countryName = ucwords(str_replace('-', ' ', $rule['country_slug']));
        if (strtolower($rule['country_slug']) === 'usa') $countryName = 'USA';
        
        if ($isHome) {
            $pageTitle = "Accurate Leave Calculator | Global Leave Calculator";
            $metaDescription = "Calculate your accrued annual leave and its value instantly using standard global metrics. Free, secure, and fast.";
        } else {
            $pageTitle = "Annual Leave Calculator $stateName, $countryName";
            $metaDescription = SeoHelper::generateMetaDescription($stateName, $countryName);
            $faqs = SeoHelper::generateFaqs($stateName, $countryName, floatval($rule['working_hours_per_week']));
            $seoIntro = SeoHelper::generateIntro($stateName, $countryName);
            $seoConclusion = SeoHelper::generateConclusion($stateName, $countryName);
        }
        
        // Load View
        require_once __DIR__ . '/../views/calculator.php';
    }
    
    /**
     * Display the generic Home Page calculator
     * Does not target any specific state and uses standard default values.
     */
    public function showHome() {
        // Define generic default rules for the home page calculator
        $rule = [
            'country_slug' => '',
            'state_slug' => '',
            'state_name' => '', // Blank indicates generic
            'annual_leave_weeks' => 4.00,
            'accrual_rate_per_week' => 0.07692,
            'leave_loading_percentage' => 0.00,
            'working_hours_per_week' => 40.00,
            'notes' => ''
        ];
        
        // Set home page specific title
        $pageTitle = "Accurate Leave Calculator | Global Leave Calculator";
        $isHome = true;
        
        // Load View
        require_once __DIR__ . '/../views/calculator.php';
    }

    /**
     * Display 404 Not Found Page
     */
    public function show404() {
        http_response_code(404);
        require_once __DIR__ . '/../views/404.php';
    }

    /**
     * Display 405 Method Not Allowed Page
     */
    public function show405() {
        http_response_code(405);
        require_once __DIR__ . '/../views/405.php';
    }

    /**
     * Generate dynamic sitemap.xml
     */
        public function showSitemap() {
        // Base URL could be configured, for now assuming production domain
        $baseUrl = 'https://globalleavecalculator.com';
        
        header("Content-Type: application/xml; charset=utf-8");
        
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Static Pages
        $staticPages = [
            '/',
            '/about-us',
            '/contact-us',
            '/privacy-policy',
            '/terms-and-conditions'
        ];
        
        foreach ($staticPages as $page) {
            echo "  <url>\n";
            echo "    <loc>" . $baseUrl . $page . "</loc>\n";
            echo "    <changefreq>weekly</changefreq>\n";
            echo "    <priority>" . ($page === '/' ? '1.0' : '0.5') . "</priority>\n";
            echo "  </url>\n";
        }
        
        // All Dynamic State Pages extracted from navigation
        $allLinks = [
            '/country/australia/leave-calculator-for-queensland',
            '/country/australia/leave-calculator-for-new-south-wales',
            '/country/australia/leave-calculator-for-victoria',
            '/country/australia/leave-calculator-for-tasmania',
            '/country/australia/leave-calculator-for-south-australia',
            '/country/australia/leave-calculator-for-western-australia',
            '/country/usa/leave-calculator-for-alabama',
            '/country/usa/leave-calculator-for-alaska',
            '/country/usa/leave-calculator-for-arizona',
            '/country/usa/leave-calculator-for-arkansas',
            '/country/usa/leave-calculator-for-california',
            '/country/usa/leave-calculator-for-colorado',
            '/country/usa/leave-calculator-for-connecticut',
            '/country/usa/leave-calculator-for-delaware',
            '/country/usa/leave-calculator-for-florida',
            '/country/usa/leave-calculator-for-georgia',
            '/country/usa/leave-calculator-for-hawaii',
            '/country/usa/leave-calculator-for-idaho',
            '/country/usa/leave-calculator-for-illinois',
            '/country/usa/leave-calculator-for-indiana',
            '/country/usa/leave-calculator-for-iowa',
            '/country/usa/leave-calculator-for-kansas',
            '/country/usa/leave-calculator-for-kentucky',
            '/country/usa/leave-calculator-for-louisiana',
            '/country/usa/leave-calculator-for-maine',
            '/country/usa/leave-calculator-for-maryland',
            '/country/usa/leave-calculator-for-massachusetts',
            '/country/usa/leave-calculator-for-michigan',
            '/country/usa/leave-calculator-for-minnesota',
            '/country/usa/leave-calculator-for-mississippi',
            '/country/usa/leave-calculator-for-missouri',
            '/country/usa/leave-calculator-for-montana',
            '/country/usa/leave-calculator-for-nebraska',
            '/country/usa/leave-calculator-for-nevada',
            '/country/usa/leave-calculator-for-new-hampshire',
            '/country/usa/leave-calculator-for-new-jersey',
            '/country/usa/leave-calculator-for-new-mexico',
            '/country/usa/leave-calculator-for-new-york',
            '/country/usa/leave-calculator-for-north-carolina',
            '/country/usa/leave-calculator-for-north-dakota',
            '/country/usa/leave-calculator-for-ohio',
            '/country/usa/leave-calculator-for-oklahoma',
            '/country/usa/leave-calculator-for-oregon',
            '/country/usa/leave-calculator-for-pennsylvania',
            '/country/usa/leave-calculator-for-rhode-island',
            '/country/usa/leave-calculator-for-south-carolina',
            '/country/usa/leave-calculator-for-south-dakota',
            '/country/usa/leave-calculator-for-tennessee',
            '/country/usa/leave-calculator-for-texas',
            '/country/usa/leave-calculator-for-utah',
            '/country/usa/leave-calculator-for-vermont',
            '/country/usa/leave-calculator-for-virginia',
            '/country/usa/leave-calculator-for-washington',
            '/country/usa/leave-calculator-for-west-virginia',
            '/country/usa/leave-calculator-for-wisconsin',
            '/country/usa/leave-calculator-for-wyoming',
            '/country/canada/leave-calculator-for-alberta',
            '/country/canada/leave-calculator-for-british-columbia',
            '/country/canada/leave-calculator-for-manitoba',
            '/country/canada/leave-calculator-for-new-brunswick',
            '/country/canada/leave-calculator-for-newfoundland-and-labrador',
            '/country/canada/leave-calculator-for-nova-scotia',
            '/country/canada/leave-calculator-for-ontario',
            '/country/canada/leave-calculator-for-prince-edward-island',
            '/country/canada/leave-calculator-for-quebec',
            '/country/canada/leave-calculator-for-saskatchewan',
        ];
        
        foreach ($allLinks as $link) {
            echo "  <url>\n";
            echo "    <loc>" . $baseUrl . $link . "</loc>\n";
            echo "    <changefreq>monthly</changefreq>\n";
            echo "    <priority>0.8</priority>\n";
            echo "  </url>\n";
        }
        
        echo '</urlset>';
    }
}
