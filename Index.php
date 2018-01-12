<?php
#region  Авторизация

// Скрипт проверки

// Соединямся с БД
  $link=mysqli_connect("localhost", "root", "", "webWithGoogle");

  if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
      setcookie("id", "", time() - 3600*24*30*12, "/");
      setcookie("hash", "", time() - 3600*24*30*12, "/");
      header("Location: auth.php");
      return;
    } 
    else
    {

      // ЗАПРОС МЕНЕДЖЕРСКИХ ДАННЫХ



        // !ЗАПРОС МЕНЕДЖЕРСКИХ ДАННЫХ!


      echo "<div class='hello'>".$userdata['fio']."</div>";
    }
  }
  else
  {
    header("Location: auth.php");
    return;
  }
// 
#endregion
 #region




?>





<!DOCTYPE HTML PUBLIC>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

  <!-- Скрипты -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/kendo.web.min.js"></script>


  <!-- Стимли -->
  <link href="styles/kendo.common.min.css" rel="stylesheet" type="text/css" /> <!-- Kendo1 -->
  <link href="styles/kendo.default.min.css" rel="stylesheet" type="text/css" /> <!-- Kendo2 -->

  <link rel="stylesheet" type="text/css" href="mainstyles/main.css"> <!-- Основной стиль -->
  <link rel="stylesheet" type="text/css" href="mainstyles/popupstyle.css"> <!-- Стиль всплывающего окна-->
  <link rel="stylesheet" type="text/css" href="mainstyles/loadstyle.css"> <!-- Стиль окна загрузки товара -->


  <title></title>

</head>

  


<body>

 











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
          <td><input type="text" class="popupInput" id="popupId" disabled></td>
        </tr>
        <tr>
          <td>Категория</td>
          <td><input type="text" class="popupInput" id="popupCat" disabled></td>
        </tr>
        <tr>
          <td>Подкатегория</td>
          <td><input type="text" class="popupInput" id="popupSubCat" disabled></td>
        </tr>
        <tr>
          <td>Название</td>
          <td><input type="text" class="popupInput" id="popupName" disabled></td>
        </tr>
        <tr>
          <td>Бренд</td>
          <td><input type="text" class="popupInput" id="popupBrand" disabled></td>
        </tr>
        <tr>
          <td>Модель</td>
          <td><input type="text" class="popupInput" id="popupModel" disabled></td>
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
            <td>Кол-во</td>
            <td>Сумма</td>
            <td>%</td>
            <td>Скидка</td>
          </tr>
          <tr>
            <td><input type="text" id="popupPrice" class="popupInput" disabled></td>
            <td><input type="text" id="popupDoleur" class="popupInput" disabled></td>
            <td><input type="number" id="popupCount" class="popupInput popupInputDop"></td>
            <td><input type="text" id="popupSumm" class="popupInput" disabled></td>
            <td><input type="text" id="popupPercent" class="popupInput popupInputDop"></td>
            <td class="popUpInputLast"><input type="text" id="popupDiscount" class="popupInput" disabled></td>
          </tr>
        </table>
      </div>
    <div class="popUpSubSubbotom">
      <div class="subLeft">
        <p>Наличие</p>
        <p><textarea readonly rows="7" cols="30" name="popupNalichie" id="popupNalichie"></textarea></p>
      </div>
      <div class="subRight">
        <p>Дополнительная информация</p>
        <p><textarea readonly rows="7" cols="30" name="popupDopInfo" id="popupDopInfo"></textarea></p>
      <div class="clearfix"></div>

      </div>
    </div> 
    <div class="popUpSubmitDiv">
       <span class="k-button" onclick="addInCart()" id="popUpSubmitBut">Добавить</span>
    </div>
    </div>
    






  </div>
</div>



<script type="text/javascript">






function show(state){

  document.getElementById('popupWindow').style.display = state;     
  document.getElementById('popupWrap').style.display = state; 
  if (state == 'none')
  $("#grid").data("kendoGrid").clearSelection()        
}

</script>
   

   <div class="newManager">
     <span id="newManagerSpan">Админ. панель</span>
</div>

<div class="exit">
  <span id="exitSpan">Сменить пользователя</span>
