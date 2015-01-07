<?php
namespace Valiknet\MusicBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class ExtendPaginatorExtensions
{
    private $paginator;
    private $request;

    public function __construct($paginator, RequestStack $requestStack)
    {
        $this->paginator = $paginator;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function extend($object)
    {
        return $this->paginator->paginate(
            $object,
            $this->request->query->get('page', 1),
            10
        );
    }
}
