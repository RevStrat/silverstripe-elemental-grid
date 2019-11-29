<?php

namespace TheWebmen\ElementalGrid\Models;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use TheWebmen\ElementalGrid\Controllers\ElementRowController;

class ElementRow extends BaseElement
{
    private $db = [
        'VerticalAlignment' => 'Enum("default,align-items-start,align-items-center,align-items-end", "default")',
        'HorizontalAlignment' => 'Enum("default,justify-content-start,justify-content-center,justify-content-end,justify-content-around,justify-content-between","default")'
    ];

    private static $icon = 'font-icon-menu';

    private static $table_name = 'ElementRow';

    private static $singular_name = 'row';

    private static $plural_name = 'rows';

    private static $description = 'Row element';

    private static $controller_class = ElementRowController::class;

    private static $block_type = 'full-width';

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('Title');
            $fields->addFieldToTab('Root.Main', TextField::create('Title'));
        });

        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Alignment', [
            new DropdownField(
              'VerticalAlignment',
              'Vertical Alignment',
              singleton($this->owner->ClassName)->dbObject('VerticalAlignment')->enumValues()
            ),
            new DropdownField(
              'HorizontalAlignment',
              'Horizontal Alignement',
              singleton($this->owner->ClassName)->dbObject('HorizontalAlignment')->enumValues()
            ),
        ]);

        return $fields;
    }

    public function getSummary()
    {
        return '';
    }

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Row');
    }
    
    public function RowClass()
    {
        switch (Config::forClass('TheWebmen\ElementalGrid')->get('cssFramework')){
            case 'bulma':
                return 'columns is-multiline';
                break;
            default:
                return 'row';
        }
    }

}
