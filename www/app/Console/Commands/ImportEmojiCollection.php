<?php

namespace App\Console\Commands;

use Domain\Emoji\EmojiService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ImportEmojiCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-emoji-collection {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import emojis from a JSON file';

    /**
     * @var EmojiService $emojiService
     */
    private EmojiService $emojiService;

    /**
     * @param EmojiService $emojiService
     */
    public function __construct(EmojiService $emojiService)
    {
        parent::__construct();
        $this->emojiService = $emojiService;
    }

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle()
    {
        if(false === empty($filePath = $this->argument('file'))) {
            $this->info("Importing emojis from: {$filePath}");
        } else {
            $this->info("Importing emojis from default file path");
        }

        try {
            $this->emojiService->importCollection(null);
            $this->info("Emoji import completed successfully!");
        } catch (\Exception $e) {
            $this->error("Error during import: " . $e->getMessage());
        }
    }
}