</div>


  <div class="wraper">
    <div class="main">
      <div class="head">
        <div class="upperLeft">
          <div class="upperLeftLeft">
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
              
              $category = new \Kendo\Data\DataSource('katDataSource');
              $category->data($resultJson)
                       ->schema($schema) 
                       ->serverFiltering(true);

            
              $inputcat = new \Kendo\UI\ComboBox('kat');
              $inputcat->dataSource($category)
                    ->dataTextField('Name')
                    ->dataValueField('category_id')
                    ->filter('contains')
                    ->placeholder('Выберите категорию')
                    ->suggest(false)
                    ->change('onOpenSubcategory')
                    ->close('UpperSelectsChange')
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


                $resultJsonSubCategory = $result->read('subcategory', array('subcategory_id','category_id', 'Name'));

                $schema = new \Kendo\Data\DataSourceSchema();
                $schema->data('data')
                       ->total('total');

                $datasourceFilterSubCategoryChoose = new \Kendo\Data\DataSourceFilterItem();
                $datasourceFilterSubCategoryChoose -> field('category_id')
                                                   -> operator('isnotnull');

                
                $subCategory = new \Kendo\Data\DataSource();
                $subCategory->data($resultJsonSubCategory)
                         ->batch(true)
                         ->schema($schema) 
                         ->serverFiltering(false)
                         ->addFilterItem($datasourceFilterSubCategoryChoose);
  
                $select = new \Kendo\UI\ComboBox('podkat');
                $select->dataSource($subCategory)
                ->placeholder('Выберите подкатегорию')
                ->dataTextField('Name')
                ->dataValueField('subcategory_id')
                ->close('UpperSelectsChange')
                
                //->open('onOpenSubcategory')
                ->attr('style', 'width: 100%;');

                echo $select->render();
                ?>
              </td>
            </tr>
            <tr>
              <td>Бренд</td>
              <td><?php

              require_once 'lib/Kendo/Autoload.php';

              $resultJsonSubBrand = $result->read('brand', array('id', 'name'));

          
              $schemaBrand = new \Kendo\Data\DataSourceSchema();
              $schemaBrand->data('data')
                     ->total('total');
              
              $categoryBrand = new \Kendo\Data\DataSource('braDataSource');
              $categoryBrand->data($resultJsonSubBrand)
                       ->schema($schemaBrand) 
                       ->serverFiltering(true);

            
              $select1 = new \Kendo\UI\ComboBox('brand');
              $select1->dataSource($categoryBrand)
                    ->dataTextField('name')
                    ->dataValueField('id')
                    ->filter('contains')
                    ->close('UpperSelectsChange')
                    ->placeholder('Выберите бренд')
                    ->suggest(false)
                    ->change('onOpenSubcategory')
                    ->attr('style', 'width: 100%;');


              echo $select1->render();
              ?></td>
            </tr>
            <tr>
              <td>Модель</td>
              <td><?php

              //$resultos = new DataSourceResult('mysql:host=localhost;dbname=webWithGoogle', 'root', '');

              //$finalArr = [];
             // $models = $resultos->read('base', array('Model'));

              //for ($i = 0; $i < count($models['data']); $i++) {

              //  array_push($finalArr, $models['data'][$i]['Model']);

             // }
              
            //  $unic = array_unique($finalArr);

                         // $countries = array('Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь',
               // 'Восемь', 'Девять', 'Десять');

               $dataSource = new \Kendo\Data\DataSource();
               //$dataSource->data($unic);

              $autoComplete = new \Kendo\UI\AutoComplete('models');

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
          <div class="upperLeftRight">
            <table>
              <tr>
              <td>Курс Доллара </td> 
              <td><input type="text" id="dol" class="dol"><span></td>
              </tr>
              <tr>
              <td>Курс Евро </td> 
              <td><input type="text" id="eur" class="eur"><span></td>
              </tr>
            </table>
            <div class="refCursDiv">
            <?php
                echo (new \Kendo\UI\Button('refreshCurs'))
                ->content('Обновить курсы')
                ->render();
            ?>
            <!-- <span class="refreshCurs">Обновить курсы</span> -->
            </div>
          </div>
        </div>



        <div class="upperMiddle">
          <div class="leftside">
            <table>
              <tr>
                <td>Скидка</td>
                <td>
                  <input id="opacity" type="checkbox" class="upperMiddleInput" size=50px />
                </td>
              </tr>
              <tr>
              <td>Скидка %</td>
              <td><?php

              require_once 'lib/Kendo/Autoload.php';

              $percentage = new \Kendo\UI\NumericTextBox('percentage');
              $percentage->format('p0')
              ->value(0)
              ->min(0)
              ->max(0.1)
              ->step(0.01)
              ->attr('style', 'width: 100%')
              ->attr('title', 'percentage');

              echo $percentage->render();

              ?></td>
            </tr>
              <tr>
                <td>Доп. инфо</td>
                <td><input type="checkbox" id="dopinfoCheck" class="upperMiddleInput"></td>
              </tr>          
          </table>
      
          <div class="clearfix">
          </div>
        </div>
        <textarea readonly rows="4" cols="30" name="dopInfo" id="dopInfo" class="dopInfo"></textarea>
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
          <div class="vidButs">
              <p><span class="tempos" id="loadpopup">Загрузка товара</span>
                <span class="tempos" id="popup" onclick="sort()" >ПопАп</span></p>
                <!--onclick="show('block')"-->
                <?php
                echo (new \Kendo\UI\Button('textButton0'))
                ->content('Загрузить КП')
                ->click('openKp')
                ->render();
                
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
          <div class="middleFlex">
          <div class="middleLeft">


           <?php
           #endregion

          
           require_once 'lib/DataSourceResult.php';
           require_once 'lib/Kendo/Autoload.php';
           $result = new DataSourceResult('mysql:host=localhost;dbname=webWithGoogle', 'root', '');
           
           $resultJson = $result->read('base', array('id', 'Name', 'brand_id', 'Model', 'Price', 'Currency', 'category_id', 'subcategory_id', 'ImagePath', 'Avability', 'Additional' )) ;

           $categoryArray = $result->read('category', ['category_id as value','Name as text']);
           $subCategoryArray = $result->read('category', ['subcategory_id as value','Name as text']);
           $brandArray = $result->read('brand', ['id as value','name as text']);
           
           $dataSource = new \Kendo\Data\DataSource();
           
         //$("#grid").data("kendoGrid").dataSource.filter()['filters'].push({field: "Name", operator: "eq", value: "Беговая дорожка"})

           
           $grid = new \Kendo\UI\Grid('grid');

           // Блок колонок для заполнения Таблицы
           $productName = new \Kendo\UI\GridColumn();
           $productName->field('Name')
                       ->title('Название')
                       ->width(700);
           
           $unitPrice = new \Kendo\UI\GridColumn();
           $unitPrice->field('brand_id')
                     ->width(120)
                     ->title('Бренд')
                     ->values($brandArray['data']);
           
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
                      ->values($categoryArray['data'])
                      ->hidden(true);                      

           $subCategoryId = new \Kendo\UI\GridColumn();
           $subCategoryId->field('subcategory_id')
                         ->hidden(true)
                         ->values($subCategoryArray['data']);

           $ImagePath = new \Kendo\UI\GridColumn();
           $ImagePath->field('subcategory_id')
                      ->hidden(true);

           $avability = new \Kendo\UI\GridColumn();
           $avability ->field('Avability')
                        ->hidden(true);

           $additional = new \Kendo\UI\GridColumn();
           $additional ->field('Additional')
                       ->hidden(true);

                      
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

            $datasourceFilterCategory = new \Kendo\Data\DataSourceFilterItem();
            $datasourceFilterCategory ->field('category_id')
                                      ->operator('isnotnull');
           
           $dataSource->data($resultJson)
                      ->batch(true)
                      ->pageSize(200)
                      ->schema($schema)
                      ->addFilterItem($datasourceFilterCategory);
           
           
           $grid->addColumn($productName, $unitPrice, $unitsInStock, $discontinued, $currency, $categoryId, $subCategoryId, $ImagePath, $avability, $additional )
                ->dataSource($dataSource)
                ->persistSelection(true)
                ->sortable(true)
                ->navigatable(true)
                ->change('onChange')
                ->filterable(true)
                ->scrollable($scrollable)
                ->selectable('row')
                ->attr('style', 'height:400px');
           
           
           echo $grid->render();
          ?>

          <script>
       
          
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
    </div>           



    <div class="clearfix">
    </div>



    <div class="middleBottom">
      <?php
