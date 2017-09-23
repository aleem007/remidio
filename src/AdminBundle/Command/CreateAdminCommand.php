<?php
namespace AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use AdminBundle\Helper\HelperService;

/**
 * Description of createAdminCommand
 *
 * @author Aleem <aleemcool8@gmail.com>
 */
class CreateAdminCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName("remidio:create-admin")
             ->setDescription("To create Admin")
             ->addArgument('username', InputArgument::REQUIRED, 'username')
             ->addArgument('password', InputArgument::REQUIRED, 'password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username= $input->getArgument('username');
        $password= $input->getArgument('password');
        $this->getContainer()->get('helper_service')->createAdmin($username, $password);
    }
}
