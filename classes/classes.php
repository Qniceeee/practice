
<?php

require_once 'conf/config.php';
class errorReport
{

    public static function checkErrorCalc($param)
    {
        $errors = [];
        $allowedActions = ['plus', 'minus', 'divide', 'multiple'];

        if (!isset($param['x'])) {
            $errors[] = 'Parameter "x" is missing';
        }
        elseif (!is_numeric($param['x'])) {
            $errors[] = 'Parameter "x" must be numeric';
        }

        if (!isset($param['y'])) {
            $errors[] = 'Parameter "y" is missing';
        }
        elseif (!is_numeric($param['y'])) {
            $errors[] = 'Parameter "y" must be numeric';

        }

        if (empty($param['action'])) {
            $errors[] = 'Parameter "action" is missing';
        }
        elseif (!in_array($param['action'], $allowedActions)) {
            $errors[] = 'Parameter "action" must be one of these values: ' . implode(',', $allowedActions);
        }
         if (!isset($_SESSION['account_id'])) {
             $errors[] = 'Авторизуйтесь';
         }

        // $error_array = implode('<br>',$errors);
         return $errors;
       // return $errors;
    }


}
class calculator{
    public $x;
    public $y;
    public $action;
    public $result;

    function __construct($x,$y,$action)
    {
        $this->x = $x;
        $this->y = $y;
        $this->action = $action;

    }
    function calculate($x,$y,$action)
    {
        $result = null;
        switch ($action)
        {
            case 'plus':
                $result = $x + $y;
                break;
            case 'minus':
                $result = $x - $y;
                break;
            case 'divide':
                $result = $x / $y;
                break;
            case 'multiple':
                $result = $x * $y;
                break;
        }
        return $result;
    }

    public static function calcResulty($param)
    {
        if (!empty($param)){


            $errorcache = errorReport::checkErrorCalc($param);
            echo implode('<br>',$errorcache);

            if(empty($errorcache)){

                $x = $param['x'];
                $y = $param['y'];
                $action = $param['action'];

                $calcul = new calculator('$x', '$y', '$action');



                $result = $calcul->calculate($x, $y, $action);
                    echo 'Ответ:'.$result;
                $time_date1 = date("Y-m-d");
                global $pdo_calc;
                $savePostResults = "INSERT INTO results (setup, date, type) VALUES  ('$result', '$time_date1', '$action')";
                $pdo_calc->exec($savePostResults);
            }else{

                errorReport::checkErrorCalc($param);
            }
        }

    }



}


class viewResults{
    public static function viewCalculationsGroup ()
    {
        global $pdo_calc;
    $result_calc = $pdo_calc->prepare("SELECT date, COUNT(*) FROM results GROUP BY date");
$result_calc->execute();
$row_calc_result = $result_calc->fetchAll();

    $island_desk = 0;
    foreach ($row_calc_result as $rowExec)
    {
        if ($island_desk < 1)
        {
            echo '<table border="1">';
            $island_desk++;
        }

        echo "<tr>";

        echo "<td>" . "Запросов:" . $rowExec['COUNT(*)'] . "</td>";
        echo "<td>" . "Даты:" . $rowExec['date'] . "</td>";
        echo "</tr>";


    }
    echo "</tabl>";
    }
public static function viewCalculationsResults(){

    global $pdo_calc;
    $result_calc_table = $pdo_calc->prepare('SELECT * FROM results');
    $result_calc_table->execute();

    $table_res = $result_calc_table->fetchAll();
    $island_table = 0;
    foreach ($table_res as $calc_rowTable) {
        if ($island_table < 1) {
            echo '<table border="1">';
            $island_table++;
        }
        $id_db = $calc_rowTable['id'];
        echo "<tr>";
        echo "<td>" . "Число:" . $calc_rowTable['setup'] . "</td>";
        echo "<td>" . "Дата:" . $calc_rowTable['date'] . "</td>";
        echo "<td>" . "Тип:" . $calc_rowTable['type'] . "</td>";
        echo "<td>" . '<form action="delete" method="post">';
        echo "<input type='hidden' name='id' value='$id_db' />" . '<input type="submit" value="DEL">';
        echo '</form>' . "</td>";

        echo "</tr>";

    }
    echo "</table>";


}
}
class deleteResultsController{
   public static function deletePostTable(){
        global $pdo_calc;
        $delete_post = $_POST['id'];
        $deleteCalcPost = $pdo_calc->prepare("DELETE FROM
 results WHERE id = '$delete_post'");
        $deleteCalcPost->execute();


    }
}

class errorReportLog{
    public static function checkErrorlog($auth_params)
    {
        $authErrors = [];
        {
            if (empty($auth_params['login'])) {
                $authErrors[] = 'login is missing';
            }
            if (empty($auth_params['password'])) {
                $authErrors[] = 'password is missing';
            }
        }
        return $authErrors;
    }
}
class loginUser
{
    public $login;
    public $password;


    function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;


    }
    public function execLog($login, $password){
        try {
            global $pdo_auth;


            $result_login = $pdo_auth->prepare("SELECT * FROM users WHERE login='$login' AND password='$password'");
            $result_login->execute();
            $rowLogin = $result_login->fetch();
           // var_dump($rowLogin);
            if($rowLogin){

                $_SESSION['account_id'] = $rowLogin['account_id'];


               // header('Location: index');



            }else{
                echo '<br>' . 'Отказанов в доступе';

            }
        }catch ( PDOException $e){

            echo $e->getMessage();
            echo 'отказано в доступе';
        }
    }

