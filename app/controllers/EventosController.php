<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class EventosController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for eventos
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Eventos', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idEvento";

        $eventos = Eventos::find($parameters);
        if (count($eventos) == 0) {
            $this->flash->notice("The search did not find any eventos");

            $this->dispatcher->forward([
                "controller" => "eventos",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $eventos,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a evento
     *
     * @param string $idEvento
     */
    public function editAction($idEvento)
    {
        if (!$this->request->isPost()) {

            $evento = Eventos::findFirstByidEvento($idEvento);
            if (!$evento) {
                $this->flash->error("evento was not found");

                $this->dispatcher->forward([
                    'controller' => "eventos",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idEvento = $evento->getIdevento();

            $this->tag->setDefault("idEvento", $evento->getIdevento());
            $this->tag->setDefault("nombreEvento", $evento->getNombreevento());
            $this->tag->setDefault("horaInicio", $evento->getHorainicio());
            $this->tag->setDefault("horaFin", $evento->getHorafin());
            $this->tag->setDefault("fechaEvento", $evento->getFechaevento());
            $this->tag->setDefault("idDepartamento", $evento->getIddepartamento());
            
        }
    }

    /**
     * Creates a new evento
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "eventos",
                'action' => 'index'
            ]);

            return;
        }

        $evento = new Eventos();
        $evento->setnombreEvento($this->request->getPost("nombreEvento"));
        $evento->sethoraInicio($this->request->getPost("horaInicio"));
        $evento->sethoraFin($this->request->getPost("horaFin"));
        $evento->setfechaEvento($this->request->getPost("fechaEvento"));
        $evento->setidDepartamento($this->request->getPost("idDepartamento"));
        

        if (!$evento->save()) {
            foreach ($evento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "eventos",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("evento was created successfully");

        $this->dispatcher->forward([
            'controller' => "eventos",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a evento edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "eventos",
                'action' => 'index'
            ]);

            return;
        }

        $idEvento = $this->request->getPost("idEvento");
        $evento = Eventos::findFirstByidEvento($idEvento);

        if (!$evento) {
            $this->flash->error("evento does not exist " . $idEvento);

            $this->dispatcher->forward([
                'controller' => "eventos",
                'action' => 'index'
            ]);

            return;
        }

        $evento->setnombreEvento($this->request->getPost("nombreEvento"));
        $evento->sethoraInicio($this->request->getPost("horaInicio"));
        $evento->sethoraFin($this->request->getPost("horaFin"));
        $evento->setfechaEvento($this->request->getPost("fechaEvento"));
        $evento->setidDepartamento($this->request->getPost("idDepartamento"));
        

        if (!$evento->save()) {

            foreach ($evento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "eventos",
                'action' => 'edit',
                'params' => [$evento->getIdevento()]
            ]);

            return;
        }

        $this->flash->success("evento was updated successfully");

        $this->dispatcher->forward([
            'controller' => "eventos",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a evento
     *
     * @param string $idEvento
     */
    public function deleteAction($idEvento)
    {
        $evento = Eventos::findFirstByidEvento($idEvento);
        if (!$evento) {
            $this->flash->error("evento was not found");

            $this->dispatcher->forward([
                'controller' => "eventos",
                'action' => 'index'
            ]);

            return;
        }

        if (!$evento->delete()) {

            foreach ($evento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "eventos",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("evento was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "eventos",
            'action' => "index"
        ]);
    }

}
