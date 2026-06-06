CREATE DATABASE IF NOT EXISTS designova;
USE designova;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS submissions;
DROP TABLE IF EXISTS teams;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS settings;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NULL,
    role ENUM('admin', 'juri', 'peserta') DEFAULT 'peserta',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS teams (
    id VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
    user_id VARCHAR(36) NOT NULL,
    team_name VARCHAR(255) NOT NULL,
    members JSON NOT NULL,
    is_active TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS submissions (
    id VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
    team_id VARCHAR(36) NOT NULL UNIQUE,
    figma_link VARCHAR(255) NOT NULL,
    docs_link VARCHAR(255) NOT NULL,
    score_ui DECIMAL(5,2) NOT NULL DEFAULT 0,
    score_ux DECIMAL(5,2) NOT NULL DEFAULT 0,
    score_figma DECIMAL(5,2) NOT NULL DEFAULT 0,
    final_score DECIMAL(5,2) GENERATED ALWAYS AS (
        (score_ui * 0.5) + (score_ux * 0.4) + (score_figma * 0.1)
    ) STORED,
    feedback TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS payments (
    id VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
    team_id VARCHAR(36) NOT NULL,
    amount INT NOT NULL,
    sender_name VARCHAR(255) NULL,
    sender_bank VARCHAR(255) NULL,
    status ENUM('pending', 'confirmed', 'rejected') DEFAULT 'pending',
    pending_team_id VARCHAR(36) GENERATED ALWAYS AS (CASE WHEN status = 'pending' THEN team_id ELSE NULL END) STORED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_pending_team (pending_team_id),
    FOREIGN KEY (team_id) REFERENCES teams(id)
);

CREATE TABLE IF NOT EXISTS settings (
    id TINYINT NOT NULL DEFAULT 1,
    is_registration_open BOOLEAN DEFAULT TRUE,
    base_price INT NOT NULL DEFAULT 50000,
    submission_deadline DATETIME NULL,
    is_winner_published BOOLEAN DEFAULT FALSE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CHECK (id = 1) 
);

-- Seed default settings
INSERT INTO settings (id, is_registration_open, base_price, submission_deadline, is_winner_published)
VALUES (1, TRUE, 50000, '2026-06-5 10:00:00', FALSE)
ON DUPLICATE KEY UPDATE is_registration_open=VALUES(is_registration_open), base_price=VALUES(base_price), submission_deadline=VALUES(submission_deadline), is_winner_published=VALUES(is_winner_published);

-- Seed admin user (password: admin123)
INSERT INTO users (id, name, email, password, role)
VALUES (
    UUID(),
    'Administrator',
    'admin@designova.local',
    '$2y$10$e0NR6Zr1Pp4K1xk4h1tXxO7KZb0Yf1j9uKq3hK8pQ9qZbFQ5Yt6y',
    'admin'
)
ON DUPLICATE KEY UPDATE name=VALUES(name), email=VALUES(email), password=VALUES(password), role=VALUES(role);

-- Seed 1 Peserta User (password: admin123)
SET @peserta_id = 'e0f47e24-3c81-11eb-adc1-0242ac120002';
INSERT INTO users (id, name, email, password, role)
VALUES (
    @peserta_id,
    'Budi Pratama',
    'peserta@designova.local',
    '$2y$10$e0NR6Zr1Pp4K1xk4h1tXxO7KZb0Yf1j9uKq3hK8pQ9qZbFQ5Yt6y',
    'peserta'
)
ON DUPLICATE KEY UPDATE name=VALUES(name), email=VALUES(email), password=VALUES(password), role=VALUES(role);

-- Seed 1 Team for the Peserta User
SET @team_id = 'e1075676-3c81-11eb-adc1-0242ac120002';
INSERT INTO teams (id, user_id, team_name, members, is_active)
VALUES (
    @team_id,
    @peserta_id,
    'Tim AeroDesign',
    '["Budi Pratama", "Siti Aminah", "Joko Susilo"]',
    1
)
ON DUPLICATE KEY UPDATE user_id=VALUES(user_id), team_name=VALUES(team_name), members=VALUES(members), is_active=VALUES(is_active);

-- Seed 1 Submission for the Team
SET @submission_id = 'e11d67bc-3c81-11eb-adc1-0242ac120002';
INSERT INTO submissions (id, team_id, figma_link, docs_link, score_ui, score_ux, score_figma, feedback)
VALUES (
    @submission_id,
    @team_id,
    'https://www.figma.com/proto/mockup-aerodesign',
    'https://docs.google.com/document/d/report-aerodesign',
    85.00,
    90.00,
    88.00,
    'Desain visual sangat rapi dan riset UX sangat komprehensif.'
)
ON DUPLICATE KEY UPDATE team_id=VALUES(team_id), figma_link=VALUES(figma_link), docs_link=VALUES(docs_link), score_ui=VALUES(score_ui), score_ux=VALUES(score_ux), score_figma=VALUES(score_figma), feedback=VALUES(feedback);
