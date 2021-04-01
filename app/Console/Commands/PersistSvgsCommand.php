<?php

namespace App\Console\Commands;

use App\Services\SvgIcons\AllowedAttributes;
use Carbon\Carbon;
use enshrined\svgSanitize\Sanitizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PersistSvgsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'linksporch:persist-svg-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Persist Svg Icons to database';
    /**
     * @var Sanitizer
     */
    protected $sanitizer;
    /**
     * @var AllowedAttributes
     */
    protected $allowedAttributes;

    /**
     * Create a new command instance.
     *
     * @param  Sanitizer  $sanitizer
     * @param  AllowedAttributes  $allowedAttributes
     */
    public function __construct(
        Sanitizer $sanitizer,
        AllowedAttributes $allowedAttributes
    )
    {
        parent::__construct();
        $this->sanitizer = $sanitizer;
        $this->allowedAttributes = $allowedAttributes;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->sanitizer->removeXMLTag(true);
        $this->sanitizer->setAllowedAttrs($this->allowedAttributes);
        $icons_dir = resource_path('icons');

        foreach (glob($icons_dir.'/*.svg') as $file) {
            $name = basename($file,'.svg');
            $svg = file_get_contents($file);

            $cleanedSvg = $this->sanitizer->sanitize($svg);

            DB::table('svgs')->insert([
                'name' => $name,
                'markup' => $cleanedSvg,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        }
        return 0;
    }

    protected function removeAttributes()
    {

    }
}
