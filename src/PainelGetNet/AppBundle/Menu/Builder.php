<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 26/02/15
 * Time: 10:40
 */

namespace PainelGetNet\AppBundle\Menu;

use PainelGetNet\AppBundle\Entity\User;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class Builder
 *
 * Create all the main menus in the applications
 * like main menu and user menu
 */
class Builder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Create the application main menu
     *
     * @param RequestStack $requestStack
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild('GetNet', ['uri' => '#']);
        $menu['GetNet']->addChild('Relatório de vendas', ['route' => 'getnet_relatorio_vendas']);
        $menu['GetNet']->addChild('Relatórios de pagamentos', ['route' => 'getnet_relatorio_pagamentos']);
        return $menu;
    }

    /**
     * Create the application user menu
     *
     * @param RequestStack $requestStack
     * @param User $user
     * @return \Knp\Menu\ItemInterface
     */
    public function createUserMenu(RequestStack $requestStack, User $user = null)
    {
        $menu = $this->factory->createItem('root');
        if(!$user instanceof User){
            return $menu;
        }

        $menu->addChild($user->getFullname(), ['extras' => ['icon' => 'user']]);
        $menu[$user->getFullname()]->addChild('Editar perfil', ['route' => 'sonata_user_profile_edit']);
        $menu[$user->getFullname()]->addChild('Alterar senha', ['route' => 'sonata_user_change_password']);
        $menu[$user->getFullname()]->addChild('Sair', ['route' => 'logout']);

        return $menu;
    }
}