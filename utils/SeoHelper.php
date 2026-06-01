<?php

class SeoHelper {
    
    // Seeded random number generator (0 to 1)
    private static function seededRandom($seedStr) {
        $hash = md5($seedStr);
        $int = hexdec(substr($hash, 0, 8));
        return $int / 0xFFFFFFFF;
    }

    // Pick a random element from array based on string seed
    public static function pickVariation($seedStr, $array) {
        $random = self::seededRandom($seedStr);
        $index = floor($random * count($array));
        return $array[$index];
    }

    public static function generateMetaDescription($state, $country) {
        // Needs to be 150-160 characters.
        $vars = [
            "Use our accurate Annual Leave Calculator for $state, $country to estimate your accrued leave, entitlements, and loading instantly. Free, secure, and fast.", // 156 chars (assuming ~15 chars for state/country)
            "Accurately calculate your annual leave entitlements and leave loading in $state, $country. Our free calculator provides instant, secure estimates online.",
            "Easily estimate your paid time off and leave loading with our $state, $country Annual Leave Calculator. Fast, accurate, and completely free to use online."
        ];
        
        $desc = self::pickVariation($state . 'meta', $vars);
        
        // Pad or trim slightly if strictly necessary, but these are generally ~150 chars.
        return $desc;
    }

    public static function generateFaqs($state, $country, $hoursPerWeek = 38) {
        $q1 = self::pickVariation($state . 'q1', [
            "How is annual leave earned in $state?",
            "What is the annual leave accrual process in $state?",
            "How do I earn paid time off in $state?"
        ]);
        $a1 = self::pickVariation($state . 'a1', [
            "Annual leave accumulates progressively based on your ordinary hours worked in $state. Full-time employees typically accrue around four weeks per year.",
            "In $state, your paid time off builds up gradually as you work your standard hours, generally resulting in four weeks of leave per year for full-time staff.",
            "Leave accrues continuously based on your regular hours in $state. A standard full-time worker earns four weeks of paid leave annually."
        ]);

        $accrualRate = round(($hoursPerWeek * 4) / 52, 3);
        $q2 = self::pickVariation($state . 'q2', [
            "How much leave accrues each week?",
            "What is the weekly leave accrual rate?",
            "How many hours of leave do I get per week?"
        ]);
        $a2 = self::pickVariation($state . 'a2', [
            "A full-time employee working a standard $hoursPerWeek-hour week generally accrues around $accrualRate hours of annual leave each week.",
            "If you work a standard $hoursPerWeek-hour week, you will accumulate approximately $accrualRate hours of paid leave every week.",
            "Based on a $hoursPerWeek-hour working week, your leave balance will increase by roughly $accrualRate hours weekly."
        ]);

        $q3 = self::pickVariation($state . 'q3', [
            "Am I entitled to annual leave loading in $state?",
            "Do I get paid leave loading in $state?",
            "Is annual leave loading mandatory in $state?"
        ]);
        $a3 = self::pickVariation($state . 'a3', [
            "You may be entitled to leave loading if it is included in your applicable award, enterprise agreement, or employment contract in $state.",
            "Leave loading depends on your specific employment agreement or modern award in $state. Many workers receive a 17.5% loading rate.",
            "In $state, leave loading is not universally guaranteed. It applies only if specified in your contract or industry award."
        ]);

        $q4 = self::pickVariation($state . 'q4', [
            "What happens to unused annual leave when I leave my job?",
            "Do I get paid out for unused leave if I resign?",
            "Can I cash out my leave when terminating employment?"
        ]);
        $a4 = self::pickVariation($state . 'a4', [
            "Any accrued but unused annual leave must generally be paid out when your employment ends in $state.",
            "When terminating employment in $state, employers are typically required to pay out your accumulated and unused annual leave balance.",
            "Your unused leave balance is considered an earned entitlement and must normally be paid to you upon resignation or termination."
        ]);

        $q5 = self::pickVariation($state . 'q5', [
            "Can annual leave be cashed out in $state?",
            "Is it possible to cash out my leave instead of taking it?",
            "Can I exchange my paid time off for cash?"
        ]);
        $a5 = self::pickVariation($state . 'a5', [
            "Annual leave can only be cashed out if your workplace rules or awards permit it, and you must usually retain a minimum leave balance.",
            "Cashing out leave is subject to strict regulations in $state. It is only allowed if a formal agreement is in place and a minimum balance remains.",
            "In $state, cashing out is sometimes permitted depending on your award, provided you leave a certain amount of time off available in your balance."
        ]);

        return [
            ['question' => $q1, 'answer' => $a1],
            ['question' => $q2, 'answer' => $a2],
            ['question' => $q3, 'answer' => $a3],
            ['question' => $q4, 'answer' => $a4],
            ['question' => $q5, 'answer' => $a5]
        ];
    }

    public static function generateIntro($state, $country) {
        $p1 = self::pickVariation($state . 'p1', [
            "Understanding your annual leave entitlements is important whether you're an employee planning time off or an employer managing workplace obligations in $state.",
            "Managing paid time off correctly is crucial for both staff members and employers operating in $state.",
            "Whether you are looking to book a holiday or handle HR duties, knowing your exact leave entitlements in $state is essential."
        ]);
        
        $p2 = self::pickVariation($state . 'p2', [
            "Our Annual Leave Calculator for $state makes it simple to estimate leave accruals, calculate balances, and determine applicable leave loading.",
            "Use our $state Annual Leave Calculator to quickly work out how much paid time off you have accumulated and estimate your leave loading value.",
            "This calculator helps workers and employers in $state seamlessly track leave accruals and calculate final leave balances."
        ]);

        return "<p class=\"leading-relaxed\">$p1</p>\n<p class=\"leading-relaxed mt-4\">$p2</p>";
    }

    public static function generateConclusion($state, $country) {
        $p1 = self::pickVariation($state . 'c1', [
            "Keeping track of annual leave in $state does not need to be difficult. By understanding how leave accrues, you can better manage your time off.",
            "Monitoring your paid time off balance in $state is straightforward when you understand the basic accrual rules and loading entitlements.",
            "Navigating workplace leave policies in $state is much easier when you have clear visibility into your accrual rates."
        ]);

        $p2 = self::pickVariation($state . 'c2', [
            "Use our Annual Leave Calculator for $state to quickly estimate your leave balance and plan your future holidays with confidence.",
            "Bookmark our $state Leave Calculator to instantly check your accrual rate and accurately plan your next break.",
            "Rely on our free calculator to determine your precise leave entitlements and easily plan your time away from work."
        ]);

        return "<p class=\"leading-relaxed\">$p1</p>\n<p class=\"leading-relaxed mt-4\">$p2</p>";
    }
}
