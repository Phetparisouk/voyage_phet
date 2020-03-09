<?php

namespace App\Controller;


use App\Entity\Decouverte;
use App\Form\DecouverteType;
use App\Form\ContinentFilterType;
use App\Form\Model\ContinentFilterModel;
use App\Repository\DecouverteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DecouverteController extends AbstractController
{
    /**
     * @Route("/decouverte", name="decouverte.index")
     */
    public function index(DecouverteRepository $decouverteRepository, Request $request)
    {
        $model = new ContinentFilterModel();
        $form = $this->createForm(ContinentFilterType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $decouverte = $decouverteRepository->filter($model->getContinent());
            return $this->render('decouverte/index.html.twig', [
                'decouverte' => $decouverte->getResult(),
                'form' => $form->createView()
            ]);
        }

		$results = $decouverteRepository->findAll();
		return $this->render('decouverte/index.html.twig', [
            'results' => $results,
            'form' => $form->createView()
		]);
    }

	/**
	 * @Route("/decouverte/form", name="decouverte.form")
	 * @Route("/decouverte/form/update/{id}", name="decouverte.form.update")
	 */
	public function form(Request $request, EntityManagerInterface $entityManager, int $id = null, DecouverteRepository $decouverteRepository):Response
	{
		// affichage d'un formulaire
		$type = DecouverteType::class;
		$model = $id ? $decouverteRepository->find($id) : new Decouverte();
		$form = $this->createForm($type, $model);
		$form->handleRequest($request);

		// si le formulaire est valide
		if($form->isSubmitted() && $form->isValid()){
			//dd($model);
			/*
			 * insertion dans une table
			 * EntityManagerInterface permet d'exécuter UPDATE, DELETE, INSERT
			 *   méthode persist permet un INSERT
			 *   lors d'un UPDATE, aucune méthode n'est requise
			 *   méthode flush permet d'exécuter les requêtes
			 */
			$id ? null : $entityManager->persist($model);
			$entityManager->flush();

			// message de confirmation
			$message = $id ? "La decouverte a été modifié" : "La decouverte a été ajouté";
			$this->addFlash('notice', $message);

			// redirection
			return $this->redirectToRoute('decouverte.index');
		}

		return $this->render('decouverte/form.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/decouverte/delete/{id}", name="decouverte.delete")
	 */
	public function delete(DecouverteRepository $decouverteRepository, EntityManagerInterface $entityManager, int $id):Response
	{
		/*
		 * avec doctrine, pour supprimer une entité, il faut la sélectionner au préalable
		 * méthode remove pour DELETE
		 */
		$entity = $decouverteRepository->find($id);
		$entityManager->remove($entity);
		$entityManager->flush();

		// message de confirmation et redirection
		$this->addFlash('notice', 'La decouverte a été supprimé');
		return $this->redirectToRoute('decouverte.index');
    }
    
    /*
     * @Route("/decouverte/details/{slug}", name="decouverte.details")
     */
    /*
    public function details(string $slug, DecouverteRepository $decouverteRepository)
    {
        $decouverte = $decouverteRepository->findOneBy([
            'slug' => $slug
        ]);

        return $this->render('decouverte/details.html.twig', [
            'decouverte' => $decouverte,
        ]);
    }
    */


}
