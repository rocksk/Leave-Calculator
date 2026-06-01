<?php
/**
 * Privacy Policy Page
 * AdSense compliant privacy policy detailing data collection and cookies.
 */
require __DIR__ . '/layout/header.php'; 
?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 prose prose-slate dark:prose-invert">
    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Privacy Policy</h1>
    <p>Last updated: <?php echo date('F Y'); ?></p>
    
    <h2 class="text-2xl font-semibold mt-8 mb-4 text-slate-800 dark:text-slate-200">1. Introduction</h2>
    <p>Welcome to Global Leave Calculator. We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you as to how we look after your personal data when you visit our website and tell you about your privacy rights.</p>

    <h2 class="text-2xl font-semibold mt-8 mb-4 text-slate-800 dark:text-slate-200">2. The Data We Collect About You</h2>
    <p>We may collect, use, store and transfer different kinds of personal data about you. However, our calculator functions primarily anonymously. We do not store the salary or personal calculation metrics you input into the calculator on our servers.</p>

    <h2 class="text-2xl font-semibold mt-8 mb-4 text-slate-800 dark:text-slate-200">3. Google AdSense and Cookies</h2>
    <p>We use Google AdSense to display advertisements on our site. Google, as a third-party vendor, uses cookies to serve ads on our site.</p>
    <ul class="list-disc ml-6 mt-2">
        <li>Google's use of the DART cookie enables it to serve ads to our users based on previous visits to our site and other sites on the Internet.</li>
        <li>Users may opt-out of the use of the DART cookie by visiting the Google Ad and Content Network privacy policy.</li>
    </ul>
    <p class="mt-2">Third-party vendors, including Google, use cookies to serve ads based on a user's prior visits to your website or other websites. You can opt out of personalized advertising by visiting <a href="https://www.google.com/settings/ads" class="text-brand-600 hover:underline" target="_blank" rel="noopener noreferrer">Ads Settings</a>.</p>

    <h2 class="text-2xl font-semibold mt-8 mb-4 text-slate-800 dark:text-slate-200">4. Third-Party Links</h2>
    <p>This website may include links to third-party websites, plug-ins and applications. Clicking on those links or enabling those connections may allow third parties to collect or share data about you.</p>

    <h2 class="text-2xl font-semibold mt-8 mb-4 text-slate-800 dark:text-slate-200">5. Contact Details</h2>
    <p>If you have any questions about this privacy policy or our privacy practices, please contact us via our <a href="/contact-us" class="text-brand-600 hover:underline">Contact Us</a> page.</p>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
