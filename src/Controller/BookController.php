<?php

namespace App\Controller;

use App\Entity\Items;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class BookController extends AbstractController
{
    #[Route('/', name: 'book')]
    public function index(): Response
    {
        $items = $this->getDoctrine()->getRepository(Items::class)->findAll();
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController', 'items' => $items
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        // Here we create an object from the class that we made

        $item = new Items;

        /* Here we will build a form using createFormBuilder and inside this function we will put our object and then we write add then we select the input type then an array to add an attribute that we want in our input field */

        $form = $this->createFormBuilder($item)->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('author', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('pub_date', DateType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('price', NumberType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('picture', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-botton:15px')))



            ->add('save', SubmitType::class, array('label' => 'Create Items', 'attr' => array('class' => 'btn-primary', 'style' => 'margin-bottom:15px')))

            ->getForm();

        $form->handleRequest($request);




        /* Here we have an if statement, if we click submit and if  the form is valid we will take the values from the form and we will save them in the new variables */

        if ($form->isSubmitted() && $form->isValid()) {

            //fetching data


            // taking the data from the inputs by the name of the inputs then getData() function

            $name = $form['name']->getData();

            $author = $form['author']->getData();

            $description = $form['description']->getData();

            $pub_date = $form['pub_date']->getData();

            $price = $form['price']->getData();
            $picture = $form['picture']->getData();






            /* these functions we bring from our entities, every column have a set function and we put the value that we get from the form */

            $item->setName($name);

            $item->setAuthor($author);

            $item->setDescription($description);
            $item->setPubDate($pub_date);

            $item->setPrice($price);



            $item->setPicture($picture);

            $em = $this->getDoctrine()->getManager();

            $em->persist($item);

            $em->flush();

            $this->addFlash(

                'notice',

                'Book Added'

            );

            return $this->redirectToRoute('book');
        }

        /* now to make the form we will add this line form->createView() and now you can see the form in create.html.twig file  */

        return $this->render('book/create.html.twig', array('form' => $form->createView()));
    }
    #[Route('/details/{id}', name: 'details')]
    public function details($id): Response
    {
        $item = $this->getDoctrine()->getRepository(Items::class)->find($id);
        return $this->render('book/details.html.twig', array('item' => $item));
    }
    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Request $request, $id)
    {
        $item = $this->getDoctrine()->getRepository(Items::class)->find($id);

        /* Here we will build a form using createFormBuilder and inside this function we will put our object and then we write add then we select the input type then an array to add an attribute that we want in our input field */

        $form = $this->createFormBuilder($item)->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('author', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('pub_date', DateType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('price', NumberType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('picture', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-botton:15px')))



            ->add('save', SubmitType::class, array('label' => 'Create Items', 'attr' => array('class' => 'btn-primary', 'style' => 'margin-bottom:15px')))

            ->getForm();

        $form->handleRequest($request);




        /* Here we have an if statement, if we click submit and if  the form is valid we will take the values from the form and we will save them in the new variables */

        if ($form->isSubmitted() && $form->isValid()) {

            //fetching data


            // taking the data from the inputs by the name of the inputs then getData() function

            $name = $form['name']->getData();

            $author = $form['author']->getData();

            $description = $form['description']->getData();

            $pub_date = $form['pub_date']->getData();

            $price = $form['price']->getData();
            $picture = $form['picture']->getData();






            /* these functions we bring from our entities, every column have a set function and we put the value that we get from the form */

            $item->setName($name);

            $item->setAuthor($author);

            $item->setDescription($description);
            $item->setPubDate($pub_date);

            $item->setPrice($price);



            $item->setPicture($picture);

            $em = $this->getDoctrine()->getManager();

            $em->persist($item);

            $em->flush();

            $this->addFlash(

                'notice',

                'Book updated'

            );

            return $this->redirectToRoute('book');
        }

        /* now to make the form we will add this line form->createView() and now you can see the form in create.html.twig file  */

        return $this->render('book/edit.html.twig', array('form' => $form->createView()));
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function delete($id)

    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Items::class)->find($id);
        $em->remove($item);
        $em->flush();
        $this->addFlash(

            'notice',

            'Todo Removed'

        );
        return $this->redirectToRoute('book');
    }
}
