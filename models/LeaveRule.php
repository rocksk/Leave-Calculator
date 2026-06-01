<?php

require_once __DIR__ . '/../config/database.php';

/**
 * LeaveRule Model
 * 
 * Handles database operations related to regional leave entitlements and rules.
 */
class LeaveRule {
    
    /**
     * Retrieves the specific leave rules for a given country and state.
     * 
     * @param string $countrySlug The URL-friendly country identifier (e.g., 'australia')
     * @param string $stateSlug The URL-friendly state identifier (e.g., 'victoria')
     * @return array|null An associative array of leave rules or null if not found
     */
    public static function getRuleByCountryAndState($countrySlug, $stateSlug) {
        try {
            $pdo = getDatabaseConnection();
            
            $stmt = $pdo->prepare('SELECT * FROM leave_rules WHERE country_slug = :country AND state_slug = :state LIMIT 1');
            $stmt->execute([
                'country' => $countrySlug,
                'state' => $stateSlug
            ]);
            
            return $stmt->fetch();
        } catch (\PDOException $e) {
            // Handle error or return null if DB not created yet (for gracefully failing locally without DB)
            return null; 
        }
    }
    /**
     * Retrieves all leave rules for sitemap generation.
     * 
     * @return array Array of all leave rules
     */
    public static function getAllRules() {
        try {
            $pdo = getDatabaseConnection();
            $stmt = $pdo->query('SELECT country_slug, state_slug FROM leave_rules');
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            return []; 
        }
    }
}
