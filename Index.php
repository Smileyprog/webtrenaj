<!DOCTYPE HTML PUBLIC>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

  <!-- Скрипты -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/kendo.web.min.js"></script>


  <!-- Стимли -->
  <link href="styles/kendo.common.min.css" rel="stylesheet" type="text/css" /> <!-- Kendo1 -->
  <link href="styles/kendo.default.min.css" rel="stylesheet" type="text/css" /> <!-- Kendo2 -->

  <link rel="stylesheet" type="text/css" href="mainstyles/main.css"> <!-- Основной стиль -->
  <link rel="stylesheet" type="text/css" href="mainstyles/popupstyle.css"> <!-- Стиль всплывающего окна-->
  <link rel="stylesheet" type="text/css" href="mainstyles/loadstyle.css"> <!-- Стиль окна загрузки товара -->


  <title></title>

</head>

  


<body>

  <?php

#region  Авторизация

// Скрипт проверки
/*
// Соединямся с БД
  $link=mysqli_connect("localhost", "root", "", "webWithGoogle");

  if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
      setcookie("id", "", time() - 3600*24*30*12, "/");
      setcookie("hash", "", time() - 3600*24*30*12, "/");
      echo "У вас нет доступа к этой странице";
      return;   писяписяновыйгод 2.0
      хопмусорок
    } chaaanges chaaaaaangeeeessssss
    else
    {
      echo "<div class='hello'>Здравствуйте, ".$userdata['user_login'].".</div>";
    }
  }
  else
  {
    echo "Включите куки";
    return;
  }
*/
#endregion
 #region
 ?>



<div onclick="show('none')" id="popupWrap"></div>
  <div id="popupWindow">
    <div class="popupHead">
      <p>Карточка товара</p>
    </div>


    <div class="popupLeft">
      <img class="mainimg" src="http://sergey-oganesyan.ru/wp-content/uploads/2014/01/ipad.png">
    </div>



    <div class="popupRight">
      <table>
        <tr>
          <td>ID</td>
          <td><input type="text" class="popupInput" id="popupId"></td>
        </tr>
        <tr>
          <td>Категория</td>
          <td><input type="text" class="popupInput" id="popupCat"></td>
        </tr>
        <tr>
          <td>Подкатегория</td>
          <td><input type="text" class="popupInput" id="popupSubCat"></td>
        </tr>
        <tr>
          <td>Название</td>
          <td><input type="text" class="popupInput" id="popupName"></td>
        </tr>
        <tr>
          <td>Бренд</td>
          <td><input type="text" class="popupInput" id="popupBrand"></td>
        </tr>
        <tr>
          <td>Модель</td>
          <td><input type="text" class="popupInput" id="popupModel"></td>
        </tr>
      </table>
    </div>
      <div class="clearfix">
      </div>


    <div class="popupBottom">
      <div class="popupSubbotom">
      <table>
      <tr>
        <td>Цена</td>
        <td>Валюта</td>
        <td>Наличие</td>
        <td>Кол-во</td>
        <td>Сумма</td>
        <td>%</td>
        <td>Скидка</td>
      </tr>
      <tr>
        <td><input type="text" id="popupPrice" class="popupInput"></td>
        <td><input type="text" id="popupDoleur" class="popupInput"></td>
        <td><input type="text" id="popupNal" class="popupInput"></td>
        <td><input type="text" id="popupCount" class="popupInput popupInputDop"></td>
        <td><input type="text" id="popupSumm" class="popupInput"></td>
        <td><input type="text" id="popupPercent" class="popupInput popupInputDop"></td>
        <td><input type="text" id="popupDiscount" class="popupInput"></td>
      </tr>
      </table>
    </div>
    </div>
    






  </div>
</div>



<script type="text/javascript">


function show(state){

  document.getElementById('popupWindow').style.display = state;     
  document.getElementById('popupWrap').style.display = state;       
}

//<img class="close" onclick="show('none')" src="http://sergey-oganesyan.ru/wp-content/uploads/2014/01/close.png">
      
