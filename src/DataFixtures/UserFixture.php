<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends AppFixtures
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        //Users seed
        $this->createMany(3,'main_users', function ($i)
        {
            $user = new User();
            $user->setEmail(sprintf('User%d@test.com', $i));
            $user->setUsername(sprintf('User%d',$i));
            $user->setRoles(['ROLE_USERS']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'haslo'
            ));
            return $user;
        });
        //Admin seed
        $this->createMany(2,'admin_users', function ($i)
        {
            $user = new User();
            $user->setEmail(sprintf('Admin%d@test.com', $i));
            $user->setUsername(sprintf('Admin%d',$i));
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'asd'
            ));
            return $user;
        });

        $manager->flush();
    }
}
