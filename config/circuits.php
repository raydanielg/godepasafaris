<?php

/*
|--------------------------------------------------------------------------
| Tanzania Safari Circuits
|--------------------------------------------------------------------------
|
| Factual reference data for the three tourism circuits, rendered by the
| circuit pages. Each circuit carries an overview, quick facts, the parks /
| attractions it contains, and map coordinates used to embed a (key-less)
| Google map centred on the region. Keep facts accurate and conservative.
|
| Map embed used by the view:
|   https://maps.google.com/maps?q={lat},{lng}&z={zoom}&output=embed
|
*/

return [

    'northern' => [
        'slug'     => 'northern',
        'name'     => 'Northern Circuit',
        'tagline'  => "Tanzania's iconic safari heartland — the Great Migration, the Ngorongoro Crater and Kilimanjaro.",
        'hero'     => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1920&q=80',
        'accent'   => '#8B4513',
        'overview' => [
            "The Northern Circuit is Tanzania's most popular and accessible safari region, radiating from the town of Arusha and Kilimanjaro International Airport. It links a chain of world-famous parks that lie within a few hours' drive of one another, which makes it ideal for classic, first-time safaris.",
            "It is home to the annual Great Wildebeest Migration, the Big Five, and the Ngorongoro Crater — a UNESCO World Heritage Site and one of the densest concentrations of wildlife in Africa. The circuit also combines seamlessly with a Kilimanjaro trek or a Zanzibar beach extension.",
        ],
        'facts' => [
            'Best time'    => 'June – October (dry season). Migration river crossings usually July – September; calving season late January – February.',
            'Getting there'=> 'Fly into Kilimanjaro International Airport (JRO); most safaris begin in Arusha.',
            'Terrain'      => 'Open savannah plains, acacia woodland, volcanic highlands, crater floors and soda lakes.',
            'Ideal for'    => 'First-time safaris, the Great Migration, Big Five, photography and families.',
            'Typical trip' => '5 – 10 days.',
        ],
        'wildlife' => ['Lion', 'Elephant', 'Leopard', 'Cheetah', 'Black rhino', 'Wildebeest & zebra (migration)', 'Flamingo', 'Giraffe'],
        'map' => ['lat' => -2.70, 'lng' => 35.10, 'zoom' => 7],
        'places' => [
            ['name' => 'Serengeti National Park',      'desc' => "Tanzania's largest and most famous park — endless plains, the Great Migration and superb big-cat sightings."],
            ['name' => 'Ngorongoro Conservation Area', 'desc' => "The world's largest intact volcanic caldera; a natural enclosure of lions, elephants and endangered black rhino, shared with Maasai communities."],
            ['name' => 'Tarangire National Park',      'desc' => 'Famed for huge elephant herds and ancient baobab trees, especially in the dry season.'],
            ['name' => 'Lake Manyara National Park',   'desc' => 'A compact park known for tree-climbing lions, flamingos and rich birdlife beneath the Rift Valley escarpment.'],
            ['name' => 'Arusha National Park',         'desc' => 'A scenic day-trip park beneath Mount Meru, with the Momella Lakes, giraffes and colobus monkeys.'],
            ['name' => 'Mount Kilimanjaro',            'desc' => "Africa's highest peak at 5,895 m and the world's tallest free-standing mountain."],
            ['name' => 'Mount Meru',                   'desc' => "Tanzania's second-highest mountain (4,566 m) and a rewarding acclimatisation climb."],
            ['name' => 'Olduvai Gorge',                'desc' => 'The "Cradle of Mankind" — a landmark paleoanthropological site in the Great Rift Valley.'],
            ['name' => 'Lake Natron',                  'desc' => "A striking alkaline lake and East Africa's most important breeding site for lesser flamingos."],
        ],
    ],

    'southern' => [
        'slug'     => 'southern',
        'name'     => 'Southern Circuit',
        'tagline'  => 'Wild, remote and uncrowded — boat safaris, walking trails and vast elephant country.',
        'hero'     => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1920&q=80',
        'accent'   => '#556B2F',
        'overview' => [
            "The Southern Circuit offers a wilder, more exclusive safari with far fewer vehicles than the north. Anchored by two of Africa's largest protected areas — Nyerere National Park and Ruaha National Park — it rewards travellers who want space, solitude and raw wilderness.",
            "It is known for boat safaris on the Rufiji River, guided walking safaris, and strong populations of elephant, lion, buffalo and the endangered African wild dog. The circuit is usually reached by a short flight from Dar es Salaam and pairs naturally with a Zanzibar beach holiday.",
        ],
        'facts' => [
            'Best time'    => 'June – October (dry season), when wildlife gathers around water. Many camps close during the March – May long rains.',
            'Getting there'=> 'Short scheduled flights from Dar es Salaam; Mikumi is also reachable by road.',
            'Terrain'      => 'Miombo woodland, riverine forest, floodplains, rivers and lakes, and mountain rainforest.',
            'Ideal for'    => 'Return safari-goers, walking and boat safaris, wild dog, birding and off-the-beaten-track travel.',
            'Typical trip' => '4 – 8 days.',
        ],
        'wildlife' => ['Elephant', 'Lion', 'African wild dog', 'Buffalo', 'Hippo & crocodile', 'Greater kudu', 'Sable antelope', 'Birdlife (450+ species)'],
        'map' => ['lat' => -8.00, 'lng' => 36.50, 'zoom' => 6],
        'places' => [
            ['name' => 'Nyerere National Park',           'desc' => 'Created in 2019 from the northern Selous Game Reserve — one of Africa\'s largest parks, famed for Rufiji River boat safaris.'],
            ['name' => 'Ruaha National Park',              'desc' => 'One of Tanzania\'s largest parks, with huge elephant herds, big lion prides and a blend of East and Southern African species.'],
            ['name' => 'Mikumi National Park',             'desc' => 'The most accessible southern park (road from Dar es Salaam), with open plains often likened to the Serengeti.'],
            ['name' => 'Udzungwa Mountains National Park', 'desc' => 'A biodiversity hotspot of tropical rainforest, waterfalls and endemic primates — explored on foot.'],
            ['name' => 'Kitulo National Park',             'desc' => 'The "Serengeti of Flowers" — a high plateau celebrated for its wildflowers and orchids.'],
        ],
    ],

    'eastern' => [
        'slug'     => 'eastern',
        'name'     => 'Eastern Circuit',
        'tagline'  => 'Where the safari meets the sea — Swahili coast history, islands and coastal wildlife.',
        'hero'     => 'https://images.unsplash.com/photo-1586861203927-800a5acdcc7d?auto=format&fit=crop&w=1920&q=80',
        'accent'   => '#1F6F78',
        'overview' => [
            "The Eastern (Coastal) Circuit blends wildlife with the Indian Ocean and centuries of Swahili culture. It centres on Saadani National Park — the only Tanzanian park where the beach meets the bush — and extends to the historic towns of Bagamoyo and Pangani, the Tanga coastline and the islands of Zanzibar.",
            "It is the natural way to end a safari: white-sand beaches, coral-reef snorkelling, spice tours and the UNESCO-listed alleys of Stone Town. The coast is warm year-round and easy to combine with either the Northern or Southern circuits.",
        ],
        'facts' => [
            'Best time'    => 'June – October and December – February (dry and sunny); the coast is warm all year.',
            'Getting there'=> 'Zanzibar has its own international airport (ZNZ); Saadani is reached by road or light aircraft from Dar es Salaam or Zanzibar.',
            'Terrain'      => 'White-sand beaches, coral reefs, mangroves, coastal savannah and tidal rivers.',
            'Ideal for'    => 'Beach-and-bush combos, culture and history, honeymoons, diving and snorkelling.',
            'Typical trip' => '3 – 7 days.',
        ],
        'wildlife' => ['Elephant & lion (Saadani)', 'Green turtle', 'Dolphin', 'Red colobus monkey', 'Coral-reef fish', 'Hippo (Wami River)', 'Coastal birds'],
        'map' => ['lat' => -6.10, 'lng' => 39.00, 'zoom' => 8],
        'places' => [
            ['name' => 'Saadani National Park', 'desc' => 'The only East African reserve where elephants and lions can be seen on the beach, with Wami River boat trips and green-turtle nesting.'],
            ['name' => 'Zanzibar (Unguja)',     'desc' => 'The Spice Island — UNESCO-listed Stone Town, white beaches, coral reefs, dolphin tours and spice plantations.'],
            ['name' => 'Bagamoyo',              'desc' => 'A historic 19th-century port and former capital of German East Africa, with poignant slave-trade heritage and the nearby Kaole ruins.'],
            ['name' => 'Pangani',               'desc' => 'A tranquil Swahili coastal town with historic architecture, river-estuary trips and quiet beaches.'],
            ['name' => 'Tanga',                 'desc' => 'A northern coastal city known for the Amboni Caves, coral gardens and colonial-era history.'],
        ],
    ],

];
