<?php 
/**
 * 404 Not Found Error Page
 */
$pageTitle = "404 Not Found | Global Leave Calculator";
require __DIR__ . '/layout/header.php'; 
?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center flex flex-col items-center justify-center min-h-[60vh]">
    <h1 class="text-9xl font-extrabold text-brand-600 dark:text-brand-500 drop-shadow-sm">404</h1>
    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mt-8 mb-4">Page Not Found</h2>
    <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 max-w-lg mx-auto leading-relaxed">
        Oops! The page you are looking for doesn't exist, has been removed, or is temporarily unavailable.
    </p>
    <a href="/" class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-brand-600 hover:bg-brand-700 shadow-sm transition-all hover:-translate-y-0.5">
        Return to Homepage
    </a>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