</script>
   

  <div class="wraper">
    <div class="main">
      <div class="head">
        <div class="upperLeft">
          <table>
            <tr>
              <td>Категория</td>

              <td>
              
                <?php
                #endregion
              require_once 'lib/Kendo/Autoload.php';
              require_once 'lib/DataSourceResult.php';
              
                  $result = new DataSourceResult('mysql:host=localhost;dbname=webWithGoogle', 'root', '');
              
                  $resultJson = $result->read('category', array('category_id', 'Name'));
              
                  $schema = new \Kendo\Data\DataSourceSchema();
                  $schema->data('data')
                         ->total('total');
              
              $category = new \Kendo\Data\DataSource();
              $category->data($resultJson)
                       ->schema($schema) 
                       ->serverFiltering(true);

            
              $inputcat = new \Kendo\UI\ComboBox('fabric');
              $inputcat->dataSource($category)
                    ->dataTextField('Name')
                    ->dataValueField('category_id')
                    ->filter('contains')
                    ->placeholder('Выберите категорию')
                    ->suggest(true)
                    ->change('DataTransportModel')
                    ->attr('style', 'width: 100%;');
              
              echo $inputcat->render();
                ?>
              </td>

            </tr>
            <tr>
              <td>Подкатегория</td>
              <td>
                <?php

                require_once 'lib/Kendo/Autoload.php';

                $select = new \Kendo\UI\ComboBox('size');
                $select->dataSource(array('Беговые дорожки', 'Степпер'))
                ->placeholder('Выберите подкатегорию')
                ->index(0)
                ->attr('style', 'width: 100%;');

                echo $select->render();
                ?>
              </td>
            </tr>
            <tr>
              <td>Бренд</td>
              <td><?php

              require_once 'lib/Kendo/Autoload.php';

              $select1 = new \Kendo\UI\ComboBox('brand');
              $select1->dataSource(array('AeroFit', 'impulse'))
              ->placeholder('Выберите бренд')
              ->index(0)
              ->attr('style', 'width: 100%;');

              echo $select1->render();
              ?></td>
            </tr>
            <tr>
              <td>Название</td>
              <td><?php
              $countries = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
                'Восемь', 'Девять', 'Десять');

              $dataSource = new \Kendo\Data\DataSource();
              $dataSource->data($countries);

              $autoComplete = new \Kendo\UI\AutoComplete('countries');

              $autoComplete->dataSource($dataSource)
              ->filter('startswith')
              ->placeholder(' ')
              ->separator(', ');

              echo $autoComplete->render();

              #region NonPhp
              ?></td>
            </tr>
          </table>
        </div>



        <div class="upperMiddle">
          <div class="leftside">
            <table>
              <tr>
                <td>% Скидки</td>
                <td>
                  <input id="opacity" type="checkbox" class="upperMiddleInput" size=50px />
                </td>
              </tr>
              <tr>
                <td>Доп. инфо</td>
                <td><input type="checkbox" id="dopinfo" class="upperMiddleInput"></td>
              </tr>
              <tr>
                <td>Количество</td>
                <td><?php

                require_once 'lib/Kendo/Autoload.php';

                $numeric = new \Kendo\UI\NumericTextBox('numeric');
                $numeric->value(0)
                ->min(0)
                ->max(100)
                ->step(1)
                ->attr('style', 'width: 100%')
                ->attr('title', 'numeric');

                echo $numeric->render();

                ?>
              </td>
            </tr>
            <tr>
              <td>Скидка %</td>
              <td><?php

              require_once 'lib/Kendo/Autoload.php';

              $percentage = new \Kendo\UI\NumericTextBox('percentage');
              $percentage->format('p0')
              ->value(0.05)
              ->min(0)
              ->max(0.1)
              ->step(0.01)
              ->attr('style', 'width: 100%')
              ->attr('title', 'percentage');

              echo $percentage->render();

              ?></td>
            </tr>
          </table>
          <div class="clearfix">
          </div>
        </div>
      <!--  <div class="rightside">
          <p>USD <span id="usd" class="eurusd"> 70 р</span></p>
          <p>EUR <span id="eur" class="eurusd"> 90 р</span></p>
          <span class="button button1" id="add">Добавить</span>
          <span class="button button2" id="apply">Применить</span>
        </div>     -->
      </div>



      <!-- <div class="upperRight"> -->
     <!--   <p>Данные КП</p>
        <table>
          <tr>
            <td>КП</td>
            <td><?php
 /*   $kp = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
        'Восемь', 'Девять', 'Десять');

    $sourse = new \Kendo\Data\DataSource();
    $sourse->data($kp);

    $autoComplete1 = new \Kendo\UI\AutoComplete('kp');

    $autoComplete1->dataSource($sourse)
                 ->filter('startswith')
                 ->placeholder(' ')
                 ->separator(', ');

    echo $autoComplete1->render();
    ?></td>
          </tr>
          <tr>
            <td>Ф.И.О.</td>
            <td><?php
    $fio = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
        'Восемь', 'Девять', 'Десять');

    $sourse = new \Kendo\Data\DataSource();
    $sourse->data($fio);

    $autoComplete1 = new \Kendo\UI\AutoComplete('fio');

    $autoComplete1->dataSource($sourse)
                 ->filter('startswith')
                 ->placeholder(' ')
                 ->separator(', ');

    echo $autoComplete1->render();
    ?></td>
          </tr>
          <tr>
            <td>Объект</td>
            <td><?php
    $object = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
        'Восемь', 'Девять', 'Десять');

    $sourse = new \Kendo\Data\DataSource();
    $sourse->data($object);

    $autoComplete1 = new \Kendo\UI\AutoComplete('object');

    $autoComplete1->dataSource($sourse)
                 ->filter('startswith')
                 ->placeholder(' ')
                 ->separator(', ');

    echo $autoComplete1->render();*/ 
    ?></td>
          </tr>
        </table>
      </div> */ -->


      <div class="clearfix">
      </div>
    </div> <!-- Конец Head -->



    <div class="middle">
      <div class="uppermiddleLeft">
        <?php
        require_once 'lib/Kendo/Autoload.php';
        ?>

        <div class="demo-section k-content">
          <div>
              <p><span class="tempos" id="loadpopup">Загрузка товара</span>
                <span class="tempos" id="popup" onclick="show('block')">ПопАп</span></p>
                <?php
                echo (new \Kendo\UI\Button('textButton'))
                ->content('Выделить все')
                ->render();
                echo (new \Kendo\UI\Button('textButton1'))
                ->content('Снять выделение')
                ->render();
                echo (new \Kendo\UI\Button('textButton2'))
                ->content('Удалить выделение')
                ->render();
                ?>
              </p>
            </div>


          </div>
          <div class="middleLeft">


           <?php
           #endregion
    
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(isset($_POST["refresh"])){
              require_once 'lib/DataSourceResult.php';
             require_once 'lib/Kendo/Autoload.php';
             }

           }
          
           require_once 'lib/DataSourceResult.php';
           require_once 'lib/Kendo/Autoload.php';
           $result = new DataSourceResult('mysql:host=localhost;dbname=webWithGoogle', 'root', '');
           
           $resultJson = $result->read('base', array('id', 'Name', 'Brand', 'Model', 'Price', 'Currency', 'category_id')) ;

           $categoryArray = $result->read('category', ['category_id as value','Name as text']);
           
           $dataSource = new \Kendo\Data\DataSource();
           
           echo count($resultJson['data']);
           
           $grid = new \Kendo\UI\Grid('grid');
           
           $productName = new \Kendo\UI\GridColumn();
           $productName->field('Name')
                       ->title('Название')
                       ->width(700);
           
           $unitPrice = new \Kendo\UI\GridColumn();
           $unitPrice->field('Brand')
                     ->width(120)
                     ->title('Бренд');
           
           $unitsInStock = new \Kendo\UI\GridColumn();
           $unitsInStock->field('Model')
                     ->width(220)
                     ->title('Модель');
           
           $discontinued = new \Kendo\UI\GridColumn();
           $discontinued->field('Price')
                     ->width(120)
                     ->title('Цена');
           
           $currency = new \Kendo\UI\GridColumn();
           $currency->field('Currency')
                    ->format('{0:c}')
                    ->title('Валюта');
           
           $categoryId = new \Kendo\UI\GridColumn();
           $categoryId->field('category_id')
                      ->title('КатегорияТест')
                      ->values($categoryArray['data']);
           
           $scrollable = new \Kendo\UI\GridScrollable();
           $scrollable->endless(true);

           $model = new \Kendo\Data\DataSourceSchemaModel();
           $model->id('id')
           ->addField($productName)
           ->addField($unitPrice)
           ->addField($unitsInStock)
           ->addField($discontinued)
           ->addField($currency)
           ->addField($categoryId);

           $schema = new \Kendo\Data\DataSourceSchema();
                             $schema->data('data')
                                    ->model($model)
                                    ->total('total');

            /*$datasourceFilterCategory = new \Kendo\Data\DataSourceFilterItem();
            $datasourceFilter ->field('category_id')
                              ->logic('or')
                              ->operator("eq")
                              ->value(1);*/
           
           $dataSource->data($resultJson)
                      ->batch(true)
                      ->pageSize(200)
                      ->schema($schema);
           
           $grid->addColumn($productName, $unitPrice, $unitsInStock, $discontinued, $currency, $categoryId)
                ->dataSource($dataSource)
                ->persistSelection(true)
                ->sortable(true)
                ->navigatable(true)
                ->change('onChange')
                ->scrollable($scrollable)
                ->attr('style', 'height:400px');
           
           
           echo $grid->render();
          ?>

          <script>
            function onChange(arg) {
              kendoConsole.log("The selected product ids are: [" + this.selectedKeyNames().join(", ") + "]");
            }
          </script>
          <div class="box wide">

            <div class="console"></div>
          </div>
          <style>
          .console div {
            height: 3.3em;
          }
        </style>

      </div>




      <div class="middleRight">
        <p>Данные КП</p>
        <table>
          <tr>
            <td>КП</td>
            <td><?php
            $kp = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
              'Восемь', 'Девять', 'Десять');

            $sourse = new \Kendo\Data\DataSource();
            $sourse->data($kp);

            $autoComplete1 = new \Kendo\UI\AutoComplete('kp');

            $autoComplete1->dataSource($sourse)
            ->filter('startswith')
            ->placeholder(' ')
            ->separator(', ');

            echo $autoComplete1->render();
            ?></td>
          </tr>
          <tr>
            <td>Ф.И.О.</td>
            <td><?php
            $fio = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
              'Восемь', 'Девять', 'Десять');

            $sourse = new \Kendo\Data\DataSource();
            $sourse->data($fio);

            $autoComplete1 = new \Kendo\UI\AutoComplete('fio');

            $autoComplete1->dataSource($sourse)
            ->filter('startswith')
            ->placeholder(' ')
            ->separator(', ');

            echo $autoComplete1->render();
            ?></td>
          </tr>
          <tr>
            <td>Объект</td>
            <td><?php
            $object = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
              'Восемь', 'Девять', 'Десять');

            $sourse = new \Kendo\Data\DataSource();
            $sourse->data($object);

            $autoComplete1 = new \Kendo\UI\AutoComplete('object');

            $autoComplete1->dataSource($sourse)
            ->filter('startswith')
            ->placeholder(' ')
            ->separator(', ');

            echo $autoComplete1->render();
            ?></td>
          </tr>
        </table>
      </div>
    </div>           



    <div class="clearfix">
    </div>



    <div class="middleBottom">
      <?php
