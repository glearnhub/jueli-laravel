<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Service;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $body = "User-agent: *\nDisallow: /admin\n\nSitemap: ".url('/sitemap.xml')."\n";

        return response($body, 200, ['Content-Type' => 'text/plain']);
    }

    public function sitemap(): Response
    {
        $urls = collect([
            [route('home'), '1.0', null],
            [route('about'), '0.6', null],
            [route('services'), '0.8', null],
            [route('shop'), '0.9', null],
            [route('contact'), '0.6', null],
        ]);

        Service::published()->get(['slug', 'updated_at'])->each(
            fn (Service $service) => $urls->push([route('services.show', $service), '0.7', $service->updated_at])
        );

        ProductCategory::active()->has('products')->get(['id', 'updated_at'])->each(
            fn (ProductCategory $category) => $urls->push([route('shop', ['category' => $category->id]), '0.7', $category->updated_at])
        );

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach ($urls as [$loc, $priority, $updated]) {
            $xml .= '  <url><loc>'.e($loc).'</loc>'
                .($updated ? '<lastmod>'.$updated->toAtomString().'</lastmod>' : '')
                .'<priority>'.$priority.'</priority></url>'."\n";
        }
        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
