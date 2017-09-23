<?php
namespace AdminBundle\Helper;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Doctrine\ORM\EntityManager;

/**
 * Description of HelperService
 * @author Aleem <aleemcool8@gmail.com>
 */
class HelperService
{
    private $encoder;
    private $em;
    
    public function __construct(EncoderFactory $encoder, EntityManager $em)
    {
        $this->encoder = $encoder;
        $this->em = $em;
    }
    
    
    public function createAdmin($username, $password)
    {
        $admin = $this->em->getRepository('AdminBundle:UserRemidio')->findOneBy(array('username'=>$username));
        if (!($admin instanceof \AdminBundle\Entity\UserRemidio)) {
            $admin = new \AdminBundle\Entity\UserRemidio();
        }
        $admin->setUsername($username);
        $admin = $this->setAdminPassword($admin, $password);
        $this->em->persist($admin);
        $this->em->flush();
    }
    
    public function setAdminPassword($admin, $plainPassword)
    {
        $encoder = $this->encoder->getEncoder($admin);
        $salt = \uniqid();
        $password = $encoder->encodePassword($plainPassword, $salt);
        $admin->setPassword($password);
        $admin->setSalt($salt);
        $admin->setRoles("ROLE_ADMIN");
        return $admin;
    }
}
