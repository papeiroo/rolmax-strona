<?php
/**
 * Dane startowe motywu Rolmax (importowane do WordPressa przy aktywacji motywu).
 * Po imporcie wszystko edytuje się w panelu WordPressa (Maszyny, Oddziały, Strony, Wygląd → Dostosuj).
 */
declare(strict_types=1);

return [
    'site' => [
        'name'      => 'Rolmax',
        'url'       => 'https://rolmax.net.pl',
        'tagline'   => 'Autoryzowany dealer New Holland',
        'founded'   => 1997,
        'jubilee'   => 2027,
        'address'   => 'ul. Piasecka 208, 21-040 Świdnik',
        'phone'     => '81 721 67 85',
        'email'     => 'rolmax@rolmax.net.pl',
        'facebook'  => 'https://www.facebook.com/RolmaxNewHolland',
        'instagram' => 'https://www.instagram.com/rolmaxswidnik',
        'shop'      => 'https://www.rolmax-sklep.pl',
        'langs'     => [], // dawne /en /de /ru miały polską treść — przekierowane 301 na /pl
    ],

    /* Dwa działy — odpowiednik wyboru marki na kisielagrotech.pl */
    'departments' => [
        'maszyny' => [
            'label' => 'Dział maszyn', 'short' => 'Maszyny', 'switch' => 'czesci',
            'phones' => [['Sprzedaż', '81 723 69 60'], ['Serwis', '81 723 69 54']],
            'email'  => 'rolmax@rolmax.net.pl',
            'cta'    => ['Zapytaj o maszynę', 'kontakt'],
        ],
        'czesci' => [
            'label' => 'Dział części', 'short' => 'Części', 'switch' => 'maszyny',
            'phones' => [['Części', '81 721 67 85'], ['Kom.', '662 032 735']],
            'email'  => 'swidnik@rolmax-sklep.pl',
            'cta'    => ['Sklep online', 'https://www.rolmax-sklep.pl'],
        ],
    ],

    /* Wstążka z maszynami (mega menu) — kategorie z obecnej strony rolmax.net.pl */
    'machines' => [
        'traktory'               => ['T',  'Traktory',               'Serie T4 – T7 i większe',            'Serie T4, T5, T6, T7 i większe. Ciągniki do ciężkiej pracy.'],
        'ladowarki-teleskopowe'  => ['TH', 'Ładowarki teleskopowe',  'Przeładunek i magazyn',              'Zasięg, udźwig i zwrotność na podwórzu i w magazynie.'],
        'kombajny-zbozowe'       => ['CX', 'Kombajny zbożowe',       'Żniwa bez przestojów',               'Wydajny omłot i czyste ziarno w każdych warunkach.'],
        'maszyny-zielonkowe'     => ['G',  'Maszyny zielonkowe',     'Kosiarki, przetrząsacze, zgrabiarki','Kosiarki, przetrząsacze i zgrabiarki do produkcji pasz.'],
        'prasy'                  => ['BB', 'Prasy',                  'Zwijające i wielkogabarytowe',       'Zwijające i wielkogabarytowe do siana, słomy i sianokiszonki.'],
        'sieczkarnie-samobiezne' => ['FR', 'Sieczkarnie samobieżne', 'Kiszonka i biomasa',                 'Wysoka przepustowość przy zbiorze kukurydzy i traw.'],
        'plugi'                  => ['P',  'Pługi',                  'Zawieszane i półzawieszane',         'Obracalne, zawieszane i półzawieszane do równej orki.'],
        'maszyny-uprawne'        => ['U',  'Maszyny uprawne',        'Agregaty, kultywatory, brony',       'Agregaty, kultywatory i brony do uprawy gleby.'],
        'maszyny-budowlane'      => ['C',  'Maszyny budowlane',      'New Holland Construction',           'Koparki, koparko-ładowarki i ładowarki kołowe.'],
    ],

    /* Modele w kategoriach (z rolmax.net.pl). Zdjęcie: public/assets/img/maszyny/{slug}.webp|png|jpg — jeśli brak, rysunek kategorii. */
    'machine_icons' => [
        'traktory' => 'm-tractor',
        'ladowarki-teleskopowe' => 'm-tele',
        'kombajny-zbozowe' => 'm-combine',
        'maszyny-zielonkowe' => 'm-mower',
        'prasy' => 'm-baler',
        'sieczkarnie-samobiezne' => 'm-forage',
        'plugi' => 'm-plough',
        'maszyny-uprawne' => 'm-cult',
        'maszyny-budowlane' => 'm-constr',
    ],
    'models' => [
        'traktory' => [
            ['T8 GENESIS™', 't8-genesis'],
            ['T7 HEAVY DUTY Z PLM INTELLIGENCE™', 't7-heavy-duty-z-plm-intelligence'],
            ['T7 HEAVY DUTY - STAGE V', 't7-heavy-duty-stage-v'],
            ['T7 HEAVY DUTY', 't7-heavy-duty'],
            ['T7 LWB - STAGE V', 't7-lwb-stage-v'],
            ['T7 SWB - STAGE V', 't7-swb-stage-v'],
            ['T7S - STAGE V', 't7s-stage-v'],
            ['T6 METHANE POWER', 't6-methane-power'],
            ['T6 ELECTRO / DYNAMIC / AUTO COMMAND - STAGE V', 't6-electro-dynamic-auto-command-stage-v'],
            ['T6 ELECTRO COMMAND / DYNAMIC COMMAND / AUTO COMMAND', 't6-electro-command-dynamic-command-auto-command'],
            ['T5 DYNAMIC COMMAND™ I AUTO COMMAND™', 't5-dynamic-command-i-auto-command'],
            ['T5 ELECTRO COMMAND', 't5-electro-command'],
            ['T5 UTILITY - STAGE V', 't5-utility-stage-v'],
            ['T4 F/N/V', 't4-f-n-v'],
            ['T4 - STAGE V', 't4-stage-v'],
            ['T4S - STAGE V', 't4s-stage-v'],
            ['T3.F', 't3f'],
            ['BOOMER 25 C–55', 'boomer-25-c-55'],
        ],
        'ladowarki-teleskopowe' => [
            ['SERIA TH', 'serii-th'],
        ],
        'kombajny-zbozowe' => [
            ['CH', 'ch'],
            ['CR REVELATION - STAGE V', 'cr-revelation-stage-v'],
            ['CX7 I CX8 - STAGE V', 'cx7-i-cx8-stage-v'],
            ['CX5 I CX6 - STAGE V', 'cx5-i-cx6-stage-v'],
            ['TC - STAGE V', 'tc-stage-v'],
        ],
        'maszyny-zielonkowe' => [
            ['KOSIARKI CZOŁOWE', 'kosiarki-czolowe'],
            ['KOSIARKI MOCOWANE Z TYŁU', 'kosiarki-mocowane-z-tylu'],
            ['KOSIARKI CIĄGANE', 'kosiarki-ciagane'],
            ['KOSIARKI MEGACUTTER™', 'kosiarki-megacutter'],
            ['PRZETRZĄSACZE', 'przetrzasacze'],
            ['ZGRABIARKI PROROTOR™', 'zgrabiarki-prorotor'],
            ['ZGRABIARKI PROROTOR™ C', 'zgrabiarki-prorotor-c'],
            ['ZGRABIARKI PROROTOR™ L', 'zgrabiarki-prorotor-l'],
        ],
        'prasy' => [
            ['BIGBALER HIGH DENSITY', 'bigbaler-high-density'],
            ['BIGBALER PLUS', 'bigbaler-plus'],
            ['ROLL BALER', 'roll-baler'],
            ['ROLL-BELT', 'roll-belt'],
            ['ROLL-BAR™ 125', 'roll-bar-125'],
            ['BR 100', 'br-100'],
        ],
        'sieczkarnie-samobiezne' => [
            ['FR FORAGE CRUISER - STAGE V', 'fr-forage-cruiser-stage-v'],
        ],
        'plugi' => [
            ['ZAWIESZANE PŁUGI OBRACALNE', 'zawieszane-plugi-obracalne'],
            ['ZAWIESZANE PŁUGI OBRACALNE ZE ZMIENNĄ SZEROKOŚCIĄ ROBOCZĄ', 'zawieszane-plugi-obracalne-ze-zmienna-szerokoscia-robocza'],
            ['PÓŁZAWIESZANE PŁUGI OBRACALNE', 'polzawieszane-plugi-obracalne'],
            ['PÓŁZAWIESZANE PŁUGI OBRACALNE ZE ZMIENNĄ SZEROKOŚCIĄ ROBOCZĄ', 'polzawieszane-plugi-obracalne-ze-zmienna-szerokoscia-robocza'],
        ],
        'maszyny-uprawne' => [
            ['KULTYWATORY ŚCIERNISKOWE', 'kultywatory-scierniskowe'],
            ['KULTYWATORY UPRAWOWE', 'kultywatory-uprawowe'],
            ['BRONY TALERZOWE SDM I SDH', 'maszyny-uprawowe-kompaktowe-brony-talerzowe-sdm-i-sdh'],
            ['GŁĘBOSZE SUM I SUH', 'maszyny-uprawowe-glebosze-sum-i-suh'],
            ['PIELNIKI MIĘDZYRZĘDOWE', 'maszyny-uprawowe-pielniki-miedzyrzedowe'],
        ],
        'maszyny-budowlane' => [
            ['KOMPAKTOWE ŁADOWARKI KOŁOWE', 'kompaktowe-ladowarki-kolowe'],
            ['ŁADOWARKI KOŁOWE', 'ladowarki-kolowe'],
            ['KOPARKO-ŁADOWARKI', 'koparko-ladowarki'],
            ['MINIŁADOWARKI BURTOWE SERII 300', 'miniladowarki-burtowe-kolowe-i-gasienicowe-serii-300'],
            ['MINIŁADOWARKI BURTOWE SERII 200', 'miniladowarki-burtowe-kolowe-i-gasienicowe-serii-200'],
            ['MINI KOPARKI GĄSIENICOWE', 'mini-koparki-gasienicowe'],
        ],
    ],

    /* Kategorie działu części */
    'parts' => [
        ['p-filter', 'Filtry',            'Oleju, paliwa, powietrza, hydrauliki i kabiny.'],
        ['p-oil',    'Oleje i smary',     'Ambra i płyny eksploatacyjne do maszyn NH.'],
        ['p-tyre',   'Ogumienie',         'Opony rolnicze i dętki do ciągników i przyczep.'],
        ['p-brake',  'Układ napędowy',    'Sprzęgła, hamulce, łożyska i elementy skrzyń.'],
        ['p-elec',   'Elektryka',         'Akumulatory, oświetlenie, czujniki i wiązki.'],
        ['p-hyd',    'Hydraulika',        'Siłowniki, przewody, szybkozłącza i pompy.'],
        ['p-gear',   'Części silnika',    'Uszczelki, paski, pompy wody i chłodzenie.'],
        ['p-blade',  'Elementy robocze',  'Noże, palce, ostrza i części zużywające się.'],
    ],

    /* Podstrony wspólne (prefiksowane działem, jak /case-ih/o-firmie u Kisiela) */
    'pages' => [
        'finansowanie'         => ['Finansowanie',         'CNH Capital',          'Leasing, kredyt i harmonogramy spłat dopasowane do sezonowości gospodarstwa.', 'field'],
        'rolnictwo-precyzyjne' => ['Rolnictwo precyzyjne', 'PLM · Blue & you',     'Prowadzenie GPS, zmienne dawkowanie i dane z pola.', 'rows'],
        'serwis'               => ['Serwis',               'Warsztat i serwis mobilny', 'Naprawy, przeglądy i serwis w polu. Świdnik i Miączyn.', 'workshop'],
        'czesci-zamowienia'    => ['Części',               'Zamówienia części',    'Oryginalne części New Holland od ręki lub na zamówienie.', 'gears'],
        'likwidacja-szkod'     => ['Likwidacja szkód',     'Serwis · ubezpieczenia','Naprawa maszyny po szkodzie i pomoc w rozliczeniu z ubezpieczycielem.', 'dusk'],
        'promocje'             => ['Promocje',             'Akcje miesiąca',       'Ceny promocyjne do końca miesiąca lub do wyczerpania zapasów.', 'gears'],
        'aktualnosci'          => ['Aktualności',          'Z życia Rolmax',       'Ogłoszenia, promocje i nowości z naszych oddziałów.', 'dusk'],
        'o-firmie'             => ['O firmie',             'Od 1997',              'Autoryzowany przedstawiciel New Holland na Lubelszczyźnie.', 'field'],
        'kariera'              => ['Kariera',              'Praca w Rolmax',       'Dołącz do zespołu, który od 30 lat pracuje dla rolników.', 'workshop'],
        'galeria'              => ['Galeria',              'Zdjęcia i realizacje', 'Pokazy, dni otwarte i maszyny w pracy.', 'field'],
        'kontakt'              => ['Kontakt',              'Cztery oddziały',      'Świdnik, Miączyn, Rudnik i Białka. Wybierz oddział i dział.', 'dusk'],
    ],

    'jobs' => [
        'Mechanik maszyn rolniczych, pomocnik mechanika — Świdnik lub Miączyn',
        'Specjalista ds. sprzedaży maszyn rolniczych — woj. lubelskie',
        'Magazynier — Świdnik',
    ],

    'news' => [
        ['13.08.2026', 'T5, T6, T7 — stworzone do ciężkiej pracy', 'Ciągniki do ciężkiej pracy w atrakcyjnych warunkach finansowania. Zgłoś się po szczegółową ofertę.', 'T5 · T6 · T7', 'field', 'maszyny'],
        ['06.10.2026', 'Soboty nieczynne w dziale części', 'Od najbliższego weekendu sklepy stacjonarne są nieczynne w soboty aż do końca lutego.', 'Pon.–Pt.', 'dusk', 'czesci'],
        ['01.10.2026', 'Akcja promocyjna październik 2026', 'Do końca miesiąca lub do wyczerpania zapasów ceny promocyjne na wybrane produkty.', 'Promocja X', 'gears', 'czesci'],
        ['01.09.2026', 'Akcja promocyjna wrzesień 2026', 'Atrakcyjne ceny promocyjne na wyszczególnione produkty do końca miesiąca.', 'Promocja IX', 'rows', 'czesci'],
    ],

    'branches' => [
        ['n' => 'Świdnik', 's' => 'Siedziba', 'a' => 'ul. Piasecka 208, 21-040 Świdnik',
         'sales' => [[['Pon.–Pt.', '8:00–16:00'], ['Sobota', 'nieczynne']], ['81 723 69 60', '606 363 398', '606 815 418'], 'rolmax@rolmax.net.pl'],
         'parts' => [[['Pon.–Pt.', '7:00–16:00'], ['Sobota', '8:00–14:00']], ['81 721 67 85', '662 032 735'], 'swidnik@rolmax-sklep.pl'],
         'serv'  => [[['Pon.–Pt.', '7:00–16:00']], ['81 723 69 54', '509 497 101'], 'serwis@rolmax.net.pl']],
        ['n' => 'Miączyn', 's' => 'Oddział', 'a' => 'Miączyn 59, 22-455 Miączyn',
         'sales' => [[['Pon.–Pt.', '8:00–16:00'], ['Sobota', 'nieczynne']], ['84 639 71 86', '606 363 398', '606 815 418'], 'rolmax@rolmax.net.pl'],
         'parts' => [[['Pon.–Pt.', '7:00–16:00'], ['Sobota', '8:00–14:00']], ['84 639 71 86', '513 028 188'], 'miaczyn@rolmax.net.pl'],
         'serv'  => [[['Pon.–Pt.', '7:00–15:00']], ['84 639 71 86', '723 405 408'], 'miaczyn@rolmax.net.pl']],
        ['n' => 'Rudnik', 's' => 'Oddział', 'a' => 'Rudnik Kolonia 74, 23-212 Wilkołaz',
         'sales' => [[['Pon.–Pt.', '8:00–16:00'], ['Sobota', 'nieczynne']], ['504 044 574', '606 363 398', '606 815 418'], 'rolmax@rolmax.net.pl'],
         'parts' => [[['Pon.–Pt.', '7:00–16:00'], ['Sobota', '8:00–14:00']], ['81 821 01 11', '504 046 686'], 'rudnik@rolmax.net.pl'],
         'serv'  => null],
        ['n' => 'Białka', 's' => 'Oddział', 'a' => 'Białka 50c, 21-300 Radzyń Podlaski',
         'sales' => [[['Pon.–Pt.', '8:00–16:00'], ['Sobota', 'nieczynne']], ['506 215 663', '606 363 398', '606 815 418'], 'rolmax@rolmax.net.pl'],
         'parts' => [[['Pon.–Pt.', '8:00–16:00'], ['Sobota', 'nieczynne']], ['781 809 702'], 'bialka@rolmax.net.pl'],
         'serv'  => null],
    ],
];
