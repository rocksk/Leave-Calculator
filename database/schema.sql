CREATE TABLE IF NOT EXISTS leave_rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    country_slug VARCHAR(255) NOT NULL,
    state_slug VARCHAR(255) NOT NULL,
    state_name VARCHAR(255) NOT NULL,
    annual_leave_weeks DECIMAL(5,2) NOT NULL DEFAULT 4.00,
    accrual_rate_per_week DECIMAL(10,5) NOT NULL DEFAULT 0.07692, /* roughly 4/52 */
    leave_loading_percentage DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    working_hours_per_week DECIMAL(5,2) NOT NULL DEFAULT 38.00,
    notes TEXT,
    UNIQUE KEY unique_country_state (country_slug, state_slug)
);

-- Insert dummy data for USA (few states)
INSERT INTO leave_rules (country_slug, state_slug, state_name, annual_leave_weeks, working_hours_per_week) VALUES
('usa', 'california', 'California', 2.00, 40.00),
('usa', 'texas', 'Texas', 2.00, 40.00),
('usa', 'new-york', 'New York', 2.00, 40.00),
('usa', 'florida', 'Florida', 2.00, 40.00)
ON DUPLICATE KEY UPDATE annual_leave_weeks=VALUES(annual_leave_weeks);

-- Insert dummy data for Canada (few provinces)
INSERT INTO leave_rules (country_slug, state_slug, state_name, annual_leave_weeks, working_hours_per_week) VALUES
('canada', 'alberta', 'Alberta', 2.00, 40.00),
('canada', 'ontario', 'Ontario', 2.00, 44.00),
('canada', 'british-columbia', 'British Columbia', 2.00, 40.00)
ON DUPLICATE KEY UPDATE annual_leave_weeks=VALUES(annual_leave_weeks);

-- Insert dummy data for Australia (all 6 states + 2 territories)
INSERT INTO leave_rules (country_slug, state_slug, state_name, annual_leave_weeks, leave_loading_percentage, working_hours_per_week) VALUES
('australia', 'queensland', 'Queensland', 4.00, 17.50, 38.00),
('australia', 'new-south-wales', 'New South Wales', 4.00, 17.50, 38.00),
('australia', 'victoria', 'Victoria', 4.00, 17.50, 38.00),
('australia', 'tasmania', 'Tasmania', 4.00, 17.50, 38.00),
('australia', 'south-australia', 'South Australia', 4.00, 17.50, 38.00),
('australia', 'western-australia', 'Western Australia', 4.00, 17.50, 38.00)
ON DUPLICATE KEY UPDATE annual_leave_weeks=VALUES(annual_leave_weeks);
