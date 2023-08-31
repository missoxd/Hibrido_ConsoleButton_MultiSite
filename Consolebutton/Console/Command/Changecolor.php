<?php
namespace Hibrido\Consolebutton\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Hibrido\Consolebutton\Model\ButtonColorFactory;
use Magento\Store\Model\StoreManagerInterface;

class Changecolor extends Command
{
    protected $buttonColorFactory;
    protected $storeManager;

    public function __construct(ButtonColorFactory $buttonColorFactory, $name = null)
    {
        $this->buttonColorFactory = $buttonColorFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('hibrido:button:change')
            ->setDescription('Change button color - Enter the color in hexadecimal that you want to change all your store view buttons and in which storeview you would like to do this.')
            ->addArgument('color', InputArgument::REQUIRED, 'New color for the button')
            ->addArgument('storeview', InputArgument::REQUIRED, 'Change the color of which storeview?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $newColor = $input->getArgument('color');
        $storeView = $input->getArgument('storeview');
        $storeManager = $this->storeManager;
        $storeViewExists = false;

        // Check if storeview value already exists in the table
        $buttonColorModel = $this->buttonColorFactory->create();
        $existingColor = $buttonColorModel->getCollection()->addFieldToFilter('storeview', $storeView)->getFirstItem();

        if (!$existingColor->getId()) {
            $buttonColorModel->setData([
                'color' => $newColor,
                'storeview' => $storeView
            ]);
            $buttonColorModel->save();
        } else {
            $existingColor->setData('color', $newColor);
            $existingColor->save();
        }
        
        $output->writeln('A cor dos botões de visualização da storeview ' . $storeView . ' foram configuradas para ' . $newColor);
    }
}
