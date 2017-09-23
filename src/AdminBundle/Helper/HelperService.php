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
        $entity = new \AdminBundle\Entity\UserRemidio();
        $admin = $this->em->getRepository('AdminBundle:UserRemidio')->findBy(array('username'=>$username));
        if (empty($admin)) {
            $entity->setUsername($username);
            $entity = $this->setAdminPassword($entity, $password);
            $this->em->persist($entity);
            $this->em->flush();
        }
    }
    
    public function setAdminPassword($entity, $plainPassword)
    {
        $encoder = $this->encoder->getEncoder($entity);
        $salt = \uniqid();
        $password = $encoder->encodePassword($plainPassword, $salt);
        $entity->setPassword($password);
        $entity->setSalt($salt);
        $entity->setRoles("ROLE_ADMIN");
        return $entity;
    }
}
