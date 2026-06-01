<?php require __DIR__ . '/layout/header.php'; ?>

<div class="text-center mb-10">
    <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-3">
        <?php if (isset($isHome) && $isHome): ?>
            Accurate Leave Calculator
        <?php else: ?>
            Leave Calculator for <span class="text-brand-600 dark:text-brand-400"><?= htmlspecialchars($rule['state_name']) ?></span>
        <?php endif; ?>
    </h1>
    <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
        <?php if (isset($isHome) && $isHome): ?>
            Calculate your accrued annual leave and its value instantly using standard global metrics. Select a specific country and state from the menu above for tailored regional calculations.
        <?php else: ?>
            Calculate your accrued annual leave and its value instantly. Based on the standard 
            <span class="font-semibold text-slate-800 dark:text-slate-200"><?= floatval($rule['annual_leave_weeks']) ?> weeks</span> 
            annual leave for <?= htmlspecialchars($rule['state_name']) ?>.
        <?php endif; ?>
    </p>
</div>

<div class="grid lg:grid-cols-12 gap-8 items-start">
    
    <!-- Input Section -->
    <div class="lg:col-span-7 glass-card rounded-2xl p-6 sm:p-8">
        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            Your Details
        </h2>
        
        <form id="calculatorForm" class="space-y-8" onsubmit="event.preventDefault();">
            
            <!-- Salary -->
            <div>
                <div class="flex justify-between items-end mb-2">
                    <label for="salaryInput" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 dark:text-slate-400">Annual Salary ($)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500 dark:text-slate-400 dark:text-slate-500 font-medium">$</span>
                        <input type="number" id="salaryInput" class="block w-32 pl-7 pr-3 py-1.5 text-right text-lg font-bold text-brand-700 dark:text-brand-400 bg-brand-50 dark:bg-slate-800 border-0 rounded-lg focus:ring-2 focus:ring-brand-500 outline-none transition-shadow" value="80000" min="0" step="1000">
                    </div>
                </div>
                <input type="range" id="salarySlider" min="20000" max="250000" step="1000" value="80000">
                <div class="flex justify-between text-xs text-slate-400 dark:text-slate-500 mt-1 font-medium">
                    <span>$20k</span>
                    <span>$250k+</span>
                </div>
            </div>

            <!-- Hours Per Week -->
            <div>
                <div class="flex justify-between items-end mb-2">
                    <label for="hoursInput" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 dark:text-slate-400">Hours Per Week</label>
                    <div class="relative">
                        <input type="number" id="hoursInput" class="block w-24 pr-8 py-1.5 text-right text-lg font-bold text-brand-700 dark:text-brand-400 bg-brand-50 dark:bg-slate-800 border-0 rounded-lg focus:ring-2 focus:ring-brand-500 outline-none transition-shadow" value="<?= floatval($rule['working_hours_per_week']) ?>" min="1" max="80" step="0.5">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 dark:text-slate-400 dark:text-slate-500 font-medium text-sm">hrs</span>
                    </div>
                </div>
                <input type="range" id="hoursSlider" min="1" max="80" step="0.5" value="<?= floatval($rule['working_hours_per_week']) ?>">
                <div class="flex justify-between text-xs text-slate-400 dark:text-slate-500 mt-1 font-medium">
                    <span>1 hr</span>
                    <span>80 hrs</span>
                </div>
            </div>

            <!-- Weeks Worked -->
            <div>
                <div class="flex justify-between items-end mb-2">
                    <label for="weeksInput" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 dark:text-slate-400">Weeks Worked</label>
                    <div class="relative">
                        <input type="number" id="weeksInput" class="block w-24 pr-8 py-1.5 text-right text-lg font-bold text-brand-700 dark:text-brand-400 bg-brand-50 dark:bg-slate-800 border-0 rounded-lg focus:ring-2 focus:ring-brand-500 outline-none transition-shadow" value="26" min="1" max="104" step="1">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 dark:text-slate-400 dark:text-slate-500 font-medium text-sm">wks</span>
                    </div>
                </div>
                <input type="range" id="weeksSlider" min="1" max="104" step="1" value="26">
                <div class="flex justify-between text-xs text-slate-400 dark:text-slate-500 mt-1 font-medium">
                    <span>1 wk</span>
                    <span>104 wks</span>
                </div>
            </div>
            
        </form>
    </div>

    <!-- Results Section -->
    <div class="lg:col-span-5 space-y-6">
        <div class="glass-card rounded-2xl p-6 sm:p-8 bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-xl relative overflow-hidden group">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30 group-hover:opacity-50 transition-opacity duration-700"></div>
            
            <h2 class="text-xl font-bold text-slate-100 dark:text-white mb-8 relative z-10 flex items-center gap-2">
                <svg class="w-5 h-5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Your Accrued Leave
            </h2>
            
            <div class="space-y-6 relative z-10">
                <div class="flex justify-between items-center border-b border-slate-700/50 dark:border-slate-600/50 pb-4">
                    <span class="text-slate-300 dark:text-slate-400 font-medium">Total Leave Hours</span>
                    <span class="text-3xl font-black text-brand-400" id="resultHours">0.00</span>
                </div>
                
                <div class="flex justify-between items-center border-b border-slate-700/50 dark:border-slate-600/50 pb-4">
                    <span class="text-slate-300 dark:text-slate-400 font-medium">Leave Value</span>
                    <span class="text-3xl font-black text-emerald-400" id="resultValue">$0.00</span>
                </div>
                
                <?php if (floatval($rule['leave_loading_percentage']) > 0): ?>
                <div class="flex justify-between items-center border-b border-slate-700/50 dark:border-slate-600/50 pb-4">
                    <span class="text-slate-300 dark:text-slate-400 font-medium flex flex-col">
                        <span>Leave Loading</span>
                        <span class="text-xs text-slate-400 dark:text-slate-500">(<?= floatval($rule['leave_loading_percentage']) ?>%)</span>
                    </span>
                    <span class="text-2xl font-bold text-indigo-400" id="resultLoading">$0.00</span>
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="text-white font-bold text-lg">Total Value</span>
                    <span class="text-4xl font-black text-white" id="resultTotal">$0.00</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if (!empty($rule['notes'])): ?>
        <div class="glass-card rounded-2xl p-5 border-l-4 border-brand-500">
            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-1 flex items-center gap-1">
                <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                State Note
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 dark:text-slate-500 leading-relaxed"><?= htmlspecialchars($rule['notes']) ?></p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php 
if (isset($isHome) && $isHome) {
    require __DIR__ . '/home_content.php';
} else {
    require __DIR__ . '/state_content.php';
}
?>

<?php require __DIR__ . '/layout/footer.php'; ?>
