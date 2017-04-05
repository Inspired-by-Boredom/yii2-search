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

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
