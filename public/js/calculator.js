document.addEventListener('DOMContentLoaded', () => {
    
    // Inputs and Sliders
    const elements = {
        salaryInput: document.getElementById('salaryInput'),
        salarySlider: document.getElementById('salarySlider'),
        hoursInput: document.getElementById('hoursInput'),
        hoursSlider: document.getElementById('hoursSlider'),
        weeksInput: document.getElementById('weeksInput'),
        weeksSlider: document.getElementById('weeksSlider'),
        
        resultHours: document.getElementById('resultHours'),
        resultValue: document.getElementById('resultValue'),
        resultLoading: document.getElementById('resultLoading'),
        resultTotal: document.getElementById('resultTotal')
    };

    // Configuration from backend
    const config = window.leaveRuleConfig || {};
    const annualLeaveWeeks = parseFloat(config.annual_leave_weeks) || 4;
    const leaveLoadingPercentage = parseFloat(config.leave_loading_percentage) || 0;
    
    // Sync Input and Slider
    function sync(inputEl, sliderEl) {
        inputEl.addEventListener('input', () => {
            sliderEl.value = inputEl.value;
            calculate();
        });
        sliderEl.addEventListener('input', () => {
            inputEl.value = sliderEl.value;
            calculate();
        });
    }

    sync(elements.salaryInput, elements.salarySlider);
    sync(elements.hoursInput, elements.hoursSlider);
    sync(elements.weeksInput, elements.weeksSlider);

    // Number formatter
    const currencyFormatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    const numberFormatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    // Core Logic
    function calculate() {
        const salary = parseFloat(elements.salaryInput.value) || 0;
        const hoursPerWeek = parseFloat(elements.hoursInput.value) || 0;
        const weeksWorked = parseFloat(elements.weeksInput.value) || 0;

        if (hoursPerWeek <= 0) return;

        // Formula Implementation
        const accrualPerWeek = (annualLeaveWeeks * hoursPerWeek) / 52;
        const totalLeaveHours = accrualPerWeek * weeksWorked;
        
        const hourlyRate = salary / (52 * hoursPerWeek);
        const leaveValue = totalLeaveHours * hourlyRate;
        
        let leaveLoadingValue = 0;
        if (leaveLoadingPercentage > 0) {
            leaveLoadingValue = leaveValue * (leaveLoadingPercentage / 100);
        }

        const totalValue = leaveValue + leaveLoadingValue;

        // Update DOM
        animateValue(elements.resultHours, totalLeaveHours, numberFormatter);
        animateValue(elements.resultValue, leaveValue, currencyFormatter);
        
        if (elements.resultLoading) {
            animateValue(elements.resultLoading, leaveLoadingValue, currencyFormatter);
            animateValue(elements.resultTotal, totalValue, currencyFormatter);
        }
    }

    // Small animation for value updates
    function animateValue(element, newValue, formatter) {
        if (!element) return;
        
        // Just directly setting it for snappy real-time feel
        element.textContent = formatter.format(newValue);
        
        // Optional subtle pop effect
        element.style.transform = 'scale(1.05)';
        element.style.color = '#38bdf8'; // light blue tint
        
        setTimeout(() => {
            element.style.transform = 'scale(1)';
            element.style.color = ''; // reset to class color
            element.style.transition = 'transform 0.15s ease-out, color 0.15s ease-out';
        }, 150);
    }

    // Initial calculation
    calculate();
});