require_once 'lib/DataSourceResult.php';


$dataToProposal = json_decode('{"data":[]}');

$productNameField = new \Kendo\Data\DataSourceSchemaModelField('Name');
$productNameField->type('string')
                 ->editable(false);

$productBrandField = new \Kendo\Data\DataSourceSchemaModelField('Brand');
 $productBrandField->type('string')
                  ->editable(false);

$productModelField = new \Kendo\Data\DataSourceSchemaModelField('Model');
$productModelField->type('string')
                  ->editable(false);                

$model = new \Kendo\Data\DataSourceSchemaModel();
$model -> addField($productNameField)
       ->addField($productBrandField)
       ->addField($productModelField);

$productNameResult = new \Kendo\UI\GridColumn();
$productNameResult->field('Name')
            ->title('Название')
            ->template("<div onclick=\"justATest('#:data.PhotoPath#')\" class='model-photo'style='background-image: url(#:data.PhotoPath#);'></div><div class='model-name'>#: Name #</div>")            
            ->width(400);

$productBrandResult = new \Kendo\UI\GridColumn();
$productBrandResult->field('Brand')
            ->title('Бренд')
            ->width(150);

$productModelResult = new \Kendo\UI\GridColumn();
$productModelResult->field('Model')
            ->title('Модель')
            ->width(150);

$productPriceResult = new \Kendo\UI\GridColumn();
$productPriceResult->field('Price')
            ->title('Цена')
            ->width(120);

$productCurrencyResult = new \Kendo\UI\GridColumn();
$productCurrencyResult->field('Currency')
            ->title('Валюта')
            ->width(60);

$productCountResult = new \Kendo\UI\GridColumn();
$productCountResult->field('Count')
                    ->title('Количество')
                    ->width(60);

$productAmountResult = new \Kendo\UI\GridColumn();
$productAmountResult->field('Summ')
                    ->title('Сумма')
                    ->width(100);

$productPercentResult = new \Kendo\UI\GridColumn();
$productPercentResult->field('Percent')
                    ->title('%')
                    ->width(60);

$productDiscountResult = new \Kendo\UI\GridColumn();
$productDiscountResult->field('Discount')
                    ->title('Скидка')
                    ->width(100);

$productTotalResult = new \Kendo\UI\GridColumn();
$productTotalResult->field('Total')
                    ->title('Всего')
                    ->width(100);



$schema = new \Kendo\Data\DataSourceSchema();
$schema->data('data')
      ->model($model);

$dataSourceProp = new \Kendo\Data\DataSource('newData');

$dataSourceProp->data($dataToProposal)
          ->pageSize(100)
          ->change('recalculateProposal')
          ->schema($schema);

$gridPopUp = new \Kendo\UI\Grid('gridPopUp');



