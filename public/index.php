<?php
/**
 * Main Front Controller & Router
 * 
 * This file serves as the single entry point for the application.
 * It parses the incoming request URI and delegates the request to the 
 * appropriate controller methods or loads static view files.
 */

require_once __DIR__ . '/../controllers/CalculatorController.php';

// Get the requested URI
$requestUri = $_SERVER['REQUEST_URI'];

// Strip query parameters
$path = parse_url($requestUri, PHP_URL_PATH);

// Remove trailing slash for consistency (unless it's exactly '/')
$path = rtrim($path, '/');

$controller = new CalculatorController();

/**
 * Route Definitions
 */

$method = $_SERVER['REQUEST_METHOD'];

// Route: /country/{country}/{state}
if (preg_match('#^/country/([^/]+)/([^/]+)$#i', $path, $matches)) {
    $country = $matches[1];
    $state = $matches[2];
    if ($method !== 'GET') {
        $controller->show405();
    } else {
        $controller->showCalculator($country, $state);
    }
} 
// Route: Home
elseif ($path === '' || $path === '/' || $path === '/index.php') {
    if ($method !== 'GET') {
        $controller->show405();
    } else {
        $controller->showHome();
    }
}
// Route: Sitemap
elseif ($path === '/sitemap.xml') {
    if ($method !== 'GET') {
        $controller->show405();
    } else {
        $controller->showSitemap();
    }
}
// Route: Static Legal and Info Pages
elseif ($path === '/about-us') {
    $pageTitle = "About Us | Global Leave Calculator";
    require_once __DIR__ . '/../views/about.php';
}
elseif ($path === '/contact-us') {
    $pageTitle = "Contact Us | Global Leave Calculator";
    require_once __DIR__ . '/../views/contact.php';
}
elseif ($path === '/privacy-policy') {
    $pageTitle = "Privacy Policy | Global Leave Calculator";
    require_once __DIR__ . '/../views/privacy.php';
}
elseif ($path === '/terms-and-conditions') {
    $pageTitle = "Terms and Conditions | Global Leave Calculator";
    require_once __DIR__ . '/../views/terms.php';
}
// 404 Not Found
else {
    // If running PHP built-in server and file exists, let it serve the file (like CSS/JS)
    if (php_sapi_name() === 'cli-server') {
        $file = __DIR__ . $path;
        if (is_file($file)) {
            return false; // let the built-in server handle it
        }
    }
    $controller->show404();
}