//require_once 'lib/Kendo/DataSourceResult.php';
/*

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Content-Type: application/json');

        $request1 = json_decode(file_get_contents('php://input'));

        $result = new DataSourceResult('mysql:host=localhost;dbname=webWithGoogle', 'root', '');

        echo json_encode($result1->read('Customers1', array('CustomerID1', 'ContactName1', 'ContactTitle1', 'CompanyName1', 'Country1'), $request1));

        exit;
      }

      $transport1 = new \Kendo\Data\DataSourceTransport();

      $read1 = new \Kendo\Data\DataSourceTransportRead();

      $read1->url('index.php')
      ->contentType('application/json')
      ->type('POST');

      $transport1 ->read($read1)
      ->parameterMap('function(data) {
        return kendo.stringify(data);
      }');

      $model1 = new \Kendo\Data\DataSourceSchemaModel();

      $contactNameField1 = new \Kendo\Data\DataSourceSchemaModelField('ContactName1');
      $contactNameField1->type('string');

      $contactTitleField1 = new \Kendo\Data\DataSourceSchemaModelField('ContactTitle1');
      $contactTitleField1->type('string');

      $companyNameField1 = new \Kendo\Data\DataSourceSchemaModelField('CompanyName1');
      $companyNameField1->type('string');

      $countryField1 = new \Kendo\Data\DataSourceSchemaModelField('Country1');
      $countryField1->type('string');

      $model1->addField($contactNameField1)
      ->addField($contactTitleField1)
      ->addField($companyNameField1)
      ->addField($countryField1);

      $schema1 = new \Kendo\Data\DataSourceSchema();
      $schema1->data('data')
      ->errors('errors')
      ->groups('groups')
      ->model($model1)
      ->total('total');

      $dataSource1 = new \Kendo\Data\DataSource();

      $dataSource1->transport($transport1)
      ->pageSize(10)
      ->serverPaging(true)
      ->serverSorting(true)
      ->serverGrouping(true)
      ->schema($schema1);

      $grid1 = new \Kendo\UI\Grid('grid1');

      $contactName1 = new \Kendo\UI\GridColumn();
      $contactName1->field('ContactName')
      ->template("<div class='customer-photo'style='background-image: url(../content/web/Customers/#:data.CustomerID#.jpg);'></div><div class='customer-name'>#: ContactName #</div>")
      ->title('Contact Name')
      ->width(240);

      $contactTitle1 = new \Kendo\UI\GridColumn();
      $contactTitle1->field('ContactTitle')
      ->title('Contact Title');

      $companyName1 = new \Kendo\UI\GridColumn();
      $companyName1->field('CompanyName')
      ->title('Company Name');

      $Country1 = new \Kendo\UI\GridColumn();
      $Country1->field('Country')
      ->width(150);

      $pageable1 = new Kendo\UI\GridPageable();
      $pageable1->refresh(true)
      ->pageSizes(true)
      ->buttonCount(5);

      $grid1->addColumn($contactName1, $contactTitle1, $companyName1, $Country1)
      ->dataSource($dataSource1)
      ->sortable(true)
      ->groupable(true)
      ->pageable($pageable1)
      ->attr('style', 'height:400px');

      echo $grid1->render();
      */
      ?>
    </div>






  </div> <!-- Конец Middle -->





  <div class="footer">
    <div class="footerFirst">
      <span class="footerText">Всего</span>
    </div>
    <div class="footerSecond">
      <span class="footerText">Кол-во Шт</span>
      <input type="text" id="footerCount" class="footerEv">
      <span class="footerText">Сумма RUR</span>
      <input type="text" id="footerSumm" class="footerEv">
      <span class="footerText"> Скидка RUR</span>
      <input type="text" id="footerDiscount" class="footerEv">
      <span class="footerText"> Итого</span>
      <input type="text" id="itogo" class="footerEv">
    </div>
    <div class="footerThird">
      <?php
      echo (new \Kendo\UI\Button('textButton3'))
      ->content('Сфомировать')
      ->render();
      ?>
    </div>
  </div>




