<?php echo '<?xml version="1.0" encoding="UTF-8"?> <?xml-stylesheet type="text/xsl" href="'. $styleUrl .'"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($xmlData as $item)
    <sitemap>
        <loc>{{ $item['url'] }}</loc>
        <lastmod>{{ $item['lastMod'] }}</lastmod>
    </sitemap>
    @endforeach
</sitemapindex>