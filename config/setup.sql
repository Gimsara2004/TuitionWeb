-- SmartPhysics A/L Tuition — Database Setup
-- Run this once in phpMyAdmin or MySQL CLI

CREATE DATABASE IF NOT EXISTS smartphysics_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE smartphysics_db;

-- Enrollment requests from students
CREATE TABLE IF NOT EXISTS enrollments (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(120) NOT NULL,
    grade      VARCHAR(80)  DEFAULT '',
    subject    VARCHAR(80)  NOT NULL,
    batch      VARCHAR(80)  DEFAULT '',
    pname      VARCHAR(120) DEFAULT '',
    phone      VARCHAR(30)  NOT NULL,
    message    TEXT,
    status     ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact messages
CREATE TABLE IF NOT EXISTS messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(120) NOT NULL,
    email      VARCHAR(120) DEFAULT '',
    phone      VARCHAR(30)  DEFAULT '',
    message    TEXT         NOT NULL,
    is_read    TINYINT(1)   DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Student feedback (admin approves before showing on site)
CREATE TABLE IF NOT EXISTS feedback (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(120) NOT NULL,
    year_detail VARCHAR(80)  DEFAULT '',
    rating      TINYINT(1)   DEFAULT 5,
    message     TEXT         NOT NULL,
    is_approved TINYINT(1)   DEFAULT 0,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin users
CREATE TABLE IF NOT EXISTS admin_users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(60)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin: username = admin, password = admin123
INSERT IGNORE INTO admin_users (username, password)
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
