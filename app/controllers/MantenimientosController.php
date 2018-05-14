<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class MantenimientosController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for mantenimientos
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Mantenimientos', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idMantenimiento";

        $mantenimientos = Mantenimientos::find($parameters);
        if (count($mantenimientos) == 0) {
            $this->flash->notice("The search did not find any mantenimientos");

            $this->dispatcher->forward([
                "controller" => "mantenimientos",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $mantenimientos,
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
     * Edits a mantenimiento
     *
     * @param string $idMantenimiento
     */
    public function editAction($idMantenimiento)
    {
        if (!$this->request->isPost()) {

            $mantenimiento = Mantenimientos::findFirstByidMantenimiento($idMantenimiento);
            if (!$mantenimiento) {
                $this->flash->error("mantenimiento was not found");

                $this->dispatcher->forward([
                    'controller' => "mantenimientos",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idMantenimiento = $mantenimiento->getIdmantenimiento();

            $this->tag->setDefault("idMantenimiento", $mantenimiento->getIdmantenimiento());
            $this->tag->setDefault("nombreMantenimiento", $mantenimiento->getNombremantenimiento());
            $this->tag->setDefault("fechaInicio", $mantenimiento->getFechainicio());
            $this->tag->setDefault("fechaFin", $mantenimiento->getFechafin());
            $this->tag->setDefault("costoMantenimiento", $mantenimiento->getCostomantenimiento());
            $this->tag->setDefault("votoMantenimiento", $mantenimiento->getVotomantenimiento());
            $this->tag->setDefault("idDepartamento", $mantenimiento->getIddepartamento());
            
        }
    }

    /**
     * Creates a new mantenimiento
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "mantenimientos",
                'action' => 'index'
            ]);

            return;
        }

        $mantenimiento = new Mantenimientos();
        $mantenimiento->setnombreMantenimiento($this->request->getPost("nombreMantenimiento"));
        $mantenimiento->setfechaInicio($this->request->getPost("fechaInicio"));
        $mantenimiento->setfechaFin($this->request->getPost("fechaFin"));
        $mantenimiento->setcostoMantenimiento($this->request->getPost("costoMantenimiento"));
        $mantenimiento->setvotoMantenimiento($this->request->getPost("votoMantenimiento"));
        $mantenimiento->setidDepartamento($this->request->getPost("idDepartamento"));
        

        if (!$mantenimiento->save()) {
            foreach ($mantenimiento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "mantenimientos",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("mantenimiento was created successfully");

        $this->dispatcher->forward([
            'controller' => "mantenimientos",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a mantenimiento edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "mantenimientos",
                'action' => 'index'
            ]);

            return;
        }

        $idMantenimiento = $this->request->getPost("idMantenimiento");
        $mantenimiento = Mantenimientos::findFirstByidMantenimiento($idMantenimiento);

        if (!$mantenimiento) {
            $this->flash->error("mantenimiento does not exist " . $idMantenimiento);

            $this->dispatcher->forward([
                'controller' => "mantenimientos",
                'action' => 'index'
            ]);

            return;
        }

        $mantenimiento->setnombreMantenimiento($this->request->getPost("nombreMantenimiento"));
        $mantenimiento->setfechaInicio($this->request->getPost("fechaInicio"));
        $mantenimiento->setfechaFin($this->request->getPost("fechaFin"));
        $mantenimiento->setcostoMantenimiento($this->request->getPost("costoMantenimiento"));
        $mantenimiento->setvotoMantenimiento($this->request->getPost("votoMantenimiento"));
        $mantenimiento->setidDepartamento($this->request->getPost("idDepartamento"));
        

        if (!$mantenimiento->save()) {

            foreach ($mantenimiento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "mantenimientos",
                'action' => 'edit',
                'params' => [$mantenimiento->getIdmantenimiento()]
            ]);

            return;
        }

        $this->flash->success("mantenimiento was updated successfully");

        $this->dispatcher->forward([
            'controller' => "mantenimientos",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a mantenimiento
     *
     * @param string $idMantenimiento
     */
    public function deleteAction($idMantenimiento)
    {
        $mantenimiento = Mantenimientos::findFirstByidMantenimiento($idMantenimiento);
        if (!$mantenimiento) {
            $this->flash->error("mantenimiento was not found");

            $this->dispatcher->forward([
                'controller' => "mantenimientos",
                'action' => 'index'
            ]);

            return;
        }

        if (!$mantenimiento->delete()) {

            foreach ($mantenimiento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "mantenimientos",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("mantenimiento was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "mantenimientos",
            'action' => "index"
        ]);
    }
	
	public function resultadoAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Mantenimientos', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idMantenimiento";

        $mantenimientos = Mantenimientos::find($parameters);
        if (count($mantenimientos) == 0) {
            $this->flash->notice("The search did not find any mantenimientos");

            $this->dispatcher->forward([
                "controller" => "mantenimientos",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $mantenimientos,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }
	
	public function votarAction($idMantenimiento)
	{
		$option = Mantenimientos::findFirstByidMantenimiento($idMantenimiento);
		$option->votoMantenimiento++;
		$option->save();
		
		return $this->dispatcher->forward(array(
		        'action' => 'search',
				'params' => array($option->idMantenimiento)
				));
		
		
	}
	

}
