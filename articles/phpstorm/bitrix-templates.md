Шаблоны кода для работы с 1С-Битрикс
====================================

Автор статьи: [Максим Мул](https://github.com/amorfis-ws)

Для работы в команде используется единая среда разработки PHP Storm, которая позволяет настроить шаблоны кода.

Наиболее часто используемым модулем в "1С-Битрикс" являются "Информационные блоки", а если точнее, то его элементы и 
секции.

## [CIBlockElement](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/index.php) - класс для работы с элементами информационных блоков.

Для получения списка элементов ([CIBlockElement::GetList](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/getlist.php)) используется комбинация: `ibelist`

```php
$dbElement = CIBlockElement::GetList(
      array('SORT'=>'ASC', 'NAME'=>'ASC',), 
      array('IBLOCK_ID'=>$IBLOCK_ID$, 'ACTIVE'=>'Y',), 
      false, 
      false, 
      array('ID', 'NAME',)
);
while($arElement = $dbElement->GetNext()){
      $END$
}
```

Для получения элемента по ID ([CIBlockElement::GetByID](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/getbyid.php)) используется комбинация: `ibeid`

```php
$dbElement = CIBlockElement::GetByID($ID$);
if($dbElement = $res->GetNext()){
      $END$
}
```

Для добавления элемента ([CIBlockElement::Add](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/add.php)) используется комбинация: `ibeadd`

```php
$el = new CIBlockElement();
$PROP = array();
$PROP['CODE'] = "VALUE";
$arFields = array(
    "MODIFIED_BY" => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID" => $END$,
    "PROPERTY_VALUES"=> $PROP,
    "NAME" => "Элемент",
    "ACTIVE" => "Y",
    "PREVIEW_TEXT" => "текст для списка элементов",
    "PREVIEW_TEXT_TYPE" => "text",
    "DETAIL_TEXT" => "текст для детального просмотра",
    "DETAIL_TEXT_TYPE" => "text",
    "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
);
if($ELEMENT_ID = $el->Add($arFields)){
    echo "New ID: ".$ELEMENT_ID;
}else{
    echo "Error: ".$el->LAST_ERROR; 
}
```

Для обновления элемента ([CIBlockElement::Update](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/update.php)) используется комбинация: `ibeup`

```php
$el = new CIBlockElement();
$PROP = array();
$PROP["CODE"] = "VALUE";
$arFields = Array(
    "MODIFIED_BY" => $USER->GetID(),
    "IBLOCK_SECTION" => false,
    "NAME" => "Элемент",
    "ACTIVE" => "Y",
    "PREVIEW_TEXT" => "текст для списка элементов",
    "PREVIEW_TEXT_TYPE" => "text",
    "DETAIL_TEXT" => "текст для детального просмотра",
    "DETAIL_TEXT_TYPE" => "text",
    "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
);
$PRODUCT_ID = $END$;
if($el->Update($PRODUCT_ID, $arFields)){
    CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, $PROP); 
}else{
    echo "Error: " . $el->LAST_ERROR; 
}
```

Для удаления элемента ([CIBlockElement::Delete](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/delete.php)) используется комбинация: `ibedel`

```php
CIBlockElement::Delete($END$);
```

## [CIBlockSection](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/index.php) - класс для работы с секциями (разделами) информационных блоков.

Для получения списка секций ([CIBlockSection::GetList](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/getlist.php)) используется комбинация: `ibslist`

```php
$dbSection = CIBlockSection::GetList(
      array('SORT'=>'ASC', 'NAME'=>'ASC'), 
      array('IBLOCK_ID'=>$IBLOCK_ID$, 'ACTIVE'=>'Y'), 
      false,
      array("ID", "NAME",),
      false
);
while($arSection = $dbSection->GetNext()){
      $END$
}
```

Для получения секции по ID ([CIBlockSection::GetByID](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/getbyid.php)) используется комбинация: `ibsid`

```php
$dbSection = CIBlockSection::GetByID($IBLOCK_ID$);
if($arSection = $dbSection->GetNext()){
      $END$
}
```

Для добавления секции ([CIBlockSection::Add](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/add.php)) используется комбинация: `ibsadd`

```php
$ibs = new CIBlockSection();
$arFields = array(
    "ACTIVE" => "Y",
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID" => $END$,
    "NAME" => "Новая секция"
);
$SECTION_ID = $ibs->Add($arFields);
if(!$SECTION_ID) {
      echo $bs->LAST_ERROR;
}
```

Для обновления секции ([CIBlockSection::Update](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/update.php)) используется комбинация: `ibsup`

```php
$ibs = new CIBlockSection();
$arFields = Array(
    "ACTIVE" => "Y",
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID" => $IBLOCK_ID$,
    "NAME" => "Новая секция"
);
$SECTION_ID = $SECTION_ID$;
if(!$ibs->Update($SECTION_ID, $arFields)){
    echo "Error: ".$ibs->LAST_ERROR; 
}
```

Для удаления элемента ([CIBlockSection::Delete](http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/delete.php)) используется комбинация: `ibsdel`

```php
CIBlockSection::Delete($END$);
```

## Другие шаблоны

Для цикла foreach  по массиву `$arResult['ITEMS']` используется комбинация: `forei`

```php
<?foreach($arResult["ITEMS"] as $arItem):?>
$END$
<?endforeach;?>
```

Для распечатки переменной на странице используется комбинация: `debug`

```php
echo '<pre>'; print_r($END$); echo '</pre>';
```

Для распечатки переменной на странице (видно только админу) используется комбинация: `debuga`

```php
if($USER->IsAdmin()){
    echo '<pre>'; print_r($END$); echo '</pre>';
}
```
