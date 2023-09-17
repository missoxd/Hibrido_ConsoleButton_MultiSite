<?php
namespace Hibrido\Consolebutton\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Hibrido\Consolebutton\Model\ColorRepository;

/**
 * @package Hibrido\Consolebutton\Console\Command
 */
class Changecolor extends Command
{
    /**
     * @var ColorRepository
     */
    protected $colorRepository;

    /**
     * @param ColorRepository $colorRepository O repositório de cores personalizado.
     * @param string|null $name O nome do comando (opcional).
     */
    public function __construct(
        ColorRepository $colorRepository,
        $name = null
    ) {
        $this->colorRepository = $colorRepository;
        parent::__construct($name);
    }

    /**
     * Configurações do comando.
     * hibrido:button:change
     */
    protected function configure()
    {
        $this->setName('hibrido:button:change')
            ->setDescription('Change button color - Enter the color in hexadecimal that you want to change all your store view buttons and in which storeview you would like to do this.')
            ->addArgument('color', InputArgument::REQUIRED, 'New color for the button')
            ->addArgument('storeview', InputArgument::REQUIRED, 'Change the color of which storeview?');
    }

    /**
     * @param InputInterface $input A entrada do console.
     * @param OutputInterface $output A saída do console.
     * @return int O código de retorno (1 para sucesso, 0 para falha).
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $newColor = $input->getArgument('color');
        $storeView = $input->getArgument('storeview');

        try {
            $this->colorRepository->saveColor($storeView, $newColor);

            $output->writeln('A cor dos botões de visualização da storeview ' . $storeView . ' foram configuradas para ' . $newColor);
            return 1;
        } catch (\Throwable $e) {
            $output->writeln('Error: ' . $e->getMessage());
            return 0;
        }
    }
}
