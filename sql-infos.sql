CREATE DATABASE IF NOT EXISTS snippets DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE user (
	userId INT AUTO_INCREMENT,
	name VARCHAR(50) NULL,
	email VARCHAR(80) NULL,
	pwd VARCHAR(255) NULL,
	CONSTRAINT user_pk PRIMARY KEY (userId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE cat (
	catId INT AUTO_INCREMENT,
	label VARCHAR(50) NULL,
	CONSTRAINT cat_pk PRIMARY KEY (catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE snippet (
	snippetId INT AUTO_INCREMENT,
	title VARCHAR(60) NOT NULL,
	language VARCHAR(40) NULL,
	code TEXT NULL,
	dateCrea DATETIME NULL,
	comment TEXT NULL,
	requirement TINYTEXT NULL,
	userId INT NOT NULL,
	CONSTRAINT snippet_pk PRIMARY KEY (snippetId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
ALTER TABLE snippet
  ADD CONSTRAINT snippet_user_fk FOREIGN KEY (userId) REFERENCES user (userId);

CREATE TABLE snipcat (
	snippetId INT,
	catId INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
ALTER TABLE snipcat
	ADD CONSTRAINT snipcat_snippet_fk FOREIGN KEY (snippetId) REFERENCES snippet (snippetId);
ALTER TABLE snipcat
  ADD CONSTRAINT snipcat_cat_fk FOREIGN KEY (catId) REFERENCES cat (catId);

INSERT INTO `user` (`userId`, `name`, `email`, `pwd`) VALUES (NULL, 'Gilles', 'gilles@test.fr', 'gillou');
INSERT INTO `user` (`userId`, `name`, `email`, `pwd`) VALUES (NULL, 'Matthieu', 'matthieu@test.fr', 'matt');

INSERT INTO `cat` (`catId`, `label`) VALUES (NULL, 'Sécurité');
INSERT INTO `cat` (`catId`, `label`) VALUES (NULL, 'Envoi email');
INSERT INTO `cat` (`catId`, `label`) VALUES (NULL, 'Infos');

INSERT INTO `snippet` (`snippetId`, `title`, `language`, `code`, `dateCrea`, `comment`, `requirement`, `userId`) VALUES (NULL, 'A vérifier', 'PHP', '<?php echo \'test\'; ?>\r\npeut être remplacé par\r\n<?= \'test\'; ?>\r\nA confirmer', '2020-02-08', 'Voir avec Matthieu', NULL, 1);
INSERT INTO `snippet` (`snippetId`, `title`, `language`, `code`, `dateCrea`, `comment`, `requirement`, `userId`) VALUES (NULL, 'HtmlSpecialChar', 'PHP', 'HTMLSPECIALCHAR($_GET[\'variable\'])', '2020-02-08', NULL, NULL, 1);
INSERT INTO `snippet` (`snippetId`, `title`, `language`, `code`, `dateCrea`, `comment`, `requirement`, `userId`) VALUES (NULL, 'Envoyer un mail', 'PHP', 'mail("label@fournisseur", "Sujet", $message, $header);', '2020-02-07', NULL, NULL, 2);
INSERT INTO `snippet` (`snippetId`, `title`, `language`, `code`, `comment`, `requirement`, `userId`) VALUES (NULL, 'Debugage', 'PHP', '<?phg debugueur ?>', NULL, NULL, 2);

INSERT INTO `snipcat` (`snippetId`, `catId`) VALUES (1, 3);
INSERT INTO `snipcat` (`snippetId`, `catId`) VALUES (2, 3);
INSERT INTO `snipcat` (`snippetId`, `catId`) VALUES (3, 3);
INSERT INTO `snipcat` (`snippetId`, `catId`) VALUES (4, 1);
INSERT INTO `snipcat` (`snippetId`, `catId`) VALUES (5, 2);
INSERT INTO `snipcat` (`snippetId`, `catId`) VALUES (7, 1);
INSERT INTO `snipcat` (`snippetId`, `catId`) VALUES (1, 2);

SELECT title, language, code, dateCrea, comment, requirement, name, label
	FROM snippet s, user, snipcat sc, cat c
	WHERE s.snippetId = sc.snippetId AND sc.catId = c.catId;
SELECT title, language, code, dateCrea, comment, requirement, name, label
	FROM snippet s
  JOIN user u ON s.userId = u.userId
	JOIN snipcat sc ON s.snippetId = sc.snippetId
	JOIN cat c ON c.catId = sc.catId;

SELECT snippetId, title, language, code, dateCrea, comment, requirement, userId, catId
	FROM snippet s, snipcat sc
	WHERE s.snippetId = sc.snippetId;
SELECT s.snippetId, title, language, code, dateCrea, comment, requirement, userId, catId
	FROM snippet s
	JOIN snipcat sc ON s.snippetId = sc.snippetId;
