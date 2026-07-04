-- Go Deep Africa Safari — Cultural Safari section
-- cPanel » phpMyAdmin » select your database » SQL » paste all » Go. Safe to re-run. UTF-8.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `cultural_experiences` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `region` VARCHAR(255) NULL,
  `tribe` VARCHAR(255) NULL,
  `tagline` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `highlights` TEXT NULL,
  `activities` TEXT NULL,
  `price` DECIMAL(10,2) NULL,
  `duration` VARCHAR(255) NULL,
  `best_time` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `gallery` JSON NULL,
  `icon` VARCHAR(255) NULL,
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `display_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cultural_experiences_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cultural_reviews` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cultural_experience_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `location` VARCHAR(255) NULL,
  `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5,
  `comment` TEXT NOT NULL,
  `is_approved` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `cultural_reviews_exp_idx` (`cultural_experience_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `cultural_reviews`;
DELETE FROM `cultural_experiences`;

INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (1,'Maasai Cultural Experience','maasai-cultural-experience','Arusha · Longido · Ngorongoro','Maasai','Meet East Africa\'s most iconic warrior-herders.','Spend time in an authentic Maasai boma and discover a semi-nomadic way of life that has endured for centuries. Learn about cattle-herding traditions, the role of warriors (morans), and the community\'s deep knowledge of the land, while your hosts share their music, dress and daily rituals.','Authentic boma (homestead) visit
Adumu "jumping" warrior dance
Handmade Maasai beadwork
Maasai medicinal plant walk','Traditional dances
Village visits (Boma tours)
Beadwork workshops
Traditional food experiences',45,'Half day – Full day','All year',NULL,NULL,'fa-people-group',1,1,1,NOW(),NOW());
INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (2,'Hadzabe Bushmen Experience','hadzabe-bushmen-experience','Lake Eyasi','Hadzabe','Join one of the world\'s last true hunter-gatherer tribes.','The Hadzabe are among the last hunter-gatherer peoples on earth, living around Lake Eyasi much as their ancestors did. Set out at dawn with the hunters, learn to make fire by hand, and experience a culture with no calendars, chiefs or possessions — only an extraordinary bond with the bush.','Dawn hunt with the tribe
Fire-making by hand
Bow-and-arrow craft
Click-language interaction','Hunting excursions
Traditional survival techniques
Storytelling sessions
Cultural interaction programs',55,'Half day (early morning)','June – February',NULL,NULL,'fa-bow-arrow',1,1,2,NOW(),NOW());
INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (3,'Datoga Cultural Experience','datoga-cultural-experience','Lake Eyasi','Datoga','Master blacksmiths and pastoralists of the Rift Valley.','Neighbours of the Hadzabe, the Datoga are skilled pastoralists and renowned blacksmiths who forge arrowheads, jewellery and tools from scrap metal using traditional bellows. Visit a homestead to see their craftsmanship and learn about their proud, self-reliant culture.','Live blacksmith demonstration
Handcrafted brass jewellery
Traditional homestead visit','Blacksmith demonstrations
Traditional craftsmanship
Local community visits',40,'Half day','June – February',NULL,NULL,'fa-hammer',0,1,3,NOW(),NOW());
INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (4,'Chagga Cultural Tour','chagga-cultural-tour','Mount Kilimanjaro Region','Chagga','Coffee, caves and mountain traditions on Kilimanjaro\'s slopes.','The Chagga people farm the fertile southern slopes of Kilimanjaro and are famous for their coffee, ingenuity and underground defence caves dug generations ago. Tour a family coffee plantation from bean to cup, explore the historic Chagga caves, and taste home-brewed banana beer.','Historic Chagga defence caves
Bean-to-cup coffee tour
Banana beer tasting
Lush Kilimanjaro foothills','Chagga caves
Coffee plantation tours
Traditional banana beer making
Local food experiences',50,'Half day – Full day','All year',NULL,NULL,'fa-mug-hot',1,1,4,NOW(),NOW());
INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (5,'Iraqw Cultural Experience','iraqw-cultural-experience','Karatu','Iraqw','Farmers of the highlands near Ngorongoro.','The Iraqw people of the Karatu highlands are industrious farmers with distinctive architecture and customs. Walk through green villages between Lake Manyara and Ngorongoro, join everyday farming life, and enjoy traditional dances and warm hospitality.','Highland village walk
Hands-on farming activities
Traditional Iraqw dance','Traditional farming activities
Cultural dances
Local village tours',35,'Half day','All year',NULL,NULL,'fa-wheat-awn',0,1,5,NOW(),NOW());
INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (6,'Sukuma Cultural Experience','sukuma-cultural-experience','Mwanza · Shinyanga','Sukuma','Tanzania\'s largest tribe — drums, dance and the famous snake dance.','Around Lake Victoria live the Sukuma, Tanzania\'s largest ethnic group, celebrated for energetic drumming and the spectacular Bugobogobo snake dance. Visit the Sukuma Museum near Mwanza and witness ceremonies bursting with rhythm, colour and storytelling.','Bugobogobo snake dance
Thunderous traditional drumming
Sukuma living museum','Bugobogobo snake dance
Traditional drumming performances
Local ceremonies and storytelling',40,'Half day','All year',NULL,NULL,'fa-drum',0,1,6,NOW(),NOW());
INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (7,'Makonde Cultural Experience','makonde-cultural-experience','Southern Tanzania','Makonde','World-renowned wood carvers of the south.','The Makonde are internationally famous for their intricate ebony sculpture, including the flowing "Ujamaa" tree-of-life carvings. Meet master carvers, try your hand at the craft, and explore a rich artistic tradition rooted in myth and community.','Master ebony carvers
Hands-on carving workshop
Ujamaa "tree of life" art','Wood carving workshops
Traditional arts and crafts
Cultural exhibitions',40,'Half day','All year',NULL,NULL,'fa-hand-fist',0,1,7,NOW(),NOW());
INSERT INTO `cultural_experiences` (`id`,`name`,`slug`,`region`,`tribe`,`tagline`,`description`,`highlights`,`activities`,`price`,`duration`,`best_time`,`image`,`gallery`,`icon`,`is_featured`,`is_active`,`display_order`,`created_at`,`updated_at`) VALUES (8,'Bagamoyo Historical and Cultural Tour','bagamoyo-historical-and-cultural-tour','Bagamoyo (Coast)','Swahili Coast','Swahili heritage and a poignant slave-trade history.','Once a key port of the East African slave and ivory trade and the former capital of German East Africa, Bagamoyo is a UNESCO-tentative town layered with history. Walk its old streets and caravan sites, visit the arts college, and soak up centuries of Swahili culture on the Indian Ocean.','Historic slave-trade sites
Bagamoyo arts college
Swahili old town & Kaole ruins','Historic slave trade sites
Traditional arts centers
Swahili cultural experiences',45,'Full day','June – February',NULL,NULL,'fa-landmark-dome',0,1,8,NOW(),NOW());

INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (1,1,'Sophie M.','France',5,'Unforgettable — the warriors welcomed us like family and the dancing was incredible.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (2,1,'David R.','USA',5,'A genuine, respectful cultural exchange. The beadwork workshop was a highlight for my kids.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (3,2,'Lukas B.','Germany',5,'The most authentic experience of our whole safari. Humbling and fascinating.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (4,3,'Elena P.','Italy',5,'Watching them forge arrowheads by hand was amazing. Beautiful jewellery too.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (5,4,'Grace W.','UK',5,'Roasting our own coffee and exploring the caves was such a fun, tasty day out.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (6,5,'Marco T.','Switzerland',4,'A relaxed, genuine village visit on the way to the Serengeti. Lovely people.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (7,6,'Anna K.','Netherlands',5,'The snake dance and drumming were mesmerising. A side of Tanzania few tourists see.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (8,7,'James O.','Canada',5,'Bought a carving straight from the artist. Incredible skill and warm hospitality.',1,NOW(),NOW());
INSERT INTO `cultural_reviews` (`id`,`cultural_experience_id`,`name`,`location`,`rating`,`comment`,`is_approved`,`created_at`,`updated_at`) VALUES (9,8,'Fatima S.','UAE',5,'Moving and educational. A meaningful stop that pairs perfectly with Zanzibar.',1,NOW(),NOW());

SET FOREIGN_KEY_CHECKS=1;

SET @b = (SELECT COALESCE(MAX(`batch`),0)+1 FROM `migrations`);
INSERT INTO `migrations` (`migration`,`batch`) SELECT '2026_07_04_000003_create_cultural_experiences_tables', @b FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM (SELECT `migration` FROM `migrations`) x WHERE x.`migration` = '2026_07_04_000003_create_cultural_experiences_tables');
