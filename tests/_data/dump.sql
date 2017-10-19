PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: article
DROP TABLE IF EXISTS article;
CREATE TABLE article (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title STRING,
  shortText STRING,
  fullText TEXT,
  socialNetworksText STRING
);

-- Table: static_page
DROP TABLE IF EXISTS static_page;
CREATE TABLE static_page (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  slug STRING,
  description TEXT
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
