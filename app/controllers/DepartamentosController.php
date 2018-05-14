<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class DepartamentosController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for departamentos
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Departamentos', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idDepartamento";

        $departamentos = Departamentos::find($parameters);
        if (count($departamentos) == 0) {
            $this->flash->notice("The search did not find any departamentos");

            $this->dispatcher->forward([
                "controller" => "departamentos",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $departamentos,
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
     * Edits a departamento
     *
     * @param string $idDepartamento
     */
    public function editAction($idDepartamento)
    {
        if (!$this->request->isPost()) {

            $departamento = Departamentos::findFirstByidDepartamento($idDepartamento);
            if (!$departamento) {
                $this->flash->error("departamento was not found");

                $this->dispatcher->forward([
                    'controller' => "departamentos",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idDepartamento = $departamento->getIddepartamento();

            $this->tag->setDefault("idDepartamento", $departamento->getIddepartamento());
            $this->tag->setDefault("numeroDepartamento", $departamento->getNumerodepartamento());
            $this->tag->setDefault("numeroTelefono", $departamento->getNumerotelefono());
            $this->tag->setDefault("idUsuario", $departamento->getIdusuario());
            
        }
    }

    /**
     * Creates a new departamento
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "departamentos",
                'action' => 'index'
            ]);

            return;
        }

        $departamento = new Departamentos();
        $departamento->setnumeroDepartamento($this->request->getPost("numeroDepartamento"));
        $departamento->setnumeroTelefono($this->request->getPost("numeroTelefono"));
        $departamento->setidUsuario($this->request->getPost("idUsuario"));
        

        if (!$departamento->save()) {
            foreach ($departamento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "departamentos",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("departamento was created successfully");

        $this->dispatcher->forward([
            'controller' => "departamentos",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a departamento edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "departamentos",
                'action' => 'index'
            ]);

            return;
        }

        $idDepartamento = $this->request->getPost("idDepartamento");
        $departamento = Departamentos::findFirstByidDepartamento($idDepartamento);

        if (!$departamento) {
            $this->flash->error("departamento does not exist " . $idDepartamento);

            $this->dispatcher->forward([
                'controller' => "departamentos",
                'action' => 'index'
            ]);

            return;
        }

        $departamento->setnumeroDepartamento($this->request->getPost("numeroDepartamento"));
        $departamento->setnumeroTelefono($this->request->getPost("numeroTelefono"));
        $departamento->setidUsuario($this->request->getPost("idUsuario"));
        

        if (!$departamento->save()) {

            foreach ($departamento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "departamentos",
                'action' => 'edit',
                'params' => [$departamento->getIddepartamento()]
            ]);

            return;
        }

        $this->flash->success("Registro Actualizado Correctamnte");

        $this->dispatcher->forward([
            'controller' => "departamentos",
            'action' => 'index'
        ]);
		
		
    }

    /**
     * Deletes a departamento
     *
     * @param string $idDepartamento
     */
    public function deleteAction($idDepartamento)
    {
        $departamento = Departamentos::findFirstByidDepartamento($idDepartamento);
        if (!$departamento) {
            $this->flash->error("departamento was not found");

            $this->dispatcher->forward([
                'controller' => "departamentos",
                'action' => 'index'
            ]);

            return;
        }

        if (!$departamento->delete()) {

            foreach ($departamento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "departamentos",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("departamento was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "departamentos",
            'action' => "index"
        ]);
    }

}