</div> <!-- Конец Main -->
</div> <!-- Конец Wraper -->




<!-- Всплывающее окно загрузки товаров -->



<?php

require_once 'lib/Kendo/Autoload.php';

$window = new \Kendo\UI\Window('loadPopUpWidget');

$window->title('Загрузка товара')
       ->width('60%')
       ->close('onClose')
       ->startContent();
?>

<!-- НАЧАЛО ПОДБЛОКА ЗАГРУЗКИ ТОВАРА -->


<div id="loadPopupWrap">
  <div id="loadPopupWindow">


  <div class="loadPopUpLeft">
    <?php
    
    ?>
    <div class="demo-section k-content">
      <h4><label for="countries">Поиск</label></h4>
      <?php


      $countries = array('Массив', 'Из', 'Базы');



      $dataSource = new \Kendo\Data\DataSource();
      $dataSource->data($countries);

      $autoComplete = new \Kendo\UI\AutoComplete('loadsearch');

      $autoComplete->dataSource($dataSource)
      ->filter('startswith')
      ->placeholder('Введите товар')
      ->separator(', ');

      echo $autoComplete->render();
      ?>
  </div>
</div>


    <div class="loadPopUpRight">
          <div>
        <p>
            <?php
                echo (new \Kendo\UI\Button('LoadPopUpButton'))
                    ->content('Загрузить новую позицию')
                    ->render();
            ?>
        </p>
    </div>
    </div>





