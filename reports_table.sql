-- Reports table for user feedback and system reports
CREATE TABLE IF NOT EXISTS reports (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  email VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  message TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
