/* install li-de database */
CREATE TABLE IF NOT EXISTS #__groups (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT "unique ID",
  `parent` varchar(40) DEFAULT "" COMMENT "parent group alias",
  `grouptype` varchar(20) DEFAULT "group" COMMENT "group, meta",
  `formal` varchat(20) DEFAULT "adhoc" COMMENT "informal, formal, adhoc",
  `title` varchar(120) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL COMMENT "csoport megnevezése",
  `alias` varchar(40) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL COMMENT "csoport URL alias",
  `logo` varchar(120) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL COMMENT "csoport logo URL",
  `intro` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL COMMENT "csoport leírása",
  `description` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL COMMENT "csoport leírása",
  `status` varchar(20) NOT NULL DEFAULT "proporse" COMMENT "proporse, active, closed, archived",
  `policies` text  CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL COMMENT "groups poicies",
  `creator` int(11) NOT NULL COMMENT "user_id",
  `created` datetime NOT NULL COMMENT "time of created",
  `closer` int(11) NOT NULL COMMENT "user_id",
  `closed` datetime NOT NULL COMMENT "time of close",
  `archiver` int(11) NOT NULL COMMENT "user_id",
  `archived` datetime NOT NULL COMMENT "time of archive",
  PRIMARY KEY (`id`)
) 
