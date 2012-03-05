<?php

namespace LetsFrame\BiduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;


use LetsFrame\BiduleBundle\Entity\Bidule;
use LetsFrame\BiduleBundle\Form\BiduleType;

use LetsFrame\GalleryBundle\Entity\Gallery;
use LetsFrame\GalleryBundle\Entity\Image;
use LetsFrame\GalleryBundle\Form\ImageType;

/**
 * Bidule controller.
 *
 * @Route("/admin/bidule")
 */
class DefaultController extends Controller
{
    /**
     * Lists all Bidule entities.
     *
     * @Route("/", name="bidules")
     * @Template("LetsFrameBiduleBundle:Bidule:index.html.twig")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getEntityManager()->getRepository('LetsFrameBiduleBundle:Bidule');

        $query = $repo->createQBfindAll();
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(10);
        $paginator->setCurrentPage($this->get('request')->query->get('page', 1), false, true);

        return array('paginator' => $paginator);
    }

    /**
     * Creates a new Bidule entity.
     *
     * @Route("/create", name="bidule_create")
     * @Template("LetsFrameBiduleBundle:Bidule:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Bidule();
        $request = $this->getRequest();
        $form    = $this->createForm(new BiduleType(), $entity);

        if ($request->getMethod() == 'POST')
        {

            $form->bindRequest($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('bidule_edit', array('id' => $entity->getId()) ));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Bidule entity.
     *
     * @Route("/{id}/edit", name="bidule_edit")
     * @Template("LetsFrameBiduleBundle:Bidule:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LetsFrameBiduleBundle:Bidule')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Bidule entity.');
        }

        $editForm   = $this->createForm(new BiduleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        //Images des bidule
        $imageEntity = new Image();
        $editImageForm = $this->createForm(new ImageType(), $imageEntity);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {

            //update Image ?
            if($request->request->get('letsframe_gallerybundle_imagetype'))
            {
                $editImageForm->bindRequest($request);

                if ($editImageForm->isValid())
                {
                    $imageEntity->upload();
                    $imageEntity->setGallery($entity->getGallery());

                    $em->persist($imageEntity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('bidule_edit', array('id' => $id)));
                }
            }

            //update Bidule
            else
            {

                $editForm->bindRequest($request);

                if ($editForm->isValid())
                {
                    $em->persist($entity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('bidule_edit', array('id' => $id)));
                }
            }
        }

         //sans cette ligne, twig ne voit pas les images de l'entité !?
        $images = $entity->getGallery()->getImages();

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'edit_image_form'   => $editImageForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * delete an Image
     *
     * @Route("/{id}/delete_image", name="image_delete")
     */
    public function deleteImage($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $image = $em->getRepository('LetsFrameCompaniesBundle:ImageCompanie')->find($id);

        if (!$image)
        {
            throw $this->createNotFoundException('Unable to find ImageCompanie entity.');
        }

        $id_companie = $image->getCompanie()->getId();

        $em->remove($image);
        $em->flush();

        return $this->redirect($this->generateUrl('companie_edit', array('id' => $id_companie)));
    }


    /**
     * Deletes a Bidule entity.
     *
     * @Route("/{id}/delete", name="bidule_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('LetsFrameBiduleBundle:Bidule')->find($id);

            if (!$entity)
            {
                throw $this->createNotFoundException('Unable to find Bidule entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bidules'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
