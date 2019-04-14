<?php

namespace App\Security\Voter;

use App\Repository\ModuleRepository;
use App\Repository\PermissionRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PermisionsVoter extends Voter
{
    protected $repo;
    protected $moduleRepository;
    protected $module;

    public function __construct(PermissionRepository $permissionRepository, ModuleRepository $moduleRepository)
    {
        $this->repo = $permissionRepository;
        $this->moduleRepository = $moduleRepository;
    }

    protected function supports($attribute, $module_name)
    {
        $this->module = $this->moduleRepository->findOneBy([
            'name' => $module_name
        ]);
        return in_array($attribute, ['CREATE', 'READ', 'UPDATE', 'DELETE']) && $this->module != null;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'CREATE':
                return $this->verificaPermissao('criar', $user, $this->module, $this->repo);
                break;
            case 'READ':
                // logic to determine if the user can VIEW
                // return true or false
                break;
            case 'UPDATE':
                // logic to determine if the user can EDIT
                // return true or false
                break;
            case 'DELETE':
                // logic to determine if the user can EDIT
                // return true or false
                break;
        }

        return false;
    }

    public function verificaPermissao($permissionType, $user, $module, PermissionRepository $permissionRepository)
    {
        $permission = $permissionRepository->findOneBy(
            [
                'username' => $user,
                'module' => $module,
                $permissionType => true
            ]
        );

        if(!$permission == null) {
            $fuction = "get".ucfirst($permissionType);
            return $permission->$fuction();
        }
        return false;
    }
}