<div class="clearfix"></div>



    <div class="loadPopUpMiddle">
      
 <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'));

    $result = new DataSourceResult('sqlite:..//sample.db');

    $type = $_GET['type'];

    echo json_encode($result->read('Products', array('ProductID', 'ProductName', 'UnitPrice', 'UnitsInStock', 'Discontinued'), $request));

    exit;
}

$transport = new \Kendo\Data\DataSourceTransport();

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url('checkbox-selection.php?type=read')
     ->contentType('application/json')
     ->type('POST');

$transport->read($read);

$model = new \Kendo\Data\DataSourceSchemaModel();
$model->id('ProductID');

$schema = new \Kendo\Data\DataSourceSchema();
$schema->data('data')
       ->model($model)
       ->total('total');

$dataSource = new \Kendo\Data\DataSource();

$dataSource->transport($transport)
           ->pageSize(10)
           ->schema($schema);

$gridPopUp = new \Kendo\UI\Grid('gridPopUp');

$selectColumn = new \Kendo\UI\GridColumn();
$selectColumn->selectable(true)
             ->width(50);

$trashCan = new \Kendo\UI\GridColumn();
$trashCan->field('asd')
         ->title('asddd');



$edit = new \Kendo\UI\GridColumn();
$edit->field('adddd')
     ->title('adddddd');