$commandItemEdit = new \Kendo\UI\GridColumnCommandItem();
$commandItemEdit ->name('destroy')
                                ->text('Удалить')
->click('recalculateProposal');


$command = new \Kendo\UI\GridColumn();
$command->addCommandItem($commandItemEdit)
        ->title('&nbsp;')
        ->width(250);

$gridPopUp->addColumn($productNameResult, $productBrandResult,$productModelResult,$productPriceResult, $productCurrencyResult, $productCountResult, $productAmountResult,
$productPercentResult, $productDiscountResult, $productTotalResult, $command)
    ->dataSource($dataSourceProp)
    ->persistSelection(true)
    ->sortable(true)
    ->editable(true)
    ->resizable(true)
    ->attr('style', 'height:270px');


echo $gridPopUp->render();
      ?>
    </div>






  </div> <!-- Конец Middle -->





  <div class="footer">
    <div class="footerFirst">
      <span class="footerText">Всего</span>
    </div>
    <div class="footerSecond">
      <span class="footerText">Кол-во Шт</span>
      <input type="number" id="footerCount" class="footerEv">
      <span class="footerText">Кол-во Поз</span>
      <input type="number" id="footerPosCount" class="footerEv">
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
      ->click('ajaxToGoogle')
      ->render();
      ?>
    </div>
  </div>




<!-- НАЧАЛО ЗАГРУЗКИ КП -->
  <?php

require_once 'lib/Kendo/Autoload.php';

$window = new \Kendo\UI\Window('loadKP');

$LoadKpPosition = new \Kendo\UI\WindowPosition;
$LoadKpPosition ->top('200px');


$window->title('Загрузить КП')
       ->width('800px')
       ->visible(false)
       ->close('onClose')
       ->position($LoadKpPosition)
       ->startContent();
?>

<!-- ЗАГРУЗКА КП ТЕЛО -->



<? 
  
$transportSave = new \Kendo\Data\DataSourceTransport();

$createSave = new \Kendo\Data\DataSourceTransportCreate();

$createSave->url('../ajaxInfo/saveloadproposal.php?type=create')
     ->contentType('application/json')
     ->type('POST');

$readSave = new \Kendo\Data\DataSourceTransportRead();

$readSave->url('../ajaxInfo/saveloadproposal.php?type=read')
     ->contentType('application/json')
     ->type('POST');

$updateSave = new \Kendo\Data\DataSourceTransportUpdate();

$updateSave->url('../ajaxInfo/saveloadproposal.php?type=update')
     ->contentType('application/json')
     ->type('POST');

$destroySave = new \Kendo\Data\DataSourceTransportDestroy();

$destroySave->url('../ajaxInfo/saveloadproposal.php?type=destroy')
     ->contentType('application/json')
     ->type('POST');

$transportSave->create($createSave)
          ->read($readSave)
          ->update($updateSave)
          ->destroy($destroySave)
          ->parameterMap('function(data) {
            return kendo.stringify(data);
        }');

          $modelSave = new \Kendo\Data\DataSourceSchemaModel();

          $productIDFieldSave = new \Kendo\Data\DataSourceSchemaModelField('id');
          $productIDFieldSave->type('number')
                         ->editable(false);
          
          $productNameFieldSave = new \Kendo\Data\DataSourceSchemaModelField('name');
          $productNameFieldSave->type('string');
          
          $unitPriceFieldSave = new \Kendo\Data\DataSourceSchemaModelField('savedata');
          $unitPriceFieldSave->type('string');
          
          $unitsInStockFieldSave = new \Kendo\Data\DataSourceSchemaModelField('linkos');
          $unitsInStockFieldSave->type('string');
          

          $modelSave->id('id')
              ->addField($productIDFieldSave)
              ->addField($productNameFieldSave)
              ->addField($unitPriceFieldSave)
              ->addField($unitsInStockFieldSave);
              
$schemaSave = new \Kendo\Data\DataSourceSchema();
$schemaSave->data('data')
       ->errors('errors')
       ->model($modelSave)
       ->total('total');

       $dataSourceSave = new \Kendo\Data\DataSource();

      $dataSourceSave->transport($transportSave)
           ->batch(true)
           ->pageSize(30)
           ->schema($schemaSave);

$gridSave = new \Kendo\UI\Grid('grid3');

$productIdSave = new \Kendo\UI\GridColumn();
$productIdSave->field('id')
            ->title('ID');

$productNameSave = new \Kendo\UI\GridColumn();
$productNameSave->field('name')
            ->title('Название сохранения');

$unitPriceSave = new \Kendo\UI\GridColumn();
$unitPriceSave->field('savedata')
          ->title('Техническая информация')
          ->hidden(true);

$unitsInStockSave = new \Kendo\UI\GridColumn();
$unitsInStockSave->field('linkos')
          ->title('Ссылка в гугл');

$jsCommandResave = new \Kendo\JavaScriptFunction('ReSaveCommand');
$jsCommandLoad = new \Kendo\JavaScriptFunction('LoadCommand');




$commandItemLoados = new \Kendo\UI\GridColumnCommandItem();
$commandItemLoados ->name('load')
                    ->text('Загрузить')
                    ->click($jsCommandLoad);


