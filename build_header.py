usa_states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming']

canada_provinces = ['Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland and Labrador', 'Nova Scotia', 'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan']

def make_link(country, state):
    slug = state.lower().replace(' ', '-')
    return f'<a href="/country/{country}/leave-calculator-for-{slug}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-slate-700">{state}</a>'

usa_links = '\n'.join('                                    ' + make_link('usa', s) for s in usa_states)
canada_links = '\n'.join('                                    ' + make_link('canada', s) for s in canada_provinces)

header_content = f'''<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Global Leave Calculator') ?></title>
    <meta name="description" content="Calculate your annual leave accrual and value accurately.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {{
            darkMode: 'class',
            theme: {{
                extend: {{
                    fontFamily: {{ sans: ['Inter', 'sans-serif'], }},
                    colors: {{ brand: {{ 50: '#f0f9ff', 100: '#e0f2fe', 500: '#0ea5e9', 600: '#0284c7', 900: '#0c4a6e', }} }}
                }}
            }}
        }}
    </script>
    
    <style>
        input[type=range] {{ -webkit-appearance: none; width: 100%; background: transparent; }}
        input[type=range]::-webkit-slider-thumb {{ -webkit-appearance: none; height: 20px; width: 20px; border-radius: 50%; background: #0ea5e9; cursor: pointer; margin-top: -8px; box-shadow: 0 0 10px rgba(14, 165, 233, 0.5); transition: transform 0.1s; }}
        input[type=range]::-webkit-slider-thumb:hover {{ transform: scale(1.1); }}
        input[type=range]::-webkit-slider-runnable-track {{ width: 100%; height: 6px; cursor: pointer; background: #e2e8f0; border-radius: 3px; }}
        .dark input[type=range]::-webkit-slider-runnable-track {{ background: #334155; }}
        input[type=range]:focus {{ outline: none; }}
        
        .glass-card {{
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }}
        .dark .glass-card {{
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid rgba(255,255,255,0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
        }}
        
        /* Dark mode toggler script */
        function toggleDarkMode() {{
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }}
        
        // On load, apply saved theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {{
            document.documentElement.classList.add('dark');
        }} else {{
            document.documentElement.classList.remove('dark');
        }}
    </style>
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
{usa_links}
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
{canada_links}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar {{ width: 6px; }}
        .custom-scrollbar::-webkit-scrollbar-track {{ background: transparent; }}
        .custom-scrollbar::-webkit-scrollbar-thumb {{ background: #cbd5e1; border-radius: 10px; }}
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {{ background: #475569; }}
    </style>
    
    <main class="flex-grow relative transition-colors duration-200">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-brand-100 dark:bg-brand-900/30 mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70"></div>
            <div class="absolute top-20 -left-20 w-72 h-72 rounded-full bg-indigo-100 dark:bg-indigo-900/30 mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
'''

with open('views/layout/header.php', 'w') as f:
    f.write(header_content)