$productName = new \Kendo\UI\GridColumn();
$productName->field('ProductName')
            ->title('Product Name');

$unitPrice = new \Kendo\UI\GridColumn();
$unitPrice->field('UnitPrice')
          ->format('{0:c}')
          ->width(120)
          ->title('Unit Price');

$unitsInStock = new \Kendo\UI\GridColumn();
$unitsInStock->field('UnitsInStock')
          ->width(120)
          ->title('Units In Stock');

$discontinued = new \Kendo\UI\GridColumn();
$discontinued->field('Discontinued')
          ->width(120);

$gridPopUp->addColumn($selectColumn,$productName, $unitPrice, $unitsInStock, $discontinued)
     ->dataSource($dataSource)
     ->persistSelection(true)
     ->sortable(true)
     ->change('onChange')
     ->pageable(true)
     ->attr('style', 'height:270px');;


echo $gridPopUp->render();
?>


<div class="box wide">
</div>


  </div> <!-- Конец popupWrap -->
</div> <!-- Конец popupWindow -->







<!-- КОНЕЦ ПОДБЛОКА ЗАГРУЗКИ ТОВАРА -->

<?php
    $window->endContent();

    echo $window->render();

?>



<div class="responsive-message"></div>


<!-- Конец вслывающего окна загрузки товаров -->






<style>
.demo-section p {
  margin: 0 0 30px;
  line-height: 50px;


}
.demo-section p .k-button {
  margin: 0 10px 0 0;
  align: left;


}
.k-primary {
  min-width: 150px;
  display: inline-block;
}       

.customer-photo {
  display: inline-block;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background-size: 32px 35px;
  background-position: center center;
  vertical-align: middle;
  line-height: 32px;
  box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0,0,0,.2);
  margin-left: 5px;
}

.customer-name {
  display: inline-block;
  vertical-align: middle;
  line-height: 32px;
  padding-left: 3px;
}         
</style>










<script type="text/javascript">


    // ПОКАЗ ВСПЛЫВАЮЩЕГО ОКНА ЗАГРУЗКИ ТОВАРОВ

    function DataTransportModel(arg){
                console.log(arg);

    }


$( document ).ready(function() {

  $("#loadPopUpWidget").data("kendoWindow").close();


})

    function onClose() {
        //$("#undo").show();
    }

    $(function() {
        $("#loadpopup").click(function() {
            $("#loadPopUpWidget").data("kendoWindow").open();
            //$("#undo").hide();
        });
    });


  //КОНЕЦ ВСПЛЫВАЮЩЕГО ОКНА ЗАГРУЗКИ ТОВАРОВ


    window.state = 0;

    function onChange(arg) {
      kendoConsole.log("The selected product ids are: [" + this.selectedKeyNames().join(", ") + "]");
    }



    $('#loadpopup').click(function() {

      if (window.state == 0) {

        $('#popupWindow').fadeIn(50, function(){   
          $('#popupWindow').css('top','0') 
          $('#popupWrap').css('backgroundColor','rgba(1,1,1,0.725)')


          window.state = 1    


        }) 
      }

      else if (window.state == 1) {

        $('#popupWindow').fadeOut(300, function(){   
          $('#popupWrap').css('backgroundColor','white')
          $('#popupWindow').css('top','-9000')  

          window.state = 0   



        })

      }
    })

  



  </script>



</body>
</html>