$commandItemResavos = new \Kendo\UI\GridColumnCommandItem();
$commandItemResavos ->name('resave')
                    ->text('Перезаписать')
                    ->click($jsCommandResave);


$commandItemDestros = new \Kendo\UI\GridColumnCommandItem();
$commandItemDestros ->name('destroy')
                    ->text('Удалить');

$commandSave = new \Kendo\UI\GridColumn();
$commandSave->addCommandItem($commandItemDestros)
            ->addCommandItem($commandItemResavos)
            ->addCommandItem($commandItemLoados)
            ->width(180);

$saveToolbarCommand = new \Kendo\UI\GridToolbarItem('SaveCommand');
$saveToolbarCommand -> name('SaveCommand')
                    ->template('<a class="k-button" href="\\#" onclick="SaveCommand()">Сохранить предложение</a>');

$saveChangesToolbarCommand = new \Kendo\UI\GridToolbarItem('save');
$saveChangesToolbarCommand -> text('Сохранить изменения');

$gridSave->addColumn($productNameSave, $unitPriceSave, $unitsInStockSave, $commandSave)
     ->dataSource($dataSourceSave)
     ->addToolbarItem($saveToolbarCommand, $saveChangesToolbarCommand)
     ->height(600)
     ->navigatable(true)
     ->editable(true)
     ->pageable(true);

echo $gridSave->render();

?>



<!-- ЗАГРУЗКА КП КОНЕЦ ТЕЛА -->

<?php
    $window->endContent();

    echo $window->render();
?>

<!-- <span id="undo" style="display:block" class="k-button hide-on-narrow">Click here to open the window.</span> -->

<div class="responsive-message"></div>

<script>
    function onClose() {
        $("#undo").show();
    }

    // $(function() {
    //     $("#undo").click(function() {
    //         $("#window").data("kendoWindow").open();
    //         $("#undo").hide();
    //     });
    // });
</script>

<style>



	.k-window-content p {
		margin-bottom: 1em;
	}
	.k-window-content a {
		color: #BBB;
	}
    @media screen and (max-width: 1023px) {
        div.k-window {
            display: none !important;
        }
    }
</style>                    

<!-- КОНЕЦ ЗАГРУЗКИ КП -->
















  
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

<?php


$window = new \Kendo\UI\Window('windowSave');

$LoadKpPositionos = new \Kendo\UI\WindowPosition;
$LoadKpPositionos ->top('30%')
                  ->left('35%');

$window->title('Введите название для сохранения')
       ->width('350px')
       ->visible(false)
       ->position($LoadKpPositionos)
       ->startContent();
?>
	<h4>Введите название для сохранения</h4>
  <div id="forErrorSave"></div>
  <br/>
   <input type="text" id="savename"/>

   <?php

                echo (new \Kendo\UI\Button('saveButton'))
                    ->content('Сохранить')
                    ->click('saveValidation')                    
                    ->render();
            ?>

<?php
    $window->endContent();

    echo $window->render();
?>




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


function openKp() {

      $("#loadKP").data("kendoWindow").open();
       $('.k-widget').css('left','0')
       $('.k-widget').css('right','0')
       $('.k-widget').css('marginLeft','auto')
       $('.k-widget').css('marginRight','auto')

}


$('#exitSpan').click(function() {

  window.location.pathname = '/auth.php'

})


$('#newManagerSpan').click(function() {


  window.location.pathname = '/admin'

})


// ДОП ИНФО И СКИДКА

var dopInfoState = 0
var discountState = 0

$('#dopinfoCheck').click(function() {

  if (dopInfoState == 0 ) {

    $('.dopInfo').css('backgroundColor','#ffffff')
    $('.dopInfo').removeAttr('readonly')

    window.dopInfoState = 1
  }

  else if (dopInfoState == 1 ) {

    $('.dopInfo').css('backgroundColor','#efefef')
    $('.dopInfo').attr('readonly','')

    window.dopInfoState = 0
  }

})


$('#opacity').click(function() {

if (discountState== 0 ) {

  $('.k-formatted-value').css('backgroundColor','#ffffff')

  window.discountState = 1
}

else if (discountState == 1 ) {

  $('.k-formatted-value').css('backgroundColor','#e5e5e5')
  $('.k-formatted-value').val('')

  window.discountState = 0
}

})





function gridDelBut(e) {

  console.log(e)



}





$('#models').keyup(function() {

  UpperSelectsChange();

  /*
var data = $("#grid").data('kendoGrid').dataSource.data();
var val = $('#models').val().toLowerCase();

 
var result = data.filter(function(element){
  return String(element.Model).toLowerCase().indexOf(val) > -1;
})

console.log(result)
*/
  
})




// РАССЧЕТ СУММЫ ВО ВСПЛЫВАЮЩЕМ ОКНЕ
$('#popupCount').change(popUpSumm)
$('#popupCount').keyup(popUpSumm)
  
function popUpSumm() {
  

var price =  $('#popupPrice').val()
var count = $('#popupCount').val()

price = price.replace(",",".").replace(' ','');

count = Number(count)
price = Number(price)

var newSumm = price * count

newSumm = newSumm.toFixed(2)
newSumm = String(newSumm).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
newSumm = newSumm.replace(".",",");

$('#popupSumm').val(newSumm)
}




