<?php

/*
|--------------------------------------------------------------------------
| Baked (committed) translations for seeded DB content
|--------------------------------------------------------------------------
|
| Offline, no-API source of truth for translating dynamic content. Loaded by
| TranslationsSeeder into the `translations` cache table (the same table the
| runtime tr() helper reads). Committing this file means production/dev can
| seed fully-multilingual content with ZERO translation-API calls.
|
| Format:  'English source string' => ['sw' => '…', 'fr' => '…', 'es' => '…', 'de' => '…', 'zh' => '…']
|
| The source string must match the DB value EXACTLY (it is hashed with sha1
| to key the cache). Place/park proper nouns (e.g. "Serengeti National Park")
| are intentionally left untranslated.
|
| To grow this file from live data: run `php artisan translations:export`
| after warming (online), which snapshots the cache back into here.
|
*/

return [

    // ---- Package inclusions / exclusions (short, high-reuse) ----
    '4x4 safari vehicle'        => ['sw' => 'Gari la safari 4x4', 'fr' => 'Véhicule de safari 4x4', 'es' => 'Vehículo de safari 4x4', 'de' => '4x4-Safarifahrzeug', 'zh' => '4x4 越野车'],
    '4x4 vehicle'               => ['sw' => 'Gari la 4x4', 'fr' => 'Véhicule 4x4', 'es' => 'Vehículo 4x4', 'de' => '4x4-Fahrzeug', 'zh' => '4x4 越野车'],
    'Accommodation'             => ['sw' => 'Malazi', 'fr' => 'Hébergement', 'es' => 'Alojamiento', 'de' => 'Unterkunft', 'zh' => '住宿'],
    'Accommodation upgrades'    => ['sw' => 'Maboresho ya malazi', 'fr' => "Surclassements d'hébergement", 'es' => 'Mejoras de alojamiento', 'de' => 'Unterkunfts-Upgrades', 'zh' => '住宿升级'],
    'Airport transfers'         => ['sw' => 'Usafiri wa uwanja wa ndege', 'fr' => 'Transferts aéroport', 'es' => 'Traslados al aeropuerto', 'de' => 'Flughafentransfers', 'zh' => '机场接送'],
    'Camping gear'              => ['sw' => 'Vifaa vya kambi', 'fr' => 'Équipement de camping', 'es' => 'Equipo de campamento', 'de' => 'Campingausrüstung', 'zh' => '露营装备'],
    'Cultural visits'           => ['sw' => 'Ziara za kitamaduni', 'fr' => 'Visites culturelles', 'es' => 'Visitas culturales', 'de' => 'Kulturelle Besuche', 'zh' => '文化参观'],
    'Drinks'                    => ['sw' => 'Vinywaji', 'fr' => 'Boissons', 'es' => 'Bebidas', 'de' => 'Getränke', 'zh' => '饮料'],
    'Flights'                   => ['sw' => 'Ndege', 'fr' => 'Vols', 'es' => 'Vuelos', 'de' => 'Flüge', 'zh' => '航班'],
    'Guide'                     => ['sw' => 'Kiongozi', 'fr' => 'Guide', 'es' => 'Guía', 'de' => 'Reiseführer', 'zh' => '向导'],
    'International flights'      => ['sw' => 'Ndege za kimataifa', 'fr' => 'Vols internationaux', 'es' => 'Vuelos internacionales', 'de' => 'Internationale Flüge', 'zh' => '国际航班'],
    'Lunch'                     => ['sw' => 'Chakula cha mchana', 'fr' => 'Déjeuner', 'es' => 'Almuerzo', 'de' => 'Mittagessen', 'zh' => '午餐'],
    'Meals'                     => ['sw' => 'Milo', 'fr' => 'Repas', 'es' => 'Comidas', 'de' => 'Mahlzeiten', 'zh' => '餐食'],
    'Mid-range accommodation'   => ['sw' => 'Malazi ya kadiri', 'fr' => 'Hébergement de gamme moyenne', 'es' => 'Alojamiento de gama media', 'de' => 'Unterkunft der Mittelklasse', 'zh' => '中档住宿'],
    'Park fees'                 => ['sw' => 'Ada za hifadhi', 'fr' => 'Frais de parc', 'es' => 'Tarifas del parque', 'de' => 'Parkgebühren', 'zh' => '公园费用'],
    'Personal expenses'         => ['sw' => 'Gharama binafsi', 'fr' => 'Dépenses personnelles', 'es' => 'Gastos personales', 'de' => 'Persönliche Ausgaben', 'zh' => '个人开支'],
    'Professional guide'        => ['sw' => 'Kiongozi mtaalamu', 'fr' => 'Guide professionnel', 'es' => 'Guía profesional', 'de' => 'Professioneller Reiseführer', 'zh' => '专业向导'],
    'Professional safari guide' => ['sw' => 'Kiongozi mtaalamu wa safari', 'fr' => 'Guide de safari professionnel', 'es' => 'Guía de safari profesional', 'de' => 'Professioneller Safari-Guide', 'zh' => '专业狩猎向导'],
    'Tips'                      => ['sw' => 'Bakshishi', 'fr' => 'Pourboires', 'es' => 'Propinas', 'de' => 'Trinkgelder', 'zh' => '小费'],
    'Transfers'                 => ['sw' => 'Usafiri', 'fr' => 'Transferts', 'es' => 'Traslados', 'de' => 'Transfers', 'zh' => '接送'],
    'Vehicle'                   => ['sw' => 'Gari', 'fr' => 'Véhicule', 'es' => 'Vehículo', 'de' => 'Fahrzeug', 'zh' => '车辆'],
    'Visa'                      => ['sw' => 'Viza', 'fr' => 'Visa', 'es' => 'Visado', 'de' => 'Visum', 'zh' => '签证'],
    'Visa fees'                 => ['sw' => 'Ada za viza', 'fr' => 'Frais de visa', 'es' => 'Tasas de visado', 'de' => 'Visagebühren', 'zh' => '签证费'],
    'Water'                     => ['sw' => 'Maji', 'fr' => 'Eau', 'es' => 'Agua', 'de' => 'Wasser', 'zh' => '水'],

    // ---- Destination badges ----
    'Adventure'    => ['sw' => 'Matukio', 'fr' => 'Aventure', 'es' => 'Aventura', 'de' => 'Abenteuer', 'zh' => '探险'],
    'Conservation' => ['sw' => 'Uhifadhi', 'fr' => 'Conservation', 'es' => 'Conservación', 'de' => 'Naturschutz', 'zh' => '自然保护'],
    'Exclusive'    => ['sw' => 'Ya Kipekee', 'fr' => 'Exclusif', 'es' => 'Exclusivo', 'de' => 'Exklusiv', 'zh' => '专属'],
    'Famous'       => ['sw' => 'Maarufu', 'fr' => 'Célèbre', 'es' => 'Famoso', 'de' => 'Berühmt', 'zh' => '著名'],
    'Popular'      => ['sw' => 'Maarufu', 'fr' => 'Populaire', 'es' => 'Popular', 'de' => 'Beliebt', 'zh' => '热门'],
    'Remote'       => ['sw' => 'Ya Mbali', 'fr' => 'Isolé', 'es' => 'Remoto', 'de' => 'Abgelegen', 'zh' => '偏远'],
    'Tranquil'     => ['sw' => 'Tulivu', 'fr' => 'Tranquille', 'es' => 'Tranquilo', 'de' => 'Ruhig', 'zh' => '宁静'],
    'Unique'       => ['sw' => 'Ya Kipekee', 'fr' => 'Unique', 'es' => 'Único', 'de' => 'Einzigartig', 'zh' => '独特'],
    'Wild'         => ['sw' => 'Ya Porini', 'fr' => 'Sauvage', 'es' => 'Salvaje', 'de' => 'Wild', 'zh' => '野性'],

    // ---- Activity names (generic experiences; proper-noun parks left as-is) ----
    'Beach Activities'      => ['sw' => 'Shughuli za Ufuoni', 'fr' => 'Activités de plage', 'es' => 'Actividades de playa', 'de' => 'Strandaktivitäten', 'zh' => '海滩活动'],
    'Beach Relaxation'      => ['sw' => 'Kupumzika Ufuoni', 'fr' => 'Détente à la plage', 'es' => 'Relax en la playa', 'de' => 'Strandentspannung', 'zh' => '海滩休闲'],
    'Bird Watching'         => ['sw' => 'Kutazama Ndege', 'fr' => 'Observation des oiseaux', 'es' => 'Observación de aves', 'de' => 'Vogelbeobachtung', 'zh' => '观鸟'],
    'Boat Excursions'       => ['sw' => 'Safari za Mashua', 'fr' => 'Excursions en bateau', 'es' => 'Excursiones en barco', 'de' => 'Bootsausflüge', 'zh' => '乘船游览'],
    'Boat Safaris'          => ['sw' => 'Safari za Mashua', 'fr' => 'Safaris en bateau', 'es' => 'Safaris en barco', 'de' => 'Bootssafaris', 'zh' => '乘船狩猎'],
    'Camping'               => ['sw' => 'Kambi', 'fr' => 'Camping', 'es' => 'Acampada', 'de' => 'Camping', 'zh' => '露营'],
    'Canoe Safari'          => ['sw' => 'Safari ya Mtumbwi', 'fr' => 'Safari en canoë', 'es' => 'Safari en canoa', 'de' => 'Kanu-Safari', 'zh' => '独木舟狩猎'],
    'Chimp Tracking'        => ['sw' => 'Kufuatilia Sokwe', 'fr' => 'Pistage des chimpanzés', 'es' => 'Rastreo de chimpancés', 'de' => 'Schimpansen-Tracking', 'zh' => '追踪黑猩猩'],
    'Crater Game Drives'    => ['sw' => 'Safari za Wanyamapori Kreta', 'fr' => 'Safaris dans le cratère', 'es' => 'Safaris en el cráter', 'de' => 'Pirschfahrten im Krater', 'zh' => '火山口游猎'],
    'Crater Rim Walks'      => ['sw' => 'Matembezi Ukingoni mwa Kreta', 'fr' => 'Randonnées sur le bord du cratère', 'es' => 'Caminatas por el borde del cráter', 'de' => 'Wanderungen am Kraterrand', 'zh' => '火山口边缘徒步'],
    'Cultural Tours'        => ['sw' => 'Ziara za Kitamaduni', 'fr' => 'Circuits culturels', 'es' => 'Tours culturales', 'de' => 'Kulturtouren', 'zh' => '文化之旅'],
    'Cultural Visits'       => ['sw' => 'Ziara za Kitamaduni', 'fr' => 'Visites culturelles', 'es' => 'Visitas culturales', 'de' => 'Kulturelle Besuche', 'zh' => '文化参观'],
    'Deep Sea Fishing'      => ['sw' => 'Uvuvi wa Bahari Kuu', 'fr' => 'Pêche en haute mer', 'es' => 'Pesca en alta mar', 'de' => 'Hochseefischen', 'zh' => '深海捕鱼'],
    'Dolphin Watching'      => ['sw' => 'Kutazama Pomboo', 'fr' => 'Observation des dauphins', 'es' => 'Avistamiento de delfines', 'de' => 'Delfinbeobachtung', 'zh' => '观海豚'],
    'Fishing'               => ['sw' => 'Uvuvi', 'fr' => 'Pêche', 'es' => 'Pesca', 'de' => 'Angeln', 'zh' => '钓鱼'],
    'Fly Camping'           => ['sw' => 'Kambi za Muda', 'fr' => 'Camping mobile', 'es' => 'Campamento móvil', 'de' => 'Fly-Camping', 'zh' => '移动露营'],
    'Forest Hiking'         => ['sw' => 'Matembezi Msituni', 'fr' => 'Randonnée en forêt', 'es' => 'Senderismo en el bosque', 'de' => 'Waldwanderung', 'zh' => '森林徒步'],
    'Forest Walks'          => ['sw' => 'Matembezi Msituni', 'fr' => 'Promenades en forêt', 'es' => 'Paseos por el bosque', 'de' => 'Waldspaziergänge', 'zh' => '森林漫步'],
    'Game Drives'           => ['sw' => 'Safari za Wanyamapori', 'fr' => 'Safaris en 4x4', 'es' => 'Safaris en vehículo', 'de' => 'Pirschfahrten', 'zh' => '游猎观兽'],
    'Green Turtle Watching' => ['sw' => 'Kutazama Kasa wa Kijani', 'fr' => 'Observation des tortues vertes', 'es' => 'Avistamiento de tortugas verdes', 'de' => 'Beobachtung von Suppenschildkröten', 'zh' => '观绿海龟'],
    'Hot Air Balloon'       => ['sw' => 'Puto la Hewa Moto', 'fr' => 'Montgolfière', 'es' => 'Globo aerostático', 'de' => 'Heißluftballon', 'zh' => '热气球'],
    'Kite Surfing'          => ['sw' => 'Kite Surfing', 'fr' => 'Kitesurf', 'es' => 'Kitesurf', 'de' => 'Kitesurfen', 'zh' => '风筝冲浪'],
    'Lake Activities'       => ['sw' => 'Shughuli za Ziwani', 'fr' => 'Activités lacustres', 'es' => 'Actividades en el lago', 'de' => 'Aktivitäten am See', 'zh' => '湖上活动'],
    'Maasai Village Visit'  => ['sw' => 'Ziara ya Kijiji cha Kimaasai', 'fr' => "Visite d'un village massaï", 'es' => 'Visita a una aldea masái', 'de' => 'Besuch eines Massai-Dorfes', 'zh' => '参观马赛村庄'],
    'Mount Meru Climb'      => ['sw' => 'Kupanda Mlima Meru', 'fr' => 'Ascension du mont Meru', 'es' => 'Ascenso al monte Meru', 'de' => 'Besteigung des Mount Meru', 'zh' => '攀登梅鲁山'],
    'Mountain Climbing'     => ['sw' => 'Kupanda Milima', 'fr' => 'Alpinisme', 'es' => 'Montañismo', 'de' => 'Bergsteigen', 'zh' => '登山'],
    'Nature Walks'          => ['sw' => 'Matembezi ya Asili', 'fr' => 'Promenades nature', 'es' => 'Paseos por la naturaleza', 'de' => 'Naturwanderungen', 'zh' => '自然漫步'],
    'Night Drives'          => ['sw' => 'Safari za Usiku', 'fr' => 'Safaris nocturnes', 'es' => 'Safaris nocturnos', 'de' => 'Nachtpirschfahrten', 'zh' => '夜间游猎'],
    'Night Game Drives'     => ['sw' => 'Safari za Wanyamapori Usiku', 'fr' => 'Safaris de nuit', 'es' => 'Safaris nocturnos', 'de' => 'Nächtliche Pirschfahrten', 'zh' => '夜间游猎'],
    'Olduvai Gorge Tour'    => ['sw' => 'Ziara ya Bonde la Olduvai', 'fr' => "Visite des gorges d'Olduvai", 'es' => 'Tour por la garganta de Olduvai', 'de' => 'Tour zur Olduvai-Schlucht', 'zh' => '奥杜瓦伊峡谷之旅'],
    'Photography'           => ['sw' => 'Upigaji Picha', 'fr' => 'Photographie', 'es' => 'Fotografía', 'de' => 'Fotografie', 'zh' => '摄影'],
    'Photography Tours'     => ['sw' => 'Ziara za Upigaji Picha', 'fr' => 'Circuits photo', 'es' => 'Tours fotográficos', 'de' => 'Fototouren', 'zh' => '摄影之旅'],
    'Research Tours'        => ['sw' => 'Ziara za Utafiti', 'fr' => 'Circuits de recherche', 'es' => 'Tours de investigación', 'de' => 'Forschungstouren', 'zh' => '科研之旅'],
    'Snorkeling'            => ['sw' => 'Kupiga Mbizi', 'fr' => 'Plongée avec tuba', 'es' => 'Esnórquel', 'de' => 'Schnorcheln', 'zh' => '浮潜'],
    'Snorkelling & Diving'  => ['sw' => 'Kupiga Mbizi na Kuzamia', 'fr' => 'Plongée libre et sous-marine', 'es' => 'Esnórquel y buceo', 'de' => 'Schnorcheln & Tauchen', 'zh' => '浮潜与潜水'],
    'Spice Plantation Tour' => ['sw' => 'Ziara ya Shamba la Viungo', 'fr' => "Visite d'une plantation d'épices", 'es' => 'Tour por la plantación de especias', 'de' => 'Gewürzplantagen-Tour', 'zh' => '香料种植园之旅'],
    'Stone Town Tour'       => ['sw' => 'Ziara ya Stone Town', 'fr' => 'Visite de Stone Town', 'es' => 'Tour por Stone Town', 'de' => 'Stone-Town-Tour', 'zh' => '石头城之旅'],
    'Sunset Dhow Cruise'    => ['sw' => 'Safari ya Dau Wakati wa Machweo', 'fr' => 'Croisière en boutre au coucher du soleil', 'es' => 'Crucero en dhow al atardecer', 'de' => 'Dhau-Fahrt bei Sonnenuntergang', 'zh' => '日落三桅帆船巡游'],
    'Swimming'              => ['sw' => 'Kuogelea', 'fr' => 'Baignade', 'es' => 'Natación', 'de' => 'Schwimmen', 'zh' => '游泳'],
    'Tree Walk'             => ['sw' => 'Matembezi ya Miti', 'fr' => 'Sentier dans les arbres', 'es' => 'Paseo por los árboles', 'de' => 'Baumwipfelpfad', 'zh' => '树间步道'],
    'Walking Safaris'       => ['sw' => 'Safari za Kutembea', 'fr' => 'Safaris à pied', 'es' => 'Safaris a pie', 'de' => 'Wandersafaris', 'zh' => '徒步狩猎'],

];
