<?php
/**
 * Contact Us Page
 * Displays contact form and email support information.
 */
require __DIR__ . '/layout/header.php'; 
?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Contact Us</h1>
    <p class="text-lg text-slate-600 dark:text-slate-400 mb-8">Have a question, feedback, or spotted an issue with a calculation? We'd love to hear from you.</p>

    <div class="grid md:grid-cols-2 gap-12">
        <div class="glass-card p-8 rounded-2xl dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">
            <form action="#" method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-brand-500 focus:ring-brand-500 p-2 border">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-brand-500 focus:ring-brand-500 p-2 border">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Message</label>
                    <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-brand-500 focus:ring-brand-500 p-2 border"></textarea>
                </div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-colors">
                    Send Message
                </button>
            </form>
            <p class="text-xs text-slate-500 mt-4">* This form is currently for demonstration purposes. Please reach out via email instead.</p>
        </div>

        <div class="space-y-8">
            <div>
                <h3 class="text-lg font-medium text-slate-900 dark:text-white">Email Support</h3>
                <p class="mt-2 text-slate-600 dark:text-slate-400">For all inquiries, please email us directly at:</p>
                <a href="mailto:support@globalleavecalculator.com" class="mt-1 text-brand-600 dark:text-brand-400 hover:underline font-medium block">support@globalleavecalculator.com</a>
            </div>
            <div>
                <h3 class="text-lg font-medium text-slate-900 dark:text-white">Business Inquiries</h3>
                <p class="mt-2 text-slate-600 dark:text-slate-400">Interested in partnering with us or advertising? Get in touch via the email above.</p>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
