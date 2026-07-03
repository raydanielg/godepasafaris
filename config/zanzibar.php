<?php

/*
|--------------------------------------------------------------------------
| Zanzibar destination page content
|--------------------------------------------------------------------------
|
| All copy, imagery and package data for the Zanzibar landing page lives
| here so the view stays presentational and the content is editable in one
| place. Prices are placeholders (edit freely). Replace image URLs with
| your own licensed Zanzibar photography for production.
|
*/

return [

    'whatsapp' => '255794636471',

    'hero_image' => 'https://images.unsplash.com/photo-1586861203927-800a5acdcc7d?auto=format&fit=crop&w=1920&q=80',

    // 1 — Beach Paradise Experiences
    'beaches' => [
        ['name' => 'Nungwi Beach',   'icon' => 'fa-umbrella-beach', 'best_time' => 'Jun – Oct, Dec – Feb', 'desc' => "Zanzibar's liveliest northern beach — swimmable at all tides, famous sunsets, dhow cruises and vibrant nightlife.", 'activities' => ['Sunset dhow cruise', 'Diving & snorkelling', 'Turtle aquarium']],
        ['name' => 'Kendwa Beach',   'icon' => 'fa-water',          'best_time' => 'Jun – Oct, Dec – Feb', 'desc' => 'Calm, deep water you can swim day or night, powder-white sand and the famous full-moon beach parties.', 'activities' => ['Swimming', 'Sunset sailing', 'Beach parties']],
        ['name' => 'Paje Beach',     'icon' => 'fa-wind',           'best_time' => 'Jun – Sep (windy)',    'desc' => "The kitesurfing capital of the island — a wide turquoise lagoon and a relaxed, bohemian village scene.", 'activities' => ['Kitesurfing', 'Paddleboarding', 'Beach yoga']],
        ['name' => 'Jambiani Beach', 'icon' => 'fa-fish',           'best_time' => 'Jun – Oct, Dec – Feb', 'desc' => 'An authentic fishing and seaweed-farming village with tranquil turquoise shallows and a slow island pace.', 'activities' => ['Village walks', 'Seaweed farm tour', 'Snorkelling']],
        ['name' => 'Matemwe Beach',  'icon' => 'fa-mask',           'best_time' => 'Jun – Oct, Dec – Feb', 'desc' => 'The gateway to Mnemba Atoll — pristine reefs, barefoot-luxury lodges and world-class diving.', 'activities' => ['Mnemba snorkelling', 'Scuba diving', 'Dolphin spotting']],
        ['name' => 'Kiwengwa Beach', 'icon' => 'fa-sun',            'best_time' => 'Jun – Oct, Dec – Feb', 'desc' => 'A long sweep of white sand backed by resorts and coral caves — ideal for watersports and easy relaxation.', 'activities' => ['Watersports', 'Coral cave visit', 'Spa & resorts']],
    ],

    // 2 — Historical & Cultural Heritage (Stone Town, UNESCO)
    'stone_town' => [
        ['name' => 'House of Wonders (Beit-el-Ajaib)', 'icon' => 'fa-landmark',       'desc' => 'A landmark 19th-century sultan\'s palace on the seafront — the first building in East Africa with electricity and a lift.'],
        ['name' => 'The Old Fort (Ngome Kongwe)',       'icon' => 'fa-chess-rook',     'desc' => 'The oldest building in Stone Town, an Omani-era fortress now hosting a cultural centre and open-air amphitheatre.'],
        ['name' => 'Freddie Mercury Museum',            'icon' => 'fa-music',          'desc' => 'A tribute to the Queen frontman, born Farrokh Bulsara in Zanzibar, tracing his island roots and rise to fame.'],
        ['name' => 'Former Slave Market',               'icon' => 'fa-dove',           'desc' => 'A moving memorial and museum on the site of the world\'s last open slave market — essential to understanding the island\'s history.'],
        ['name' => 'Anglican Cathedral (Christ Church)','icon' => 'fa-place-of-worship','desc' => 'Built to commemorate the abolition of slavery, its altar stands where the whipping post once did.'],
        ['name' => 'Darajani Market',                   'icon' => 'fa-store',          'desc' => 'The beating heart of Stone Town — a bustling bazaar of spices, tropical fruit, fish and everyday island life.'],
        ['name' => "Sultan's Palace Museum",            'icon' => 'fa-crown',          'desc' => 'The former royal residence, now a museum of the Zanzibar sultanate\'s furnishings, portraits and history.'],
    ],

    'culture' => [
        ['name' => 'Swahili Cooking Classes',   'icon' => 'fa-utensils'],
        ['name' => 'Local Village Tours',        'icon' => 'fa-people-roof'],
        ['name' => 'Cultural Performances',      'icon' => 'fa-masks-theater'],
        ['name' => 'Taarab Music Experiences',   'icon' => 'fa-guitar'],
        ['name' => 'Traditional Dhow Building',  'icon' => 'fa-sailboat'],
        ['name' => 'Henna Art',                  'icon' => 'fa-hand-sparkles'],
        ['name' => 'Swahili Architecture Tours', 'icon' => 'fa-archway'],
    ],

    // 3 — Spice Island Adventures
    'spices' => [
        ['name' => 'Clove Plantations',    'icon' => 'fa-seedling', 'desc' => 'Zanzibar was once the world\'s leading clove producer — the scent still defines the island.'],
        ['name' => 'Cinnamon Experiences', 'icon' => 'fa-tree',     'desc' => 'See how bark becomes the spice, and taste the difference between leaf, root and bark.'],
        ['name' => 'Vanilla Farms',        'icon' => 'fa-leaf',     'desc' => 'Discover how hand-pollinated orchids produce one of the world\'s most prized flavours.'],
        ['name' => 'Tropical Fruit Tasting','icon' => 'fa-apple-whole','desc' => 'Sample jackfruit, custard apple, rambutan, star fruit and more, freshly picked.'],
        ['name' => 'Organic Cooking',      'icon' => 'fa-mortar-pestle','desc' => 'Turn just-harvested spices into a traditional Swahili meal with a local family.'],
        ['name' => 'Medicinal Plants',     'icon' => 'fa-mortar-pestle','desc' => 'Learn the traditional healing uses of the island\'s herbs, roots and barks.'],
    ],

    // 4 — Turtle & Marine Conservation
    'turtle' => [
        ['name' => 'Baraka Natural Aquarium',            'icon' => 'fa-hand-holding-heart', 'desc' => 'A natural tidal lagoon in Nungwi caring for rescued sea turtles, with ethical, guided feeding.'],
        ['name' => 'Mnarani Marine Turtle Conservation', 'icon' => 'fa-shield-heart',       'desc' => 'A community conservation pond protecting green and hawksbill turtles and releasing hatchlings to the ocean.'],
    ],
    'marine' => [
        ['name' => 'Snorkelling',            'icon' => 'fa-mask'],
        ['name' => 'Scuba Diving',           'icon' => 'fa-water'],
        ['name' => 'Deep Sea Fishing',       'icon' => 'fa-fish-fins'],
        ['name' => 'Dolphin Tours (Kizimkazi)','icon' => 'fa-fish'],
        ['name' => 'Blue Safari Excursions', 'icon' => 'fa-sailboat'],
        ['name' => 'Sandbank Picnics',       'icon' => 'fa-umbrella-beach'],
        ['name' => 'Glass-Bottom Boat Tours','icon' => 'fa-ship'],
        ['name' => 'Swimming with Marine Life','icon' => 'fa-person-swimming'],
    ],

    // 5 — Prison Island
    'prison_island' => [
        'intro' => 'A short boat ride from Stone Town, Changuu (Prison Island) pairs poignant history with giant tortoises and coral reefs.',
        'features' => [
            ['name' => 'Aldabra Giant Tortoises', 'icon' => 'fa-hippo',    'desc' => 'Meet and feed a colony of giant tortoises, some over 150 years old.'],
            ['name' => 'Historical Prison Ruins', 'icon' => 'fa-dungeon',  'desc' => 'Explore the 19th-century quarantine station and prison complex.'],
            ['name' => 'Snorkelling & Reefs',     'icon' => 'fa-mask',     'desc' => 'Clear waters and coral gardens just off the island shore.'],
            ['name' => 'Wildlife Photography',    'icon' => 'fa-camera',   'desc' => 'Peacocks, tortoises and ocean views make for memorable shots.'],
        ],
    ],

    // 6 — Jozani Forest National Park
    'jozani' => [
        'intro' => 'Jozani-Chwaka Bay National Park is the last remaining home of the endemic Zanzibar red colobus monkey.',
        'features' => [
            ['name' => 'Zanzibar Red Colobus Monkeys', 'icon' => 'fa-paw',       'desc' => 'Get remarkably close to these rare, endemic primates found nowhere else on earth.'],
            ['name' => 'Mangrove Boardwalk',           'icon' => 'fa-bridge',    'desc' => 'A raised walkway through tidal mangrove forest and its unique ecosystem.'],
            ['name' => 'Guided Nature Walks',          'icon' => 'fa-person-hiking','desc' => 'Forest trails with expert guides revealing rare plants and wildlife.'],
            ['name' => 'Bird Watching',                'icon' => 'fa-crow',      'desc' => 'A rewarding spot for endemic and migratory coastal birdlife.'],
        ],
    ],

    // 7 — Luxury & Romantic Packages (prices are editable placeholders)
    'packages' => [
        ['name' => '3-Day Zanzibar Beach Escape',        'nights' => 2, 'from' => 499,  'icon' => 'fa-umbrella-beach', 'tag' => 'Quick Getaway', 'includes' => ['Beachfront accommodation', 'Daily breakfast', 'Airport transfers', 'Sunset dhow cruise']],
        ['name' => '5-Day Zanzibar Cultural Experience',  'nights' => 4, 'from' => 890,  'icon' => 'fa-landmark',       'tag' => 'Culture',       'includes' => ['Stone Town guided tour', 'Spice farm tour', 'Jozani Forest visit', 'Half-board stay']],
        ['name' => '7-Day Honeymoon Paradise',            'nights' => 6, 'from' => 1650, 'icon' => 'fa-heart',          'tag' => 'Romance',       'includes' => ['Luxury beach resort', 'Private candle-lit dinner', 'Couple\'s spa', 'Sandbank picnic']],
        ['name' => 'Safari + Zanzibar Combination',       'nights' => 8, 'from' => 2450, 'icon' => 'fa-binoculars',     'tag' => 'Bush & Beach',  'includes' => ['Northern Circuit safari', 'Flights to Zanzibar', 'Beach resort stay', 'All transfers']],
        ['name' => 'Family Holiday Package',              'nights' => 6, 'from' => 1290, 'icon' => 'fa-children',       'tag' => 'Family',        'includes' => ['Family beach suite', 'Kid-friendly excursions', 'Prison Island tortoises', 'Snorkelling trip']],
        ['name' => 'Luxury Island Retreat',               'nights' => 7, 'from' => 3200, 'icon' => 'fa-gem',            'tag' => 'Luxury',        'includes' => ['5-star private villa', 'Private butler & chef', 'Yacht day charter', 'Premium spa journey']],
    ],

];
