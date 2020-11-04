<?php declare(strict_types=1);
namespace Oxylion\Component\Command;

interface ICommand
{
    /**
     * The most important function for a ICommand. Describes the operations performed     
     */
    public function execute();
}