<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 23/02/15
 * Time: 16:54
 */

namespace PainelGetNet\AppBundle\Entity;


use Sonata\UserBundle\Entity\BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group extends BaseGroup{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

}