// РАССЧЕТ СКИДКИ
$('#popupPercent').keyup(function() {

var summ = $('#popupSumm').val()


if (summ != '' && summ != undefined) {

  var percentVal = $('#popupPercent').val()
  var itogSumm = ''
  var match = percentVal.search('%')
  var zapMatch = percentVal.search(',')

  summ = summ .replace(",",".");
  summ = summ .replace(' ','')
  summ = Number(summ)

  if (zapMatch >= 0) {
    percentVal = percentVal.replace(',','.')
    }


// Если процента нет
  if (match < 0) {
 
    percentVal = Number(percentVal)

    itogSumm = summ - percentVal

  }

// Если процент есть
  else if (match >= 0) {

    percentVal = percentVal.replace('%','')
    percentVal = Number(percentVal)
    
    itogSumm = summ - summ/100*percentVal

  }


// Выводим итоговую скидку
  itogSumm = itogSumm.toFixed(2)
  itogSumm = String(itogSumm).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
  itogSumm = itogSumm.replace(".",",");
  $('#popupDiscount').val(itogSumm)

}

})



    // ПОКАЗ ВСПЛЫВАЮЩЕГО ОКНА ЗАГРУЗКИ ТОВАРОВ

    function DataTransportModel(arg){
                console.log(arg);

    }


  function onOpenSubcategory(e){
    
    var catId = $('#kat')[0].value; 
    var chooser = $('#podkat').data("kendoComboBox").dataSource;
  
    console.log(catId);

    //if(catId != ''){
    chooser.filter(({
    logic: "and",
    filters: [
      {field: "category_id", operator: "eq", value: catId}      
    ]
}));
    chooser.read();
  //}


  }


  function UpperSelectsChange(e){

var dataGrid = $("#grid").data("kendoGrid");


var catVal = $('input[name="kat_input"]').val();
var catId = $('#kat')[0].value; 
var podCatId = $('#podkat')[0].value;
var brandId = $('#brand')[0].value;
var brandId = $('#brand')[0].value;
var customFilter = $('#models').val().toLowerCase();

console.log(podCatId);

//Обнуляем массив
dataGrid.dataSource.filter()['filters'] = [];

//фильтр на категорию
if(catId != '')
dataGrid.dataSource.filter()['filters'].push({field: "category_id", operator: "eq", value: catId});

if(podCatId != '')
dataGrid.dataSource.filter()['filters'].push({field: "subcategory_id", operator: "eq", value: podCatId});

if(brandId != '')
dataGrid.dataSource.filter()['filters'].push({field: "brand_id", operator: "eq", value: brandId});

if(customFilter != '')
dataGrid.dataSource.filter()['filters'].push({
field: "Model", 

operator: function(element){
  return String(element).toLowerCase().indexOf(customFilter) > -1;
},
value: customFilter
});
//Рендер таблицы с новыми данными
dataGrid.dataSource.read();

}

$( document ).ready(function() {
  $('#loadKP').data("kendoWindow").close();
  $("#loadPopUpWidget").data("kendoWindow").close();
 

  mainSetCurs()


})

function onClose() {
  //$("#undo").show();
}

$(function() {
  $("#loadpopup").click(function() {
      $("#loadPopUpWidget").data("kendoWindow").open();
      $('.k-widget').css('top','0')
       $('.k-widget').css('left','0')
       $('.k-widget').css('right','0')
       $('.k-widget').css('marginLeft','auto')
       $('.k-widget').css('marginRight','auto')

  });
});


  //КОНЕЦ ВСПЛЫВАЮЩЕГО ОКНА ЗАГРУЗКИ ТОВАРОВ.


    window.state = 0;

    function onChange(arg) {
      //необходимо хранить Selection объет и срвнивать при вызове этой функции
      var entityGrid  = $("#grid").data("kendoGrid");
      var selectedItem = entityGrid.dataItem(entityGrid.select());

      console.log(selectedItem);
      //Инициализируем массив
      var sendArray = [];

      //Заполняем массив из события (ассоциативный)

      sendArray.push({
      'id':selectedItem.id, 
      'category':selectedItem.category_id, 
      'subcategory_id':selectedItem.subcategory_id, //доработать поиск по словарю
      'Name':selectedItem.Name,
      'Brand':selectedItem.brand_id,
      'Price': selectedItem.Price,
      'Currency': selectedItem.Currency,
      'Model':selectedItem.Model,
      'ImagePath': selectedItem.ImagePath, 
      'Avability': selectedItem.Avability,
      'Additional': selectedItem.Additional
      });
     
      //передаем массив в функцию заполнения
      setInPopUp(sendArray);

  }

  function setInPopUp(array){
    
      $('#popupId')[0].value = array[0].id;
      $('#popupName')[0].value = array[0].Name;
      $('#popupBrand')[0].value = array[0].Brand;
      $('#popupModel')[0].value = array[0].Model;
      $('.mainimg')[0].src = array[0].ImagePath;
      $('#popupPrice')[0].value = array[0].Price;
      $('#popupDoleur')[0].value = array[0].Currency;
      $('#popupNalichie')[0].value = array[0].Avability;
      $('#popupDopInfo')[0].value = array[0].Additional;




      //Блок установки категории по словарю
      var categoryDataSource = $('#kat').data("kendoComboBox").dataSource.data();
      var resultString = categoryDataSource.find(function(element, index, arr ){
        if(element.category_id === array[0].category){
          return element;
        }
      });
      $('#popupCat')[0].value = resultString.Name;

      //Блок установки субкатегории по словарю
      var subCategoryDataSource = $('#podkat').data("kendoComboBox").dataSource.data();
      var subresultString = subCategoryDataSource.find(function(element, index, arr ){
        if(element.subcategory_id === array[0].subcategory_id){
          return element;
        }
      });
      $('#popupSubCat')[0].value = subresultString.Name;

       //Блок установки бренда по словарю
       var brandDataSource = $('#brand').data("kendoComboBox").dataSource.data();
      var braResultString = brandDataSource.find(function(element){        
          return element.id === array[0].Brand;
        }
      );
      $('#popupBrand')[0].value = braResultString.name;

      $('#popupCount').val('')
   
      show('block');

//колиество позиций (моделей)!!


  }



