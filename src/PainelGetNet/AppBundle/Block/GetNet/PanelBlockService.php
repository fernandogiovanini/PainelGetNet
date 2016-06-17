<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 12/03/15
 * Time: 12:57
 */

namespace PainelGetNet\AppBundle\Block\GetNet;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PanelBlockService extends BaseBlockService
{
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $blockContext->getSettings()
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        // TODO: Implement validateBlock() method.
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('title', 'text', array()),
                array('rows', 'sonata_type_immutable_array', array()),
                array('template', 'text', array()),
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Panel';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'title'  => 'Título',
            'rows' => [
                ['value' => 'R$ 300,00']
            ],
            'template' => 'PainelGetNetAppBundle:Block:panel.html.twig'
        ));
    }
}