    public static function RegResulty($param)
    {
        if (!empty($param)) {


            $errorcachereg = errorReportLog::checkErrorlog($param);
            echo implode('<br>', $errorcachereg);

            if (empty($errorcache)) {

                $login = $param['login'];
                $password = $param['password'];


                $registration = new loginUser('$login','$password');

                $registration->execLog($login, $password);




            } else {

                errorReportLog::checkErrorlog($param);
            }
        }

    }
}


class errorsReg
{
    public static function checkErrorReg($paramReg)
    {
        $regErrors = [];
        {
            if (empty($paramReg['login'])) {
                $regErrors[] = 'login is missing';
            }
            if (empty($paramReg['password'])) {
                $regErrors[] = 'password is missing';
            }
            if (empty($paramReg['email'])) {
                $regErrors[] = 'email is missing';
            }
        }
        return $regErrors;

    }
}
class bigUser
{
    public $login;
    public $password;
    public $email;

    public function __construct($login, $password, $email)
    {

        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }

    public function execReg($login, $password, $email)
    {


        try {
            global $pdo_auth;

            $sql = "INSERT INTO users (login, password, email) VALUES ('$login', '$password', '$email')";
            $pdo_auth->exec($sql);

            echo 'Вы успешно зарегистрированы';
        } catch (PDOException $e) {
            echo '<br>' . 'такой пользователь существует или отказано в доступе';
        }

    }

    public static function ResultReg($paramReg)
    {
        if (!empty($paramReg)) {


            $errorcache = errorsReg::checkErrorReg($paramReg);
            echo implode('<br>', $errorcache);

            if (empty($errorcache)) {

                $login = $paramReg['login'];
                $password = $paramReg['password'];
                $email = $paramReg['email'];


                $registration = new bigUser("$login", "$password", "$email");
                $registration->execReg($login, $password, $email);
            } else {

                errorsReg::checkErrorReg($paramReg);
            }
        }
    }
}
class userNickName{
    public $account_id;

    function __construct($account_id){
        $this->account_id = $account_id;

    }

    public static function checkId($param)
    {
        $account_id = $param['account_id'];
        global $pdo_auth;
        $result_auth_login = $pdo_auth->prepare("SELECT * FROM users WHERE account_id='$account_id'");
        $result_auth_login->execute();
        $rowLogin_auth = $result_auth_login->fetch();
        if ($rowLogin_auth) {
            $nickname['login'] = $rowLogin_auth['login'];




        }
        return $nickname['login'];
    }






}
class userStatus extends userNickName
{
    public static function checkStatus($param)
    {

        $account_id = $param['account_id'];
        global $pdo_auth;
        $result_auth_login = $pdo_auth->prepare("SELECT * FROM users WHERE account_id='$account_id'");
        $result_auth_login->execute();
        $rowLogin_auth = $result_auth_login->fetch();
        if ($rowLogin_auth) {
            $status['status'] = $rowLogin_auth['status'];


        }
        return $status['status'];
    }
}
class articles{
        public $newCategory;

        function __construct($newCategory)
        {
            $this->newCategory = $newCategory;
        }

        public static function postArticles($newCategory)
        {
               try
               {
            global $pdo_calc;

            $sql = "INSERT INTO `categoryes` (`category`) VALUES ('$newCategory')";
                   $pdo_calc->exec($sql);

                     echo 'Категория создана ';
                } catch (PDOException $e)
               {
                    echo '<br>' . 'такая категория уже создана или другая ошибка';
                }

         }
    public static function renderArticles(){


        global $pdo_calc;
        $sql = $pdo_calc->prepare('SELECT * FROM categoryes');
        $sql->execute();

        $articles = $sql->fetchAll();

        $island_table = 0;
        foreach ($articles as $category) {
            if ($island_table < 1) {
                $island_table++;
            }
$category1 = $category['category'];

            echo "<option value='$category1' >" . $category['category'] . '</option>';
        }

    }

}

class postArticles
{
    public $title_article;
    public $text_article;
    public $category;
    public $login;
    public $account_id;

function __construct($title_article,$text_article,$category,$login,$account_id )
{
$this->title_article = $title_article;
$this->text_article = $text_article;
$this->category = $category;
$this->login = $login;
$this->account_id = $account_id;
}

public function postArticlesNews($title_article,$text_article,$category,$login,$account_id){

    $articles = new postArticles('$title_article','$text_article','$category','$login','$account_id');
    $articles->sqlArticles($title_article,$text_article,$category,$login,$account_id);


}

public static function sqlArticles($title_article,$text_article,$category,$login,$account_id){
    try {

        global $pdo_calc;
        $savePostResults = "INSERT INTO articles (account_id, login, category, text_article, title_article) VALUES ('$account_id', '$login', '$category', '$text_article', '$title_article');";
        $pdo_calc->exec($savePostResults);

    }catch ( PDOException $e){

        echo $e->getMessage();
        echo 'отказано в доступе';
    }


}
}
class viewArticles extends postArticles{

  public static function viewArticlesPosts(){
      global $pdo_calc;
      $sqlart = $pdo_calc->prepare("SELECT * FROM articles");
      $sqlart->execute();
      $row_articles = $sqlart->fetchAll();
       $island_desk = 0;
    foreach ($row_articles as $rowArticle)
    {
        if ($island_desk < 1)
        {

            $island_desk++;
        }

        echo '<table border="1"> <tr><td>' . $rowArticle['title_article'] . '</td>';




     echo '</tr><tr><td>'. $rowArticle['text_article'] .'</td></tr>';



        echo '  <tr><td>' . 'Автор: ' .  $rowArticle['login'] . ' Категория: ' . $rowArticle['category'] .'</td> </tr></table>';





    }

    }
  }


