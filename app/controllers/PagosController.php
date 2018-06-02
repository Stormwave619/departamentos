<?php

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\Model\Manager;
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
            $this->flash->notice("La busqueda no arrojo resultados");

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
                $this->flash->error("Pago no Encontrado");

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
        /*
        $con = new Phalcon\Db\Adapter\Pdo\Mysql(array(

            'host'=>'localhost',
            'username'=>'root',
            'password'=>'',
            'dbname'=>'departamentos'
        ));

        $con->connect();
        $sql='SELECT pagos.idDepartamento, COUNT(*)
                FROM pagos 
                GROUP BY pagos.idDepartamento';
        $result=$con->query($sql);
        $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
        $result=$result->fetchAll($result);

        foreach ($result as $one) 
        {
            echo print_r($one). '<br>';
        }
        */



        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "pagos",
                'action' => 'index'
            ]);

            return;
        }

    
        $fecha1=$this->request->getPost("fechaAlicuota");
        $fecha2 = date('Y-m-d');
        $pago=$this->request->getPost("pagoAlicuta");
       
        $calculo = 0;


            if ($fecha1>$fecha2){

                $calculo=$pago+($pago*0.05);

                $pago = new Pagos();
                $pago->setpagoAlicuta($this->request->getPost("pagoAlicuta"));
                $pago->setfechaAlicuota($this->request->getPost("fechaAlicuota"));
                $pago->setpenalidadAlicuota($this->request->getPost("penalidadAlicuota"));
                $pago->settotalAlicuota($calculo);
                $pago->setidDepartamento($this->request->getPost("idDepartamento"));
                $detector = $this->request->getPost("penalidadAlicuota");




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

                $this->flash->success("Pago Ingresado con Penalidad");

                $this->dispatcher->forward([
                    'controller' => "pagos",
                    'action' => 'index'
                ]);


            }else{

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

                $this->flash->success("Pago ingresado");

                $this->dispatcher->forward([
                    'controller' => "pagos",
                    'action' => 'index'
                ]);
            
            }

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

        $this->flash->success("Pago Actualizado Satisfactoriamente");

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
            $this->flash->error("Pago no encontrado");

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

        $this->flash->success("Pago Borrado Satisfactoriamente");

        $this->dispatcher->forward([
            'controller' => "pagos",
            'action' => "index"
        ]);
    }

}