$('#refreshCurs').click(function() {

mainSetCurs()

})

function justATest(arg){
  alert(arg);
}


function mainSetCurs() {

$.ajax({
url: 'curs.php',
type: "POST",
dataType: "JSON",
success: setCurs
  })
}

function setCurs(data) {

var doll = Number(data.doll)
var eur = Number(data.eur)

eur = eur.toFixed(2)
doll = doll.toFixed(2)

$('.dol').val(doll) 
$('.eur').val(eur) 

}

function addInCart(){


if ($('#popupCount').val() != '' && $('#popupCount').val() != undefined) {

$('#popupWindow').hide()
$('#popupWrap').hide()



      var entityGrid  = $("#grid").data("kendoGrid");
      var selectedItem = entityGrid.dataItem(entityGrid.select());

      console.log(selectedItem);
      //Инициализируем массив
      
    var brandNameForArray = $('#brand').data("kendoComboBox").dataSource.data().find(function(element){return element.id === selectedItem.brand_id});

      var count = $('#popupCount').val();
      var summ = $('#popupSumm').val();
      var percent = $('#popupPercent').val();
      var discount = $('#popupDiscount').val();


      //Заполняем массив из события (ассоциативный)
      $('#gridPopUp').data('kendoGrid').dataSource.add({
      'id':selectedItem.id, 
      'category':selectedItem.category_id, 
      'subcategory_id':selectedItem.subcategory_id, //доработать поиск по словарю
      'Name':selectedItem.Name,
      'Brand': brandNameForArray.name,
      'Price': selectedItem.Price,
      'Currency': selectedItem.Currency,
      'Model':selectedItem.Model,
      'PhotoPath': selectedItem.ImagePath, 
      'Avability': selectedItem.Avability,
      'Additional': selectedItem.Additional,
      'Count': count,
      'Summ': summ,
      'Percent': percent,
      'Discount': discount


      });
      $("#grid").data("kendoGrid").clearSelection()

// Добавляем данные в футер

var itogSumm = $('#itogo').val()

if (itogSumm == 0 && itogSumm == undefined) {

  itogSumm = 0

}

else {

itogSumm = itogSumm.replace(",",".");
itogSumm = itogSumm.replace(' ','')
  
}


summ = summ.replace(",",".");
summ = summ.replace(' ','')

itogSumm = Number(count)
summ = Number(summ)




    }

else {

alert('Пожалуйста, укажите количество!')

}

}

function ajaxToGoogle(){

var dataFeed = $('#gridPopUp').data('kendoGrid').dataSource.data();
var datatosend = [];
datatosend['data'] = [];
datatosend['otherinfo'] = [];

dataFeed.forEach(function(param){
  datatosend['data'].push(param);
});

var url = "https://script.google.com/macros/s/AKfycbyqkkIeVqADK9etQpXQJXH6J2vG-2jdy2sz6Gxd_ss0ybhcouR6/exec";

// console.log({"data" : JSON.stringify(datatosend.data) + JSON.stringify(datatosend.otherinfo)} );
var name = encodeURIComponent($('.hello').html())
var usd = $('#dol').val()
var eur = $('#eur').val()



$.ajax({
    url: "man.php"  ,
    type: "POST",       // указы ваем URL и 
    dataType : "JSON",
    data: ({manData : name}),
    success: function(managerData){
      

      
      manF = managerData.fio
      manE = managerData.email
      manT1 = managerData.tel1
      manT2 = managerData.tel2

      datatosend['otherinfo'].push({Managername:manF, ManagerEmail:manE, ManagerTel1:manT1, ManagerTel2:manT2, cursUsd:usd, cursEur:eur});
      

              $.ajax({
            url: "googleTransport.php"  ,
            type: "POST",       // указы ваем URL и 
            dataType : "html",
            data: ({data : encodeURIComponent(JSON.stringify(datatosend.data)) + encodeURIComponent(JSON.stringify(datatosend.otherinfo)) }),
            success: function(url){
              console.log(url);
            }

        });

      

      }

  });



}

