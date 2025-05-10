<?php

namespace Domain\Emoji\Commands;

use Domain\Emoji\EmojiService;
use Exception;
use Illuminate\Console\Command;
class ImportEmojiCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:import-emoji-collection {file?}';

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
    public function __construct()
    {
        parent::__construct();
        $this->emojiService = new EmojiService();
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
