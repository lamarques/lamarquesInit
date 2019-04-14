<?php

namespace App\DataFixtures;

use App\Entity\Module;
use App\Entity\Permission as Perms;
use App\Entity\User;
use App\Repository\ModuleRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PopulaDadosFixture extends Fixture
{

    protected $encoder;
    public $username;
    public $moduleRepository;

    public function __construct(UserPasswordEncoderInterface $encoder, UserRepository $userRepository, ModuleRepository $moduleRepository)
    {
        $this->encoder = $encoder;
        $this->moduleRepository = $moduleRepository;
    }

    public function load(ObjectManager $manager)
    {
        $user = $this->populaUser($manager);
        $this->populaModule($manager);
        $modules = $this->moduleRepository->findAll();

        foreach ($modules as $module){
            $this->populaPermissoes($manager, $user, $module);
        }

        $manager->flush();
    }

    public function populaUser(ObjectManager $manager){
        $user = new User();
        $user->setUsername('Administrador');
        $user->setRoles([
            'ROLE_SUPERUSER',
            'ROLE_ADMIN',
            'ROLE_USER',
        ]);

        $user->setPassword($this->registePassword('nanith+2010', $user));

        $manager->persist($user);
        $manager->flush();
        return $user;
    }

    public function registePassword(string $plainPassword, User $user)
    {
        return $encoded = $this->encoder->encodePassword($user, $plainPassword);
    }

    public function populaModule(ObjectManager $manager)
    {
        $module = new Module();
        $module->setName('Financeiro');
        $manager->persist($module);
        $module = new Module();
        $module->setName('Caixa');
        $manager->persist($module);
        $module = new Module();
        $module->setName('Administração');
        $manager->persist($module);
        $module = new Module();
        $module->setName('Negociação');
        $manager->persist($module);
        $module = new Module();
        $module->setName('Relatorios');
        $manager->persist($module);



        $manager->flush();
    }

    public function populaPermissoes(ObjectManager $manager, $user, $module){
        $permissions = new Perms();
        $permissions->setUsername($user)
            ->setLer(true)
            ->setCriar(true)
            ->setEditar(true)
            ->setApagar(false)
        ;
        $permissions->setModule($module);

        $manager->persist($permissions);


        $manager->flush();
    }

    public function getModule($id)
    {
        return $this->moduleRepository->find($id);
    }

}
