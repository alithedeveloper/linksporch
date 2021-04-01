<?php

use App\Services\SvgIcons\Cleaner;
use App\Http\Controllers\{BiosController,
    BioStatusController,
    BioViewController,
    DashboardController,
    LinkController,
    LinksController,
    LinkStatusController,
    LinkTitleUrlController
};
use enshrined\svgSanitize\Sanitizer;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\ImageOptimizer\OptimizerChainFactory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin'       => Route::has('login'),
//        'canRegister'    => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion'     => PHP_VERSION,
//    ]);

//  $icons = \InlineSvg\Collection::fromPath(base_path('tabler-icons/icons'));
//  class NewAllowedAttributes implements \enshrined\svgSanitize\data\AttributeInterface
//  {
//
//      public static function getAttributes()
//      {
//          return [
//              // SVG
//              'accent-height',
//              'accumulate',
//              'additivive',
//              'alignment-baseline',
//              'ascent',
//              'attributename',
//              'attributetype',
//              'azimuth',
//              'basefrequency',
//              'baseline-shift',
//              'begin',
//              'bias',
//              'by',
//              'clip',
//              'clip-path',
//              'clip-rule',
//              'color',
//              'color-interpolation',
//              'color-interpolation-filters',
//              'color-profile',
//              'color-rendering',
//              'cx',
//              'cy',
//              'd',
//              'dx',
//              'dy',
//              'diffuseconstant',
//              'direction',
//              'display',
//              'divisor',
//              'dur',
//              'edgemode',
//              'elevation',
//              'end',
//              'fill',
//              'fill-opacity',
//              'fill-rule',
//              'filter',
//              'flood-color',
//              'flood-opacity',
//              'font-family',
//              'font-size',
//              'font-size-adjust',
//              'font-stretch',
//              'font-style',
//              'font-variant',
//              'font-weight',
//              'fx',
//              'fy',
//              'g1',
//              'g2',
//              'glyph-name',
//              'glyphref',
//              'gradientunits',
//              'gradienttransform',
//              'href',
//              'image-rendering',
//              'in',
//              'in2',
//              'k',
//              'k1',
//              'k2',
//              'k3',
//              'k4',
//              'kerning',
//              'keypoints',
//              'keysplines',
//              'keytimes',
//              'lang',
//              'lengthadjust',
//              'letter-spacing',
//              'kernelmatrix',
//              'kernelunitlength',
//              'lighting-color',
//              'local',
//              'marker-end',
//              'marker-mid',
//              'marker-start',
//              'markerheight',
//              'markerunits',
//              'markerwidth',
//              'maskcontentunits',
//              'maskunits',
//              'max',
//              'mask',
//              'media',
//              'method',
//              'mode',
//              'min',
//              'name',
//              'numoctaves',
//              'offset',
//              'operator',
//              'opacity',
//              'order',
//              'orient',
//              'orientation',
//              'origin',
//              'overflow',
//              'paint-order',
//              'path',
//              'pathlength',
//              'patterncontentunits',
//              'patterntransform',
//              'patternunits',
//              'points',
//              'preservealpha',
//              'preserveaspectratio',
//              'r',
//              'rx',
//              'ry',
//              'radius',
//              'refx',
//              'refy',
//              'repeatcount',
//              'repeatdur',
//              'restart',
//              'result',
//              'rotate',
//              'scale',
//              'seed',
//              'shape-rendering',
//              'specularconstant',
//              'specularexponent',
//              'spreadmethod',
//              'stddeviation',
//              'stitchtiles',
//              'stop-color',
//              'stop-opacity',
//              'stroke-dasharray',
//              'stroke-dashoffset',
//              'stroke-linecap',
//              'stroke-linejoin',
//              'stroke-miterlimit',
//              'stroke-opacity',
//              'stroke',
//              'style',
//              'surfacescale',
//              'tabindex',
//              'targetx',
//              'targety',
//              'transform',
//              'text-anchor',
//              'text-decoration',
//              'text-rendering',
//              'textlength',
//              'type',
//              'u1',
//              'u2',
//              'unicode',
//              'values',
//              'viewbox',
//              'visibility',
//              'vert-adv-y',
//              'vert-origin-x',
//              'vert-origin-y',
//              'word-spacing',
//              'wrap',
//              'writing-mode',
//              'xchannelselector',
//              'ychannelselector',
//              'x',
//              'x1',
//              'x2',
//              'y',
//              'y1',
//              'y2',
//              'z',
//              'zoomandpan',
//          ];
//      }
//  }
//    $icons_dir = resource_path('icons');
////    $optimizerChain = OptimizerChainFactory::create();
////    foreach (glob($icons_dir.'/*.svg') as $file){
////        $optimizerChain->optimize($file);
////    }
//
////    dd('done');
//    // Create a new sanitizer instance
//    $sanitizer = new Sanitizer();
//    $sanitizer->removeXMLTag(true);
//    $sanitizer->setAllowedAttrs(new \App\Services\SvgIcons\AllowedAttributes);
//
//// Load the dirty svg
//    $dirtySVG = file_get_contents($icons_dir.'/2fa.svg');
//
//// Pass it to the sanitizer and get it back clean
//    $cleanSVG = $sanitizer->sanitize($dirtySVG);
//    echo $cleanSVG;


//    $xml = simplexml_load_string($cleanSVG);
//
//
//
//
//    dd($cleanSVG);

//    $icons->addTransformer(new Cleaner());
//
//    echo $icons->get('2fa');

    return (new \App\Services\SvgIcons\SvgCache())->get();

});

Route::get('/{user:username}/{bio:slug}', BioViewController::class)
    ->name('bio.view');

Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    // Show Bio
    Route::get('/bios/{bio:slug}', [BiosController::class, 'show'])
        ->name('bio.show');

    Route::get('/bios/{bio:slug}/appearance', \App\Http\Controllers\BioAppearanceController::class)
        ->name('bio.appearance');

    // Bio Status
    Route::put('/bio/{bio:slug}/status', BioStatusController::class)
        ->name('bio.status.update');

    // create link
    Route::post('/bio/{bio:slug}/links', [LinkController::class, 'store'])
        ->name('link.create');


    //Link Status
    Route::delete('/links/{link}', [LinksController::class, 'delete'])
        ->name('link.delete');

    //Link Status
    Route::put('/links/{link}/status', LinkStatusController::class)
        ->name('link.status.update');


    //Link Title & Url
    Route::put('/links/{link}/title-url', LinkTitleUrlController::class)
        ->name('link.title.url.update')->middleware('remember');


});
