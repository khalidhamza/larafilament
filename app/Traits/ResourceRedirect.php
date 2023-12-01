<?php
namespace App\Traits;

trait ResourceRedirect
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}