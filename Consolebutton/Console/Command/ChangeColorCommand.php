<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Console\Command;

use Hibrido\Consolebutton\Api\ButtonColorManagementInterface;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ChangeColorCommand extends Command
{
    /**
     * @var ButtonColorManagementInterface
     */
    private ButtonColorManagementInterface $buttonColorChangeService;

    /**
     * @param ButtonColorManagementInterface $buttonColorChangeService
     * @param ?string $name
     */
    public function __construct(
        ButtonColorManagementInterface $buttonColorChangeService,
        ?string $name = null
    ) {
        $this->buttonColorChangeService = $buttonColorChangeService;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('hibrido:button:change')
            ->setDescription('Change button color - Enter the color in hexadecimal that you want to change all your store view buttons and in which storeview you would like to do this.')
            ->addArgument('color', InputArgument::REQUIRED, 'New color for the button')
            ->addArgument('storeview', InputArgument::REQUIRED, 'Change the color of which storeview?');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $color = $this->getCleanColor($input->getArgument('color'));

        if (!$this->validateColorIsHex($color)) {
            $output->writeln('Button Color Change Fail - Color is not hex.');
            return Cli::RETURN_FAILURE;
        }

        $buttonColorChangeSuccessful = $this->buttonColorChangeService->execute(
            (int)$input->getArgument('storeview'),
            $color
        );

        if (!$buttonColorChangeSuccessful) {
            $output->writeln('Button Color Change Fail.');
            return Cli::RETURN_FAILURE;
        }

        $output->writeln('Button Color Change Success.');
        return Cli::RETURN_SUCCESS;
    }

    /**
     * @param string $color
     * @return string
     */
    private function getCleanColor(string $color): string
    {
        return ltrim($color, '#');
    }

    /**
     * @param string $color
     * @return bool
     */
    private function validateColorIsHex(string $color): bool
    {
        return ctype_xdigit($color);
    }
}
