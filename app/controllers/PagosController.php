<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PagosController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for pagos
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Pagos', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idPago";

        $pagos = Pagos::find($parameters);
        if (count($pagos) == 0) {
            $this->flash->notice("The search did not find any pagos");

            $this->dispatcher->forward([
                "controller" => "pagos",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $pagos,
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
     * Edits a pago
     *
     * @param string $idPago
     */
    public function editAction($idPago)
    {
        if (!$this->request->isPost()) {

            $pago = Pagos::findFirstByidPago($idPago);
            if (!$pago) {
                $this->flash->error("pago was not found");

                $this->dispatcher->forward([
                    'controller' => "pagos",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idPago = $pago->getIdpago();

            $this->tag->setDefault("idPago", $pago->getIdpago());
            $this->tag->setDefault("pagoAlicuta", $pago->getPagoalicuta());
            $this->tag->setDefault("fechaAlicuota", $pago->getFechaalicuota());
            $this->tag->setDefault("penalidadAlicuota", $pago->getPenalidadalicuota());
            $this->tag->setDefault("totalAlicuota", $pago->getTotalalicuota());
            $this->tag->setDefault("idDepartamento", $pago->getIddepartamento());
            
        }
    }

    /**
     * Creates a new pago
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'index'
            ]);

            return;
        }

        $pago = new Pagos();
        $pago->setpagoAlicuta($this->request->getPost("pagoAlicuta"));
        $pago->setfechaAlicuota($this->request->getPost("fechaAlicuota"));
        $pago->setpenalidadAlicuota($this->request->getPost("penalidadAlicuota"));
        $pago->settotalAlicuota($this->request->getPost("totalAlicuota"));
        $pago->setidDepartamento($this->request->getPost("idDepartamento"));
        

        if (!$pago->save()) {
            foreach ($pago->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("pago was created successfully");

        $this->dispatcher->forward([
            'controller' => "pagos",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a pago edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'index'
            ]);

            return;
        }

        $idPago = $this->request->getPost("idPago");
        $pago = Pagos::findFirstByidPago($idPago);

        if (!$pago) {
            $this->flash->error("pago does not exist " . $idPago);

            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'index'
            ]);

            return;
        }

        $pago->setpagoAlicuta($this->request->getPost("pagoAlicuta"));
        $pago->setfechaAlicuota($this->request->getPost("fechaAlicuota"));
        $pago->setpenalidadAlicuota($this->request->getPost("penalidadAlicuota"));
        $pago->settotalAlicuota($this->request->getPost("totalAlicuota"));
        $pago->setidDepartamento($this->request->getPost("idDepartamento"));
        

        if (!$pago->save()) {

            foreach ($pago->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'edit',
                'params' => [$pago->getIdpago()]
            ]);

            return;
        }

        $this->flash->success("pago was updated successfully");

        $this->dispatcher->forward([
            'controller' => "pagos",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a pago
     *
     * @param string $idPago
     */
    public function deleteAction($idPago)
    {
        $pago = Pagos::findFirstByidPago($idPago);
        if (!$pago) {
            $this->flash->error("pago was not found");

            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'index'
            ]);

            return;
        }

        if (!$pago->delete()) {

            foreach ($pago->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("pago was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "pagos",
            'action' => "index"
        ]);
    }

}