function recalculateProposal(arg){

  var data = $('#gridPopUp').data('kendoGrid').dataSource.data();
  
  if(data.length > 0){
  
    var countOfAll = 0;
    var summ = 0;
    var discount = 0;
    var total = 0;
  
  data.forEach(function(entry){
  
  countOfAll += Number(entry.Count);
  
  entry.Summ = calculateSum(entry.Price, entry.Count);
  summ += entry.Summ;


  entry.Discount = calculatePercent(entry.Percent, entry.Summ);
  discount += entry.Discount;

  entry.Total = ParseNumNew(entry.Summ) - ParseNumNew(entry.Discount);
  total += entry.Total;
  })
  
  $('#footerCount')[0].value = countOfAll;
  $('#footerPosCount')[0].value = data.length;
  $('#footerDiscount')[0].value = oblagorodit(discount)  ;
  $('#footerSumm')[0].value = oblagorodit(summ)  ;
  $('#itogo')[0].value = total == 'NaN' ? 0 : oblagorodit(total)  ;
  
  }
  else if (data.length == 0){
  $('#footerCount')[0].value = 0;
  $('#footerPosCount')[0].value = 0;
  $('#footerDiscount')[0].value = 0  ;
  $('#footerSumm')[0].value = 0  ;
  $('#itogo')[0].value = 0 ;
 

  }
  $('#gridPopUp').data('kendoGrid').refresh()
  }

function razblagorodit(str) {

  str = str.replace(",",".");
  str = str.replace(' ','')
  str = Number(str)
  return str
}

function currencyConverter(value, currecyNow, currencyTo){




}

function oblagorodit(int) {

  int = int.toFixed(2)
  int = String(int).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
  int= int.replace(".",",");
  return int
} 


function calculateSum(price, amount){

return ParseNumNew(price) * ParseNumNew(amount);

}

function ParseNumNew(arg){

  if(typeof arg =="string"){
  arg = arg .replace(",",".");
  arg = arg .replace(' ','')
  return  Number(arg);
}
else{
  return arg;
}

}


function calculatePercent(percentVal, summ){
 if(percentVal !== undefined){
  summ = String(summ);

if (summ != '' && summ != undefined) {

  var itogSumm = ''
  var match = percentVal.search('%')
  var zapMatch = percentVal.search(',')

  summ = summ .replace(",",".");
  summ = summ .replace(' ','')
  summ = Number(summ)

  if (zapMatch >= 0) {
    percentVal = percentVal.replace(',','.')
    }


// Если процента нет
  if (match < 0) {
 
    percentVal = Number(percentVal)

    itogSumm = percentVal;

  }

// Если процент есть
  else if (match >= 0) {

    percentVal = percentVal.replace('%','')
    percentVal = Number(percentVal)
    
    itogSumm =  percentVal/100 * summ

  }
return itogSumm;
}
// Выводим итоговую скидку

}
}
   
// Блок проставления скидок на выделенные (добавить кнопку)
//Приведение в единую валюту 

   function StringBeutifier(itogSumm){

    itogSumm = itogSumm.toFixed(2)
  itogSumm = String(itogSumm).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
  itogSumm = itogSumm.replace(".",",");
   }

   function ReSaveCommand(e){  
     
  var dataToSave = $("#gridPopUp").data("kendoGrid").dataSource.data();
   e.preventDefault();
   var tr = $(e.target).closest("tr"); 
   var data = this.dataItem(tr);
   console.log(data);
   data.savedata = JSON.stringify(dataToSave);
   data.dirty = true;
   $("#grid3").data("kendoGrid").dataSource.sync();
   
  }     

  function LoadCommand(e){
    e.preventDefault();
    var tr = $(e.target).closest("tr");
    var data = this.dataItem(tr);

    var loadData = JSON.parse(data.savedata);
    $("#gridPopUp").data("kendoGrid").dataSource.data(loadData)
  }        

  function SaveCommand(){
    
    $('#windowSave').data('kendoWindow').open();

  }                 
                
  function saveValidation(){

    if($('#savename').val() == ""){
      $('#forErrorSave')[0].innerText = ""
      $('#forErrorSave')[0].innerText = "Название не может быть пустым"
    }
    else if ($('#gridPopUp').data('kendoGrid').dataSource.data().length < 1){
      $('#forErrorSave')[0].innerText = ""
      $('#forErrorSave')[0].innerText = "Ваше КП не может быть пустым"
    }
    else{
      var dataToSave = JSON.stringify($("#gridPopUp").data("kendoGrid").dataSource.data());
      $('#grid3').data('kendoGrid').dataSource.add({"name": $('#savename').val() , "savedata":dataToSave, "linkos":"", dirty: true , "dirtyFields":{"id": true, "name": true, "savedata":true, "linkos":true }})

      $('#grid3').data('kendoGrid').saveChanges()

      $('#forErrorSave')[0].innerText = ""
      $('#forErrorSave')[0].innerText = "Сохранение прошло успешно"

      setTimeout(function(){$('#windowSave').data('kendoWindow').close();},1000);

      // $('#windowSave').data('kendoWindow').close();
      $('#savename').val("");

    }

  }     
 


  </script>


</body>
</html>
