<?
// X\Wizards\HLBStorages::addStringstorage();
namespace X\Wizards {
    class HLBStorages {
        
        // возвращает Значение строки по коду
        public function addStringstorage (
                $data=[],
                $langsupport=false
            )
        {
            \Bitrix\Main\Loader::includeModule('highloadblock');
            // проверяем наличие стрингсторадж
            
            //создание hl-блока
            $result = \Bitrix\Highloadblock\HighloadBlockTable::add([
                    'NAME' => 'Stringstorage',
                    'TABLE_NAME' => 'b_hlbd_stringstorage',
                ]);
            if ($result->isSuccess()) {
                $id = $result->getId();
                
                
                // добавляем поля
                
                $oUserTypeEntity    = new \CUserTypeEntity();
                
                $aUserFields = [
                        'ENTITY_ID'         => 'HLBLOCK_'.$id,
                        'FIELD_NAME'        => 'UF_XML_ID',
                        'USER_TYPE_ID'      => 'string',
                        'MANDATORY'         => 'Y',
                        'EDIT_FORM_LABEL'   => [
                                'ru'    => 'Код',
                                'en'    => 'Code',
                            ],
                        'LIST_COLUMN_LABEL' => [
                                'ru'    => 'Код',
                                'en'    => 'Code',
                            ],
                        'LIST_FILTER_LABEL' => [
                                'ru'    => 'Код',
                                'en'    => 'Code',
                            ]
                    ];
                $iUserFieldId   = $oUserTypeEntity->Add( $aUserFields );
                $aUserFields = [
                        'ENTITY_ID'         => 'HLBLOCK_'.$id,
                        'FIELD_NAME'        => 'UF_STRING',
                        'USER_TYPE_ID'      => 'string',
                        'MANDATORY'         => 'Y',
                        'EDIT_FORM_LABEL'   => [
                                'ru'    => 'Значение',
                                'en'    => 'Value',
                            ],
                        'LIST_COLUMN_LABEL' => [
                                'ru'    => 'Значение',
                                'en'    => 'Value',
                            ],
                        'LIST_FILTER_LABEL' => [
                                'ru'    => 'Значение',
                                'en'    => 'Value',
                            ]
                    ];
                $iUserFieldId   = $oUserTypeEntity->Add( $aUserFields );
                $aUserFields = [
                        'ENTITY_ID'         => 'HLBLOCK_'.$id,
                        'FIELD_NAME'        => 'UF_NAME',
                        'USER_TYPE_ID'      => 'string',
                        'MANDATORY'         => 'Y',
                        'EDIT_FORM_LABEL'   => [
                                'ru'    => 'Название',
                                'en'    => 'Name',
                            ],
                        'LIST_COLUMN_LABEL' => [
                                'ru'    => 'Название',
                                'en'    => 'Name',
                            ],
                        'LIST_FILTER_LABEL' => [
                                'ru'    => 'Название',
                                'en'    => 'Name',
                            ]
                    ];
                $iUserFieldId   = $oUserTypeEntity->Add( $aUserFields );
                
                #TODO: добавить поддержку языков
                #TODO: добавить поддерку автозаполнения данных
                
                
                // создаем класс
                $app_dir = new \Bitrix\Main\IO\Directory(
                        \Bitrix\Main\Application::getDocumentRoot()
                                .'/local/php_interface/lib/App'
                    );
                if ($app_dir->isExists()) {
                    $storage_file = new \Bitrix\Main\IO\File($app_dir->getPath().'/Stringstorage.php');
                    $storage_file->putContents(
'<?
namespace App
{
    class Stringstorage extends \X\Abstraction\Protomodel\Stringstorage
    {
        const IDHLB = '.$id.';
    }
}'
                        );
                }
            }
            
            return $result;
        }
        #
        
    }
}