<?php

namespace App\Controller\Admin;

use App\Entity\FormFields;
use App\Entity\SpaceMission;
use App\Form\FormFieldsType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;
use Umbrella\CoreBundle\Controller\BaseController;

/**
 * Class FormController
 *
 * @Route("/form")
 */
class FormController extends BaseController
{
    /**
     * @Route("/{layout}", defaults={"layout": "horizontal"})
     */
    public function index(Request $request, string $layout)
    {
        $entity = $this->em()->createQuery(sprintf('SELECT e FROM %s e', FormFields::class))->getOneOrNullResult();

        $form = $this->createForm(FormFieldsType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistAndFlush($entity);

            $this->toastSuccess(t('Item updated'));

            return $this->redirectToRoute('app_admin_form_index');
        }

        return $this->render('admin/form/index.html.twig', [
            'form' => $form->createView(),
            'layout' => $layout
        ]);
    }

    /**
     * @Route("/api")
     */
    public function api(Request $request)
    {
        $qb = $this->em()->createQueryBuilder();
        $qb->select('e');
        $qb->from(SpaceMission::class, 'e');

        $q = trim($request->query->get('query'));

        if (!empty($q)) {
            $qb->andWhere('LOWER(e.search) LIKE :search');
            $qb->setParameter('search', '%' . strtolower($q) . '%');
        }

        $results = [];
        foreach ($qb->getQuery()->toIterable() as $mission) {
            $results[] = [
                'id' => $mission->id,
                'text' => (string) $mission,
                'detail' => $mission->detail,
            ];
        }

        return new JsonResponse(['results' => $results]);
    }
}
