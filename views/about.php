<?php
/**
 * About Us Page
 * Provides background information about the Global Leave Calculator.
 */
require __DIR__ . '/layout/header.php'; 
?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 prose prose-slate dark:prose-invert">
    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">About Us</h1>
    
    <div class="bg-brand-50 dark:bg-slate-800 p-6 rounded-xl border border-brand-100 dark:border-slate-700 mb-8">
        <p class="text-lg text-slate-700 dark:text-slate-300 m-0">Our mission is to simplify workplace entitlements and make leave calculations accessible, accurate, and completely free for everyone.</p>
    </div>

    <p>Welcome to Global Leave Calculator, your trusted tool for determining annual leave accruals, balances, and leave loading values globally.</p>

    <h2 class="text-2xl font-semibold mt-8 mb-4 text-slate-800 dark:text-slate-200">What We Do</h2>
    <p>Navigating the complexities of employment laws, varying weekly hours, and different state or national standards can be overwhelming. We built the Global Leave Calculator to provide a fast, intuitive, and accurate way for both employees and employers to estimate their time-off benefits.</p>

    <h2 class="text-2xl font-semibold mt-8 mb-4 text-slate-800 dark:text-slate-200">Why Choose Us?</h2>
    <ul class="list-disc ml-6 mt-2">
        <li><strong>Accuracy:</strong> We utilize standard global formulas alongside regional rules (like Australian Leave Loading).</li>
        <li><strong>Privacy-First:</strong> All calculations happen securely right in your browser. We never save or transmit your salary data.</li>
        <li><strong>Ease of Use:</strong> A modern, intuitive interface means no complicated spreadsheets or confusing jargon.</li>
    </ul>

    <p class="mt-8">Thank you for using Global Leave Calculator. We hope it brings clarity and peace of mind to your workplace planning.</p>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
