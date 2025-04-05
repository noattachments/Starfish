<?php

namespace Domain\Emoji;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Domain\Emoji\Models\Emoji as EmojiModel;
use Infrastructure\Handlers\JsonFileHandler;
use Symfony\Component\Console\Output\ConsoleOutput;
use Throwable;

class EmojiService
{

    private string $resourcePath;

    public function __construct()
    {
        $this->resourcePath = resource_path('json/emojis.json');
    }
    private static int $batchSize = 100;

    /**
     * @throws FileNotFoundException
     * @throws \Exception
     */
    public function importCollection($filePath = null): bool
    {

        $filePath = $filePath ?? $this->resourcePath;

        $output = new ConsoleOutput();

        $data = (new JsonFileHandler($filePath))->get();


        $chunk = [];

        $batch = 0;
        $count = count($data);

        foreach ($data as $emojiData) {
            try {
                $emoji = (new Emoji(
                    emoji: $emojiData['emoji'],
                    hexcode: $emojiData['hexcode'],
                    htmlCode: $emojiData['hexcode'],
                    group: $emojiData['group'],
                    subgroup: $emojiData['subgroup'],
                    annotation: $emojiData['annotation'],
                    tags: $emojiData['tags'],
                    shortcodes: $emojiData['shortcodes'],
                    emoticons: $emojiData['emoticons'],
                    directional: $emojiData['directional'],
                    variation: $emojiData['variation'],
                    variationBase: $emojiData['variationBase'],
                    unicode: $emojiData['unicode'],
                    order: $emojiData['order'],
                    skintone: $emojiData['skintone'],
                    skintoneCombination: $emojiData['skintoneCombination'],
                    skintoneBase: $emojiData['skintoneBase'],
                ));

                $chunk[] = $emoji->toArray();

                $batch++;

                // Insert when batch reaches size limit
                if (count($chunk) <= self::$batchSize) {

                    EmojiModel::insert($chunk);

                    $output->writeln("<info>Imported {$batch} out of {$count} emojis</info>");

                    \DB::commit(); // Commit transaction

                    $chunk = []; // Reset chunk count
                }
            } catch (Throwable $e) {
                error_log($message = "Error processing emoji: " . json_encode($emoji->all()));

                $output->writeln("<error>{$message}</error>");
                $output->writeln("<error>{$e->getMessage()}</error>");

                \DB::rollBack(); // Rollback on error
            }
        }

        if($batch === $count) {
            return true;
        }

        return false;
    }
}
