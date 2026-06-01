<?php 
/**
 * 405 Method Not Allowed Error Page
 */
$pageTitle = "405 Method Not Allowed | Global Leave Calculator";
require __DIR__ . '/layout/header.php'; 
?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center flex flex-col items-center justify-center min-h-[60vh]">
    <h1 class="text-9xl font-extrabold text-amber-500 drop-shadow-sm">405</h1>
    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mt-8 mb-4">Method Not Allowed</h2>
    <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 max-w-lg mx-auto leading-relaxed">
        The HTTP method used is not allowed for the requested resource. Please ensure you are navigating the site normally using links.
    </p>
    <a href="/" class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-brand-600 hover:bg-brand-700 shadow-sm transition-all hover:-translate-y-0.5">
        Return to Homepage
    </a>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
