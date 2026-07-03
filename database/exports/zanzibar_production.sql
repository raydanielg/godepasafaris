-- Go Deep Africa Safari — Zanzibar content + Safari menu-link fix
-- Import via cPanel » phpMyAdmin » (select your database) » SQL tab » paste » Go.
-- Safe to run once. UTF-8.

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `zanzibar_activities` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `icon` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `price` DECIMAL(10,2) NULL,
  `duration` VARCHAR(255) NULL,
  `best_time` VARCHAR(255) NULL,
  `details` TEXT NULL,
  `display_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `zanzibar_activities_category_index` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `zanzibar_activities`;
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('beaches','Nungwi Beach','Zanzibar\'s liveliest northern beach — swimmable at all tides, famous sunsets, dhow cruises and vibrant nightlife.','fa-umbrella-beach',NULL,NULL,NULL,'Jun – Oct, Dec – Feb','Sunset dhow cruise
Diving & snorkelling
Turtle aquarium',1,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('beaches','Kendwa Beach','Calm, deep water you can swim day or night, powder-white sand and the famous full-moon beach parties.','fa-water',NULL,NULL,NULL,'Jun – Oct, Dec – Feb','Swimming
Sunset sailing
Beach parties',2,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('beaches','Paje Beach','The kitesurfing capital of the island — a wide turquoise lagoon and a relaxed, bohemian village scene.','fa-wind',NULL,NULL,NULL,'Jun – Sep (windy)','Kitesurfing
Paddleboarding
Beach yoga',3,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('beaches','Jambiani Beach','An authentic fishing and seaweed-farming village with tranquil turquoise shallows and a slow island pace.','fa-fish',NULL,NULL,NULL,'Jun – Oct, Dec – Feb','Village walks
Seaweed farm tour
Snorkelling',4,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('beaches','Matemwe Beach','The gateway to Mnemba Atoll — pristine reefs, barefoot-luxury lodges and world-class diving.','fa-mask',NULL,NULL,NULL,'Jun – Oct, Dec – Feb','Mnemba snorkelling
Scuba diving
Dolphin spotting',5,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('beaches','Kiwengwa Beach','A long sweep of white sand backed by resorts and coral caves — ideal for watersports and easy relaxation.','fa-sun',NULL,NULL,NULL,'Jun – Oct, Dec – Feb','Watersports
Coral cave visit
Spa & resorts',6,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('stone_town','House of Wonders (Beit-el-Ajaib)','A landmark 19th-century sultan\'s palace on the seafront — the first building in East Africa with electricity and a lift.','fa-landmark',NULL,NULL,NULL,NULL,NULL,7,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('stone_town','The Old Fort (Ngome Kongwe)','The oldest building in Stone Town, an Omani-era fortress now hosting a cultural centre and open-air amphitheatre.','fa-chess-rook',NULL,NULL,NULL,NULL,NULL,8,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('stone_town','Freddie Mercury Museum','A tribute to the Queen frontman, born Farrokh Bulsara in Zanzibar, tracing his island roots and rise to fame.','fa-music',NULL,NULL,NULL,NULL,NULL,9,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('stone_town','Former Slave Market','A moving memorial and museum on the site of the world\'s last open slave market — essential to understanding the island\'s history.','fa-dove',NULL,NULL,NULL,NULL,NULL,10,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('stone_town','Anglican Cathedral (Christ Church)','Built to commemorate the abolition of slavery, its altar stands where the whipping post once did.','fa-place-of-worship',NULL,NULL,NULL,NULL,NULL,11,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('stone_town','Darajani Market','The beating heart of Stone Town — a bustling bazaar of spices, tropical fruit, fish and everyday island life.','fa-store',NULL,NULL,NULL,NULL,NULL,12,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('stone_town','Sultan\'s Palace Museum','The former royal residence, now a museum of the Zanzibar sultanate\'s furnishings, portraits and history.','fa-crown',NULL,NULL,NULL,NULL,NULL,13,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('culture','Swahili Cooking Classes',NULL,'fa-utensils',NULL,NULL,NULL,NULL,NULL,14,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('culture','Local Village Tours',NULL,'fa-people-roof',NULL,NULL,NULL,NULL,NULL,15,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('culture','Cultural Performances',NULL,'fa-masks-theater',NULL,NULL,NULL,NULL,NULL,16,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('culture','Taarab Music Experiences',NULL,'fa-guitar',NULL,NULL,NULL,NULL,NULL,17,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('culture','Traditional Dhow Building',NULL,'fa-sailboat',NULL,NULL,NULL,NULL,NULL,18,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('culture','Henna Art',NULL,'fa-hand-sparkles',NULL,NULL,NULL,NULL,NULL,19,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('culture','Swahili Architecture Tours',NULL,'fa-archway',NULL,NULL,NULL,NULL,NULL,20,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('spices','Clove Plantations','Zanzibar was once the world\'s leading clove producer — the scent still defines the island.','fa-seedling',NULL,NULL,NULL,NULL,NULL,21,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('spices','Cinnamon Experiences','See how bark becomes the spice, and taste the difference between leaf, root and bark.','fa-tree',NULL,NULL,NULL,NULL,NULL,22,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('spices','Vanilla Farms','Discover how hand-pollinated orchids produce one of the world\'s most prized flavours.','fa-leaf',NULL,NULL,NULL,NULL,NULL,23,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('spices','Tropical Fruit Tasting','Sample jackfruit, custard apple, rambutan, star fruit and more, freshly picked.','fa-apple-whole',NULL,NULL,NULL,NULL,NULL,24,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('spices','Organic Cooking','Turn just-harvested spices into a traditional Swahili meal with a local family.','fa-mortar-pestle',NULL,NULL,NULL,NULL,NULL,25,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('spices','Medicinal Plants','Learn the traditional healing uses of the island\'s herbs, roots and barks.','fa-mortar-pestle',NULL,NULL,NULL,NULL,NULL,26,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('turtle','Baraka Natural Aquarium','A natural tidal lagoon in Nungwi caring for rescued sea turtles, with ethical, guided feeding.','fa-hand-holding-heart',NULL,NULL,NULL,NULL,NULL,27,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('turtle','Mnarani Marine Turtle Conservation','A community conservation pond protecting green and hawksbill turtles and releasing hatchlings to the ocean.','fa-shield-heart',NULL,NULL,NULL,NULL,NULL,28,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Snorkelling',NULL,'fa-mask',NULL,NULL,NULL,NULL,NULL,29,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Scuba Diving',NULL,'fa-water',NULL,NULL,NULL,NULL,NULL,30,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Deep Sea Fishing',NULL,'fa-fish-fins',NULL,NULL,NULL,NULL,NULL,31,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Dolphin Tours (Kizimkazi)',NULL,'fa-fish',NULL,NULL,NULL,NULL,NULL,32,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Blue Safari Excursions',NULL,'fa-sailboat',NULL,NULL,NULL,NULL,NULL,33,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Sandbank Picnics',NULL,'fa-umbrella-beach',NULL,NULL,NULL,NULL,NULL,34,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Glass-Bottom Boat Tours',NULL,'fa-ship',NULL,NULL,NULL,NULL,NULL,35,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('marine','Swimming with Marine Life',NULL,'fa-person-swimming',NULL,NULL,NULL,NULL,NULL,36,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('prison_island','Aldabra Giant Tortoises','Meet and feed a colony of giant tortoises, some over 150 years old.','fa-hippo',NULL,NULL,NULL,NULL,NULL,37,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('prison_island','Historical Prison Ruins','Explore the 19th-century quarantine station and prison complex.','fa-dungeon',NULL,NULL,NULL,NULL,NULL,38,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('prison_island','Snorkelling & Reefs','Clear waters and coral gardens just off the island shore.','fa-mask',NULL,NULL,NULL,NULL,NULL,39,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('prison_island','Wildlife Photography','Peacocks, tortoises and ocean views make for memorable shots.','fa-camera',NULL,NULL,NULL,NULL,NULL,40,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('jozani','Zanzibar Red Colobus Monkeys','Get remarkably close to these rare, endemic primates found nowhere else on earth.','fa-paw',NULL,NULL,NULL,NULL,NULL,41,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('jozani','Mangrove Boardwalk','A raised walkway through tidal mangrove forest and its unique ecosystem.','fa-bridge',NULL,NULL,NULL,NULL,NULL,42,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('jozani','Guided Nature Walks','Forest trails with expert guides revealing rare plants and wildlife.','fa-person-hiking',NULL,NULL,NULL,NULL,NULL,43,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('jozani','Bird Watching','A rewarding spot for endemic and migratory coastal birdlife.','fa-crow',NULL,NULL,NULL,NULL,NULL,44,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('packages','3-Day Zanzibar Beach Escape','Quick Getaway','fa-umbrella-beach',NULL,499,'3 Days / 2 Nights',NULL,'Beachfront accommodation
Daily breakfast
Airport transfers
Sunset dhow cruise',45,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('packages','5-Day Zanzibar Cultural Experience','Culture','fa-landmark',NULL,890,'5 Days / 4 Nights',NULL,'Stone Town guided tour
Spice farm tour
Jozani Forest visit
Half-board stay',46,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('packages','7-Day Honeymoon Paradise','Romance','fa-heart',NULL,1650,'7 Days / 6 Nights',NULL,'Luxury beach resort
Private candle-lit dinner
Couple\'s spa
Sandbank picnic',47,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('packages','Safari + Zanzibar Combination','Bush & Beach','fa-binoculars',NULL,2450,'9 Days / 8 Nights',NULL,'Northern Circuit safari
Flights to Zanzibar
Beach resort stay
All transfers',48,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('packages','Family Holiday Package','Family','fa-children',NULL,1290,'7 Days / 6 Nights',NULL,'Family beach suite
Kid-friendly excursions
Prison Island tortoises
Snorkelling trip',49,1,NOW(),NOW());
INSERT INTO `zanzibar_activities` (`category`,`title`,`description`,`icon`,`image`,`price`,`duration`,`best_time`,`details`,`display_order`,`is_active`,`created_at`,`updated_at`) VALUES ('packages','Luxury Island Retreat','Luxury','fa-gem',NULL,3200,'8 Days / 7 Nights',NULL,'5-star private villa
Private butler & chef
Yacht day charter
Premium spa journey',50,1,NOW(),NOW());

-- Fix Safari shortcut links that returned 404
UPDATE `menu_links` SET `url` = '/destinations/serengeti-national-park' WHERE `url` = '/destinations/serengeti';
UPDATE `menu_links` SET `url` = '/destinations/ngorongoro-crater' WHERE `url` = '/destinations/ngorongoro';
UPDATE `menu_links` SET `url` = '/destinations/tarangire-national-park' WHERE `url` = '/destinations/tarangire';
UPDATE `menu_links` SET `url` = '/destinations/lake-manyara' WHERE `url` = '/destinations/manyara';
UPDATE `menu_links` SET `url` = '/destinations/selous-game-reserve' WHERE `url` = '/destinations/selous';
UPDATE `menu_links` SET `url` = '/destinations/ruaha-national-park' WHERE `url` = '/destinations/ruaha';

-- Mark these migrations as run (keeps artisan migrate consistent)
SET @b = (SELECT COALESCE(MAX(`batch`),0)+1 FROM `migrations`);
INSERT INTO `migrations` (`migration`,`batch`) SELECT '2026_07_04_000001_fix_safari_menu_link_urls', @b FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM (SELECT `migration` FROM `migrations`) x WHERE x.`migration` = '2026_07_04_000001_fix_safari_menu_link_urls');
INSERT INTO `migrations` (`migration`,`batch`) SELECT '2026_07_04_000002_create_zanzibar_activities_table', @b FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM (SELECT `migration` FROM `migrations`) x WHERE x.`migration` = '2026_07_04_000002_create_zanzibar_activities_table');
