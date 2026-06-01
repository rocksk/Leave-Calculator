import re

with open('views/calculator.php', 'r') as f:
    content = f.read()

# Replace classes for dark mode
replacements = {
    'text-slate-900': 'text-slate-900 dark:text-white',
    'text-slate-800': 'text-slate-800 dark:text-slate-200',
    'text-slate-700': 'text-slate-700 dark:text-slate-300',
    'text-slate-600': 'text-slate-600 dark:text-slate-400',
    'text-slate-500': 'text-slate-500 dark:text-slate-400',
    'text-slate-400': 'text-slate-400 dark:text-slate-500',
    'bg-brand-50': 'bg-brand-50 dark:bg-slate-800',
    'text-brand-700': 'text-brand-700 dark:text-brand-400',
    'border-slate-700/50': 'border-slate-700/50 dark:border-slate-600/50',
    'text-slate-100': 'text-slate-100 dark:text-white',
    'text-slate-300': 'text-slate-300 dark:text-slate-400',
}

for old, new in replacements.items():
    if old in content and new not in content:
        content = re.sub(r'\b' + re.escape(old) + r'\b', new, content)

with open('views/calculator.php', 'w') as f:
    f.write(content)

with open('views/layout/footer.php', 'r') as f:
    footer = f.read()

footer = footer.replace('bg-white', 'bg-white dark:bg-slate-800 transition-colors duration-200')
footer = footer.replace('border-slate-200', 'border-slate-200 dark:border-slate-700')
footer = footer.replace('text-slate-500', 'text-slate-500 dark:text-slate-400')

with open('views/layout/footer.php', 'w') as f:
    f.write(footer)
