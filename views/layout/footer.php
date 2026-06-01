        </div>
    </main>

    <footer class="bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700 mt-auto transition-colors duration-200">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="flex flex-wrap justify-center gap-6 mb-4 text-sm font-medium text-slate-500 dark:text-slate-400">
                <a href="/about-us" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">About Us</a>
                <a href="/contact-us" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Contact Us</a>
                <a href="/privacy-policy" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Privacy Policy</a>
                <a href="/terms-and-conditions" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Terms & Conditions</a>
            </div>
            <div class="text-center text-slate-500 dark:text-slate-400 text-sm">
                &copy; <?= date('Y') ?> Global Leave Calculator. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Pass backend variables to JS securely -->
    <script>
        window.leaveRuleConfig = <?= json_encode($rule ?? []) ?>;
    </script>
    <script src="/js/calculator.js"></script>
</body>
</html>
