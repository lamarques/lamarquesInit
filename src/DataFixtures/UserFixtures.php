<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setUsername('lamarques');
        $user->setRoles([
            'ROLE_SUPERUSER',
            'ROLE_ADMIN',
            'ROLE_USER',
        ]);

        $user->setPassword($this->registePassword('admin123456', $user, $this->encoder));

        $manager->persist($user);
        $manager->flush();
    }

    public function registePassword(string $plainPassword, User $user, UserPasswordEncoderInterface $encoder)
    {
        return $encoded = $encoder->encodePassword($user, $plainPassword);
    }
}
