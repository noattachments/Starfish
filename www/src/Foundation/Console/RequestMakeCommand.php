<?php

namespace Foundation\Console;
use Foundation\Concerns\MakeTrait;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:request')]
final class RequestMakeCommand extends \Illuminate\Foundation\Console\RequestMakeCommand
{
    use MakeTrait;
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    final protected function getStub(): string
    {
        return $this->getStubDirectory().'request.stub';
    }
}
