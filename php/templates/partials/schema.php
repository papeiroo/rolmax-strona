<?php
/** Dane strukturalne (Google: wizytówka firmy i oddziałów). */
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
$branches = [];
foreach (cfg('branches') as $b) {
    preg_match('/^(.*), (\d{2}-\d{3}) (.*)$/', $b['a'], $m);
    [$o, $c] = explode('–', $b['sales'][0][0][1]);
    $branches[] = [
        '@type' => 'LocalBusiness',
        'name' => 'Rolmax — oddział ' . $b['n'],
        'telephone' => '+48 ' . $b['sales'][1][0],
        'email' => $b['sales'][2],
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => $m[1] ?? $b['a'], 'postalCode' => $m[2] ?? '', 'addressLocality' => $m[3] ?? $b['n'], 'addressCountry' => 'PL'],
        'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => $days, 'opens' => sprintf('%05s', $o), 'closes' => sprintf('%05s', $c)]],
    ];
}
$org = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Rolmax',
    'url' => cfg('site.url'),
    'logo' => rtrim(cfg('site.url'), '/') . '/assets/img/logo.png',
    'foundingDate' => (string)cfg('site.founded'),
    'telephone' => '+48 ' . cfg('site.phone'),
    'email' => cfg('site.email'),
    'sameAs' => [cfg('site.facebook'), cfg('site.instagram')],
    'department' => $branches,
];
?>
<script type="application/ld+json"><?= json_encode($org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
