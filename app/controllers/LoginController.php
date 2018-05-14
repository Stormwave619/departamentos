<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class LoginController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }
	
	
	public function loginAction()
	{

	}
	
	public function closeAction()
	{
		
		$this-> session->destroy();
	}
	
	public function logoutAction()
{
	$this->session->destroy();
	$this->flash->success('Sesión Terminada!');
	return $this->dispatcher->forward(["controller" => "login","action"=> "login"]);
}
	
	public function authorizeAction()
	{
		$username = $this->request->getPost('username');
		$pass= $this->request->getPost('password');
		$login=Login::findFirstByUsername($username);
		if ($login) {
			if ($this->security->checkHash($pass, $login->getpassword())) {
				$this->session->set('auth',
				['userName' => $login->getusername(), 
				 'role' => $login->getRole()]);
				$this->flash->success("Bienvenido: " . $login->getusername());
				return $this->dispatcher->forward(["controller" => "login","action" => "index"]);
			}
			else {
				$this->flash->error("Su contraseña es incorrecta");
				return $this->dispatcher->forward(["controller" => "login","action" => "login"]);
			}
		}
		else {
			$this->flash->error("Este usuario no existe");
			return $this->dispatcher->forward(["controller" => "login","action" => "login"]);
		}
		return $this->dispatcher->forward(["controller" => "index","action" => "index"]);
	}
	
	public function username()
	{
	}
	


    /**
     * Searches for login
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Login', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $login = Login::find($parameters);
        if (count($login) == 0) {
            $this->flash->notice("No existe ese usuario");

            $this->dispatcher->forward([
                "controller" => "login",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $login,
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
     * Edits a login
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $login = Login::findFirstByid($id);
            if (!$login) {
                $this->flash->error("login was not found");

                $this->dispatcher->forward([
                    'controller' => "login",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $login->getId();

            $this->tag->setDefault("id", $login->getId());
            $this->tag->setDefault("username", $login->getUsername());
            $this->tag->setDefault("password", $login->getPassword());
            $this->tag->setDefault("firstname", $login->getFirstname());
            $this->tag->setDefault("surname", $login->getSurname());
            $this->tag->setDefault("emailAddress", $login->getEmailaddress());
            $this->tag->setDefault("role", $login->getRole());
            $this->tag->setDefault("validationkey", $login->getValidationkey());
            $this->tag->setDefault("status", $login->getStatus());
            $this->tag->setDefault("createdat", $login->getCreatedat());
            $this->tag->setDefault("updatedat", $login->getUpdatedat());
            
        }
    }

    /**
     * Creates a new login
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "login",
                'action' => 'index'
            ]);

            return;
        }

        $login = new Login();
        $login->setusername($this->request->getPost("username"));
        $login->setpassword($this->security->hash($this->request->getPost("password")));
        $login->setfirstname($this->request->getPost("firstname"));
        $login->setsurname($this->request->getPost("surname"));
        $login->setemailAddress($this->request->getPost("emailAddress"));
		$login->setrole("Registered User");
		$login->setstatus("Active");
		$login->setvalidationkey(md5($this->request->getPost("username") . uniqid()));
		$login->setcreatedat((new DateTime())->format("Y-m-d H:i:s"));//will set to the current date/time
        

        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "login",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Registro creado Satisfactoriamente");

        $this->dispatcher->forward([
            'controller' => "login",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a login edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "login",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $login = Login::findFirstByid($id);

        if (!$login) {
            $this->flash->error("El usuario no existe " . $id);

            $this->dispatcher->forward([
                'controller' => "login",
                'action' => 'index'
            ]);

            return;
        }

        $login->setusername($this->request->getPost("username"));
        $login->setpassword($this->request->getPost("password"));
        $login->setfirstname($this->request->getPost("firstname"));
        $login->setsurname($this->request->getPost("surname"));
        $login->setemailAddress($this->request->getPost("emailAddress"));
        $login->setrole($this->request->getPost("role"));
        $login->setvalidationkey($this->request->getPost("validationkey"));
        $login->setstatus($this->request->getPost("status"));
        $login->setcreatedat($this->request->getPost("createdat"));
        $login->setupdatedat($this->request->getPost("updatedat"));
        

        if (!$login->save()) {

            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "login",
                'action' => 'edit',
                'params' => [$login->getId()]
            ]);

            return;
        }

        $this->flash->success("Registro actualizado Correctamente");

        $this->dispatcher->forward([
            'controller' => "login",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a login
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $login = Login::findFirstByid($id);
        if (!$login) {
            $this->flash->error("Registro no Encontrado");

            $this->dispatcher->forward([
                'controller' => "login",
                'action' => 'index'
            ]);

            return;
        }

        if (!$login->delete()) {

            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "login",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Registro borrado correctamente");

        $this->dispatcher->forward([
            'controller' => "login",
            'action' => "index"
        ]);
    }

}
